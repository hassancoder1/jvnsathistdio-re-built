<?php
// Fetch number of posts
$total_posts_query = "SELECT COUNT(*) AS total_posts FROM posts";
$result = mysqli_query($conn, $total_posts_query);
$row = mysqli_fetch_assoc($result);
$total_posts = $row['total_posts'];

// Fetch IDs, titles, and slugs of top 3 recent posts
$recent_posts_query = "SELECT id, title, slug FROM posts ORDER BY date DESC LIMIT 3";
$recent_posts_result = mysqli_query($conn, $recent_posts_query);
$recent_posts = mysqli_fetch_all($recent_posts_result, MYSQLI_ASSOC);

// Fetch total number of images
$image_count_query = "SELECT COUNT(*) AS total_images FROM images WHERE category IS NOT NULL";
$result = mysqli_query($conn, $image_count_query);
$row = mysqli_fetch_assoc($result);
$total_images = $row['total_images'];

// Fetch image counts by location
$locations_query = "SELECT location, COUNT(*) AS image_count FROM images WHERE location IS NOT NULL GROUP BY location";
$locations_result = mysqli_query($conn, $locations_query);
$location_counts = mysqli_fetch_all($locations_result, MYSQLI_ASSOC);

// Fetch image counts by category
$categories_query = "SELECT category, COUNT(*) AS image_count FROM images WHERE category IS NOT NULL GROUP BY category";
$categories_result = mysqli_query($conn, $categories_query);
$categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);

// Fetch top 3 contact form entries
$contact_query = "SELECT name, message FROM contactform_data ORDER BY submitted_at DESC LIMIT 3";
$contact_result = mysqli_query($conn, $contact_query);
$top_contact_entries = mysqli_fetch_all($contact_result, MYSQLI_ASSOC);

// Fetch top 3 get quote form entries
$quote_query = "SELECT name, plan FROM getquoteform_data ORDER BY submitted_at DESC LIMIT 3";
$quote_result = mysqli_query($conn, $quote_query);
$top_quote_entries = mysqli_fetch_all($quote_result, MYSQLI_ASSOC);

// Fetch total views count
$views_query = "SELECT value FROM admin WHERE specific_key = 'viewcount'";
$result = mysqli_query($conn, $views_query);
$row = mysqli_fetch_assoc($result);
$total_view_count = isset($row['value']) ? $row['value'] : 0;

// Fetch color scheme from database
$sql = "SELECT * FROM admin WHERE specific_key = 'colortheme'";
$color_result = mysqli_query($conn, $sql);
$colorTheme = mysqli_fetch_assoc($color_result);
$colorTheme = json_decode(decryptData($colorTheme['value']), true);
?>

