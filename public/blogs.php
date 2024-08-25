<?php
// Define number of posts per page
$postsPerPage = 9;

// Get current page number from URL
if (isset($urlPath[1]) && $urlPath[1] === "page") {
    $pageNumber = (int)$urlPath[2];
} else {
    $pageNumber = 1;
}

// Calculate the offset for the SQL query
$offset = ($pageNumber - 1) * $postsPerPage;

// Fetch posts from the database
$sql = "SELECT id, title, slug, content, date, image FROM posts ORDER BY date DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $postsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Fetch total number of posts for pagination
$sqlTotal = "SELECT COUNT(*) AS total_posts FROM posts";
$stmtTotal = $conn->prepare($sqlTotal);
$stmtTotal->execute();
$totalResult = $stmtTotal->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalPosts = $totalRow['total_posts'];
$totalPages = ceil($totalPosts / $postsPerPage);

// Define range of page numbers to show
$maxVisiblePages = 5;
$startPage = max(1, $pageNumber - floor($maxVisiblePages / 2));
$endPage = min($totalPages, $pageNumber + floor($maxVisiblePages / 2));

// Adjust start and end pages if they are out of bounds
if ($endPage - $startPage < $maxVisiblePages - 1) {
    if ($startPage > 1) {
        $startPage = max(1, $endPage - $maxVisiblePages + 1);
    } else {
        $endPage = min($totalPages, $startPage + $maxVisiblePages - 1);
    }
}
?>

<!-- HERO SECTION -->
<div class="relative isolate px-6 lg:px-8">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-secondary to-primary opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon()"></div>
    </div>
    <div class="mx-auto max-w-2xl mt-10 py-32 sm:py-48 lg:py-36">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-textPrimary sm:text-6xl">Our Blog Posts</h1>

            <p class="mt-6 text-lg leading-8 text-textSecondary">
                <span class="flex justify-center items-center"><svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <?php
                    $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
                    echo 'Home / ' . ucwords(str_replace('-', ' ', implode(' / ', $url)));
                    ?>
                </span>
            </p>
        </div>
    </div>
    <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-primary to-secondary opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon()"></div>
    </div>
</div>

<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 gap-6 my-5 md:grid-cols-2 lg:grid-cols-3">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div onclick="redirect('/blog/<?= $row['slug']; ?>')" class="cursor-pointer bg-bgPrimary rounded-lg ring ring-1 ring-gray-200">
                    <img src="<?= getAsset($row['image'], 'images/' . UPLOADS); ?>" alt="<?= htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-48 sm:h-auto object-cover rounded-md">
                    <div class="p-4">
                        <p class="text-sm text-textSecondary"><?= date('F j, Y', strtotime($row['date'])); ?></p>
                        <h3 class="text-lg font-semibold"><?= htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="text-textSecondary mt-2"><?= htmlspecialchars(substr(strip_tags($row['content']), 0, 160)) . '...'; ?></p>
                        <div class="mt-6">
                            <a href="/blog/<?= $row['slug']; ?>" class="text-sm font-semibold leading-6 text-textPrimary transition group">
                                Read more <i class="fa fa-arrow-right ml-2 transition-transform duration-300 transform group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-textSecondary">No blog posts available.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Pagination -->
<div class="mt-44 flex justify-center">
    <div aria-label="Page navigation">
        <ul class="inline-flex items-center space-x-2">
            <!-- Previous Button -->
            <li>
                <?php if ($pageNumber > 1): ?>
                    <a href="<?= ROOT_URL . "blogs/page/" . ($pageNumber - 1); ?>" class="px-3 py-2 rounded-md bg-textPrimary hover:bg-textPrimary/90 text-white">Previous</a>
                <?php else: ?>
                    <span class="px-3 py-2 rounded-md bg-gray-300 text-gray-500 cursor-not-allowed">Previous</span>
                <?php endif; ?>
            </li>

            <!-- Page Numbers -->
            <?php if ($startPage > 1): ?>
                <li>
                    <a href="<?= ROOT_URL . "blogs/page/1"; ?>" class="px-3 py-2 rounded-md bg-bgSecondary hover:bg-transparent border-2 border-transparent hover:border-textSecondary text-dark">1</a>
                </li>
                <?php if ($startPage > 2): ?>
                    <li><span class="px-3 py-2 rounded-md bg-gray-300 text-gray-500 cursor-not-allowed">...</span></li>
                <?php endif; ?>
            <?php endif; ?>

            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                <li>
                    <a href="<?= ROOT_URL . "blogs/page/" . $i; ?>" class="px-3 py-2 rounded-md <?= $i == $pageNumber ? 'bg-textPrimary text-white' : 'bg-bgSecondary hover:bg-transparent border-2 border-transparent hover:border-textSecondary text-dark'; ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($endPage < $totalPages): ?>
                <?php if ($endPage < $totalPages - 1): ?>
                    <li><span class="px-3 py-2 rounded-md bg-gray-300 text-gray-500 cursor-not-allowed">...</span></li>
                <?php endif; ?>
                <li><a href="<?= ROOT_URL . "blogs/page/" . $totalPages; ?>" class="px-3 py-2 rounded-md bg-bgSecondary hover:bg-transparent border-2 border-transparent hover:border-textSecondary text-dark"><?= $totalPages; ?></a></li>
            <?php endif; ?>

            <!-- Next Button -->
            <li>
                <?php if ($pageNumber < $totalPages): ?>
                    <a href="<?= ROOT_URL . "blogs/page/" . ($pageNumber + 1); ?>" class="px-3 py-2 rounded-md bg-textPrimary hover:bg-textPrimary/90 text-white">Next</a>
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