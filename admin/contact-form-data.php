<?php
// Define number of contact form submissions per page
$submissionsPerPage = 20;

// Get current page number from URL
if (isset($urlPath[2]) && $urlPath[2] === "page") {
    $pageNumber = (int)$urlPath[3];
} else {
    $pageNumber = 1;
}

// Calculate the offset for the SQL query
$offset = ($pageNumber - 1) * $submissionsPerPage;

// Fetch contact form submissions from the database
$sql = "SELECT id, name, email, phone, message, submitted_at FROM contactform_data ORDER BY submitted_at DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    throw new mysqli_sql_exception('Failed to prepare SQL statement.');
}
$stmt->bind_param("ii", $submissionsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Fetch total number of submissions for pagination
$sqlTotal = "SELECT COUNT(*) AS total_submissions FROM contactform_data";
$stmtTotal = $conn->prepare($sqlTotal);
$stmtTotal->execute();
$totalResult = $stmtTotal->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalSubmissions = $totalRow['total_submissions'];
$totalPages = ceil($totalSubmissions / $submissionsPerPage);

// Define range of page numbers to show
$maxVisiblePages = 5;
$startPage = max(1, $pageNumber - floor($maxVisiblePages / 2));
$endPage = min($totalPages, $pageNumber + floor($maxVisiblePages / 2));

if ($endPage - $startPage < $maxVisiblePages - 1) {
    if ($startPage > 1) {
        $startPage = max(1, $endPage - $maxVisiblePages + 1);
    } else {
        $endPage = min($totalPages, $startPage + $maxVisiblePages - 1);
    }
}
?>

<div class="relative overflow-x-auto sm:rounded-lg">
    <h1 class="text-3xl font-bold my-4 text-textPrimary">Contact Form Data</h1>
    <table class="w-full text-sm text-left text-textSecondary">
        <thead class="text-xs text-textSecondary uppercase bg-bgSecondary">
            <tr>
                <th scope="col" class="px-6 py-3 text-textPrimary">Name</th>
                <th scope="col" class="px-6 py-3 text-textPrimary">Email</th>
                <th scope="col" class="px-6 py-3 text-textPrimary">Phone</th>
                <th scope="col" class="px-6 py-3 text-textPrimary">Message</th>
                <th scope="col" class="px-6 py-3 text-textPrimary">Submitted At</th>
                <th scope="col" class="px-6 py-3 text-textPrimary text-center">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="bg-bgPrimary border-b hover:bg-bgSecondary/40">
                        <td class="px-6 py-4 font-medium text-textSecondary whitespace-nowrap"><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-6 py-4 text-textSecondary"><?= decryptData($row['email']); ?></td>
                        <td class="px-6 py-4 text-textSecondary"><?= decryptData($row['phone']); ?></td>
                        <td class="px-6 py-4 text-textSecondary"><?= htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="px-6 py-4 text-textSecondary"><?= date('F j, Y, g:i a', strtotime($row['submitted_at'])); ?></td>
                        <td class="px-6 py-4 text-textSecondary text-right">
                        <span onclick="confirmDelete('<?= ROOT_URL . API_SLUG . '/deleterecord?id=' . encryptData($row['id']); ?>&table=<?= encryptData('contactform_data'); ?>')"
                                class="text-red-500 cursor-pointer hover:text-red-700">
                                <i class="fa fa-trash-alt"></i>
                            </>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr class="bg-bgPrimary border-b">
                    <td colspan="6" class="px-6 py-4 text-center text-textSecondary">No contact form data available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Pagination Controls -->
<div class="mt-12 flex justify-center">
    <div aria-label="Page navigation">
        <ul class="inline-flex items-center space-x-2">
            <!-- Previous Button -->
            <li>
                <?php if ($pageNumber > 1): ?>
                    <a href="<?= ROOT_URL . ADMIN_SLUG . "/contact-form/page/" . ($pageNumber - 1); ?>" class="px-3 py-2 rounded-md bg-textPrimary hover:bg-textPrimary/90 text-white">
                        Previous
                    </a>
                <?php else: ?>
                    <span class="px-3 py-2 rounded-md bg-gray-300 text-gray-500 cursor-not-allowed">Previous</span>
                <?php endif; ?>
            </li>

            <!-- Page Numbers -->
            <?php if ($startPage > 1): ?>
                <li>
                    <a href="<?= ROOT_URL . ADMIN_SLUG . "/contact-form/page/1"; ?>" class="px-3 py-2 rounded-md bg-bgSecondary hover:bg-transparent border-2 border-transparent hover:border-textSecondary text-dark">1</a>
                </li>
                <?php if ($startPage > 2): ?>
                    <li>
                        <span class="px-3 py-2 rounded-md bg-gray-300 text-gray-500 cursor-not-allowed">...</span>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                <li>
                    <a href="<?= ROOT_URL . ADMIN_SLUG . "/contact-form/page/" . $i; ?>" class="px-3 py-2 rounded-md <?= $i == $pageNumber ? 'bg-textPrimary text-white' : 'bg-bgSecondary hover:bg-transparent border-2 border-transparent hover:border-textSecondary text-dark'; ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($endPage < $totalPages): ?>
                <?php if ($endPage < $totalPages - 1): ?>
                    <li>
                        <span class="px-3 py-2 rounded-md bg-gray-300 text-gray-500 cursor-not-allowed">...</span>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="<?= ROOT_URL . ADMIN_SLUG . "/contact-form/page/" . $totalPages; ?>" class="px-3 py-2 rounded-md bg-bgSecondary hover:bg-transparent border-2 border-transparent hover:border-textSecondary text-dark"><?= $totalPages; ?></a>
                </li>
            <?php endif; ?>

            <!-- Next Button -->
            <li>
                <?php if ($pageNumber < $totalPages): ?>
                    <a href="<?= ROOT_URL . ADMIN_SLUG . "/contact-form/page/" . ($pageNumber + 1); ?>" class="px-3 py-2 rounded-md bg-textPrimary hover:bg-textPrimary/90 text-white">
                        Next
                    </a>
                <?php else: ?>
                    <span class="px-3 py-2 rounded-md bg-gray-300 text-gray-500 cursor-not-allowed">Next</span>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</div>

<?php
$stmt->close();
$stmtTotal->close();
$conn->close();
?>