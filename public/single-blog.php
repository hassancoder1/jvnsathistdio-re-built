<?php

$postsPerPage = 9;

// Get current page number from URL
if (isset($urlPath[2]) && $urlPath[2] === "page") {
    $pageNumber = (int)$urlPath[3];
} else {
    $pageNumber = 1;
}

// Calculate the offset for the SQL query
$offset = ($pageNumber - 1) * $postsPerPage;

// Fetch the single post based on the slug
if (isset($urlPath[1]) && !empty($urlPath[1])) {
    $slug = $conn->real_escape_string($urlPath[1]);

    // Fetch the current post
    $sql = "SELECT id, title, slug, content, date, image FROM posts WHERE slug = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "<meta http-equiv='refresh' content='0; url=" . ROOT_URL . "404'>";
?>
<?php
    }

    // Fetch the previous post
    $sql = "
        SELECT slug, title
        FROM posts
        WHERE date < (SELECT date FROM posts WHERE slug = ?)
        ORDER BY date DESC
        LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $prevResult = $stmt->get_result();
    $prevPost = $prevResult->fetch_assoc();

    // Fetch the next post
    $sql = "
        SELECT slug, title
        FROM posts
        WHERE date > (SELECT date FROM posts WHERE slug = ?)
        ORDER BY date ASC
        LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $nextResult = $stmt->get_result();
    $nextPost = $nextResult->fetch_assoc();

    $stmt->close();
} else {
    // Handle the case where slug is not provided
    $post = null;
    $prevPost = null;
    $nextPost = null;
}
?>

<!-- Blog Header -->
<div class="relative isolate px-6 lg:px-8">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-secondary to-primary opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-2xl mt-10 py-32 sm:py-48 lg:py-36">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-textPrimary sm:text-6xl"><?= htmlspecialchars($post['title'] ?? 'Blog Title Goes Here'); ?></h1>
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
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-primary to-secondary opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
</div>

<!-- Blog Content -->
<div class="bg-bgPrimary">
    <div class="container px-4 mx-auto max-w-[1024px]">
        <!-- Featured Image -->
        <div class="mb-6">
            <img src="<?= getAsset($post['image'] ?? 'default.jpg', 'images/' . UPLOADS); ?>" alt="Featured Image" class="w-full rounded-md shadow-md">
        </div>

        <!-- Blog Title -->
        <h1 class="text-3xl font-bold text-textPrimary mb-4"><?= htmlspecialchars($post['title']); ?></h1>

        <!-- Blog Date -->
        <p class="text-textSecondary text-sm mb-6"><?= isset($post['date']) ? 'Published on ' . date('F j, Y', strtotime($post['date'])) : ''; ?></p>

        <!-- Blog Content -->
        <div class="text-textSecondary leading-7">
            <?= $post['content'] ?? '<p>Content not found.</p>'; ?>
        </div>

        <!-- Navigation Buttons -->
        <div class="mt-44 flex justify-center">
            <div aria-label="Post navigation">
                <ul class="inline-flex items-center space-x-2">
                    <!-- Previous Button -->
                    <li>
                        <?php if ($prevPost): ?>
                            <a href="<?= ROOT_URL . 'blog/' . $prevPost['slug']; ?>" class="px-3 py-2 rounded-md bg-textPrimary hover:bg-textPrimary/90 text-white">Previous: <?= htmlspecialchars($prevPost['title']); ?></a>
                        <?php else: ?>
                            <span class="px-3 py-2 rounded-md bg-gray-300 text-gray-500 cursor-not-allowed">Previous</span>
                        <?php endif; ?>
                    </li>

                    <!-- Next Button -->
                    <li>
                        <?php if ($nextPost): ?>
                            <a href="<?= ROOT_URL . 'blog/' . $nextPost['slug']; ?>" class="px-3 py-2 rounded-md bg-textPrimary hover:bg-textPrimary/90 text-white">Next: <?= htmlspecialchars($nextPost['title']); ?></a>
                        <?php else: ?>
                            <span class="px-3 py-2 rounded-md bg-gray-300 text-gray-500 cursor-not-allowed">Next</span>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Dynamic Title and Meta Description -->
<script>
    document.title = "<?= htmlspecialchars($post['title']); ?>";
    var metaDescription = document.querySelector('meta[name="description"]');
    if (metaDescription) {
        metaDescription.setAttribute('content', "<?= htmlspecialchars(substr(strip_tags($post['content']), 0, 160)) . '...'; ?>");
    } else {
        var newMeta = document.createElement('meta');
        newMeta.name = 'description';
        newMeta.content = "<?= htmlspecialchars(substr(strip_tags($post['content']), 0, 160)) . '...'; ?>";
        document.head.appendChild(newMeta);
    }
</script>