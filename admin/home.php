<?php
// Fetch number of posts
$result = mysqli_query($conn, "SELECT COUNT(*) AS total_posts FROM posts");
$row = mysqli_fetch_assoc($result);
$total_posts = $row['total_posts'];

// Fetch titles of top 3 recent posts
$recent_posts_query = "SELECT title FROM posts ORDER BY date DESC LIMIT 3";
$recent_posts_result = mysqli_query($conn, $recent_posts_query);
$recent_posts = mysqli_fetch_all($recent_posts_result, MYSQLI_ASSOC);

// Fetch total number of images
$result = mysqli_query($conn, "SELECT COUNT(*) AS total_images FROM images");
$row = mysqli_fetch_assoc($result);
$total_images = $row['total_images'];

// Fetch categories and image counts
$categories_query = "SELECT category, COUNT(*) AS image_count FROM images GROUP BY category";
$categories_result = mysqli_query($conn, $categories_query);
$categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);

// Fetch top 3 contact form entries
$contact_query = "SELECT name, message FROM contactform_data ORDER BY submitted_at DESC LIMIT 3";
$contact_result = mysqli_query($conn, $contact_query);
$top_contact_entries = mysqli_fetch_all($contact_result, MYSQLI_ASSOC);

// Fetch top 3 get quote form entries
$quote_query = "SELECT name, phone FROM getquoteform_data ORDER BY submitted_at DESC LIMIT 3";
$quote_result = mysqli_query($conn, $quote_query);
$top_quote_entries = mysqli_fetch_all($quote_result, MYSQLI_ASSOC);

// Fetch the total views count
$result = mysqli_query($conn, "SELECT value FROM admin WHERE specific_key = 'viewcount'");
$row = mysqli_fetch_assoc($result);
$totalviewscount = isset($row['value']) ? $row['value'] : 0;

// Close the connection
mysqli_close($conn);
?>

<main class="w-full">
    <div class="bg-white p-6 rounded-lg">
        <h1 class="text-3xl font-bold text-textPrimary mb-4">Admin Dashboard</h1>
        <p class="mb-4">Access all pages from sidebar</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Post Count -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-36">
                <h2 class="text-xl font-semibold text-textPrimary">Total Posts</h2>
                <p class="text-gray-600 text-3xl"><?= $total_posts; ?></p>
            </div>

            <!-- Recent Posts -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-36">
                <h2 class="text-xl font-semibold text-textPrimary">Top 3 Recent Posts</h2>
                <ul class="list-disc ml-6">
                    <?php foreach ($recent_posts as $post): ?>
                        <li class="text-gray-600"><?= htmlspecialchars($post['title']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Total Images -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-36">
                <h2 class="text-xl font-semibold text-textPrimary">Total Images</h2>
                <p class="text-gray-600 text-3xl"><?= $total_images; ?></p>
            </div>

            <!-- Categories with Image Counts -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-36">
                <h2 class="text-xl font-semibold text-textPrimary">Categories and Image Counts</h2>
                <ul class="list-disc ml-6">
                    <?php foreach ($categories as $category): ?>
                        <li class="text-gray-600"><?= htmlspecialchars($category['category']); ?>: <?= $category['image_count']; ?> images</li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Top Contact Form Entries -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-36">
                <h2 class="text-xl font-semibold text-textPrimary">Top 3 Contact Form Entries</h2>
                <ul class="list-disc ml-6">
                    <?php foreach ($top_contact_entries as $entry): ?>
                        <li class="text-gray-600"><strong><?= htmlspecialchars($entry['name']); ?>:</strong> <?= htmlspecialchars($entry['message']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Top Get Quote Form Entries -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-36">
                <h2 class="text-xl font-semibold text-textPrimary">Top 3 Get Quote Form Entries</h2>
                <ul class="list-disc ml-6">
                    <?php foreach ($top_quote_entries as $entry): ?>
                        <li class="text-gray-600"><strong><?= htmlspecialchars($entry['name']); ?>:</strong> <?= htmlspecialchars($entry['phone']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="mt-4">
            <strong class="text-xl text-textPrimary">
                Total Website Views:
                <span class="text-2xl font-bold"><?= $totalviewscount; ?> </span> &nbsp;|&nbsp; <span class="text-sm text-textPrimary md:inline block mt-1"> Counted after users spend at least 30 seconds on the website.</span>
            </strong>
        </div>

    </div>
</main>