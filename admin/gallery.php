<div class="h-auto w-full">
    <h1 class="text-3xl font-bold my-4 text-textPrimary">Gallery Images</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php
        // Simple MySQLi query
        $query = "SELECT id, name, category, image_path FROM images WHERE location = 'gallery' ORDER BY uploaded_at DESC";
        $result = mysqli_query($conn, $query);

        // Loop through each image and display it
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="relative group rounded-lg overflow-hidden border-2">
                <img src="<?= getAsset($row['image_path'], 'images/' . UPLOADS); ?>" class="w-full h-full object-cover" alt="<?= htmlspecialchars($row['name']); ?>">
                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition"></div>
                <div class="absolute bottom-0 left-0 right-0 bg-bgPrimary py-2 px-4 flex justify-between items-center">
                    <div>
                        <h3 class="text-md font-semibold text-textPrimary"><?= htmlspecialchars($row['name']); ?></h3>
                        <span class="font-semibold text-sm text-primary"><?= htmlspecialchars($row['category']); ?></span>
                    </div>
                    <a href="<?= "/" . API_SLUG . "/deleterecord?id=" . encryptData($row['id']); ?>&table=<?= encryptData('images') . "&delimg=" . encryptData($row['image_path']); ?>">
                        <i class="fa fa-trash-alt text-red-500"></i>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>