<main class="w-full">
    <div class="bg-bgPrimary p-2 md:p-6 rounded-lg">
        <h1 class="text-3xl font-bold text-textPrimary mb-4">Admin Dashboard</h1>
        <p class="mb-4">Access all pages from the sidebar</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 md:gap-6">

            <!-- Total Posts and Recent Posts -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-auto w-full">
                <span class="text-xl font-semibold text-textPrimary mr-2">Total Posts</span>
                <span class="text-textPrimary text-2xl">( <?= $total_posts; ?> )</span>
                <ul class="mt-2 list-disc ml-6">
                    <?php foreach ($recent_posts as $post): ?>
                        <li>
                            <span class="text-textPrimary">
                                <?= htmlspecialchars($post['title']); ?> |
                                <a href="<?= ROOT_URL . ADMIN_SLUG . "/blogpost?id=" . encryptData($post['id']); ?>" class=" ml-2 text-primary"><i class="fa fa-pencil text-textPrimary mr-2"></i></a>
                                |
                                <span onclick="confirmDelete('<?= ROOT_URL . API_SLUG . '/deleteblogpost?id=' . encryptData($post['id']); ?>')" class="text-red-500 hover:text-red-700 cursor-pointer"><i class="fa fa-trash-alt text-red-500 mx-2"></i></span>
                                |
                                <a href="<?= ROOT_URL . SINGLE_BLOG_SLUG . "/" . $post['slug']; ?>" target="_blank" class="text-primary"><i class="fas fa-up-right-from-square text-textPrimary mr-2"></i></a>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= ROOT_URL . ADMIN_SLUG . "/blogs"; ?>" class="text-sm block mt-4 text-primary hover:underline">Manage All Posts</a>
            </div>

            <!-- Total Images and Locations -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-auto w-full">
                <span class="text-xl font-semibold text-textPrimary mr-2">Total Images</span>
                <span class="text-textPrimary text-2xl">( <?= $total_images; ?> )</span>
                <ul class="mt-2 list-disc ml-6">
                    <?php foreach ($location_counts as $location): ?>
                        <li class="text-textPrimary"><?= htmlspecialchars($location['location']); ?>: <?= $location['image_count']; ?> images | <a href="<?= ROOT_URL . ADMIN_SLUG . "/" . $location['location']; ?>" class="text-primary"><i class="fas fa-up-right-from-square text-primary mr-2"></i></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Image Counts by Category -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-auto w-full">
                <h2 class="text-xl font-semibold text-textPrimary">Images by Categories</h2>
                <ul class="mt-2 list-disc ml-6">
                    <?php foreach ($categories as $category): ?>
                        <?php if ($category['image_count'] > 0):
                            if ($category['category'] !== ''): ?>
                                <li class="text-textPrimary"><?= htmlspecialchars($category['category']); ?>: <?= $category['image_count']; ?> images</li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= ROOT_URL . ADMIN_SLUG . "/settings#categories"; ?>" class="text-sm block mt-4 text-primary">Manage Categories</a>
            </div>

            <!-- Top 3 Contact Form Entries -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-auto w-full">
                <h2 class="text-xl font-semibold text-textPrimary">Latest Contact Form Entries</h2>
                <ul class="mt-2 list-disc ml-6">
                    <?php foreach ($top_contact_entries as $entry): ?>
                        <li class="text-textPrimary"><strong><?= htmlspecialchars($entry['name']); ?>:</strong> <?= htmlspecialchars($entry['message']); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= ROOT_URL . ADMIN_SLUG . "/contact-form"; ?>" class="text-sm block mt-4 text-primary">View All Contact Entries</a>
            </div>

            <!-- Top 3 Get Quote Form Entries -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-auto w-full">
                <h2 class="text-xl font-semibold text-textPrimary">Latest Get Quote Entries</h2>
                <ul class="mt-2 list-disc ml-6">
                    <?php foreach ($top_quote_entries as $entry): ?>
                        <li class="text-textPrimary"><strong><?= htmlspecialchars($entry['name']); ?>:</strong> <?= htmlspecialchars($entry['plan']); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= ROOT_URL . ADMIN_SLUG . "/getquote-form"; ?>" class="text-sm block mt-4 text-primary">View All Quote Form Entires</a>
            </div>

            <!-- Color Scheme and Total Views -->
            <div class="bg-bgPrimary border-2 p-4 rounded-lg h-auto w-full">
                <h2 class="text-xl font-semibold text-textPrimary">Website Color Scheme</h2>
                <ul class="mt-2">
                    <li class="text-textPrimary my-1">Primary Text: <span class="text-bgPrimary bg-textPrimary mr-2 p-0.5 rounded-md"><?= $colorTheme['textPrimary']; ?> </span> => <span class="bg-textPrimary ml-2 px-2.5 py-0 rounded-full"></span>
                    </li>

                    <li class="text-textPrimary my-1">Secondary Text: <span class="text-bgSecondary bg-textSecondary mr-2 p-0.5 rounded-md"><?= $colorTheme['textSecondary']; ?> </span> => <span class="bg-textSecondary ml-2 px-2.5 py-0 rounded-full"></span>
                    </li>

                    <li class="text-textPrimary my-1">Primary Background: <span class="text-textPrimary bg-bgPrimary border-2 border-textPrimary mr-2 p-0.5 rounded-md"><?= $colorTheme['bgPrimary']; ?> </span> => <span class="bg-bgPrimary border-2 border-textPrimary ml-2 px-2.5 py-0 rounded-full"></span>
                    </li>

                    <li class="text-textPrimary my-1">Secondary Background: <span class="text-textPrimary bg-bgSecondary mr-2 p-0.5 rounded-md"><?= $colorTheme['bgSecondary']; ?> </span> => <span class="bg-bgSecondary ml-2 px-2.5 py-0 rounded-full"></span>
                    </li>

                    <li class="text-textPrimary my-1">Accent Primary: <span class="text-textPrimary bg-primary mr-2 p-0.5 rounded-md"><?= $colorTheme['primary']; ?> </span> => <span class="bg-primary ml-2 px-2.5 py-0 rounded-full"></span>
                    </li>

                    <li class="text-textPrimary my-1">Accent Secondary: <span class="text-textPrimary bg-secondary mr-2 p-0.5 rounded-md"><?= $colorTheme['secondary']; ?> </span> => <span class="bg-secondary ml-2 px-2.5 py-0 rounded-full"></span>
                    </li>
                </ul>
                <a href="<?= ROOT_URL . ADMIN_SLUG . "/settings#colorscheme"; ?>" class="text-sm block mt-4 text-primary">Manage Color Scheme</a>
            </div>
        </div>
        <!-- View Count -->
        <div class="bg-bgPrimary border-2 p-4 mt-4 rounded-lg h-auto w-full">
            <h2 class="text-xl font-semibold text-textPrimary">Total View Count</h2>
            <span class="text-textPrimary text-2xl"><?= $total_view_count; ?> </span>
            <p class="text-textSecondary mt-2">Since launch | <span class="ml-2">Counted after user spends atleast 30 seconds</span></p>
        </div>

        <div class="text-center text-textPrimary -mb-6 mt-8">
            <p>Built with <i class="fa fa-heart text-rose-400"></i> by <a href="https://linkedin.com/in/hassancoder" target="_blank" class="text-primary font-medium underline">Hassan Coder.</a></p>
            <p>HTML, CSS, JS, PHP, MYSQL. | APIs, Public + Admin Pages.</p>

        </div>
    </div>
</main>