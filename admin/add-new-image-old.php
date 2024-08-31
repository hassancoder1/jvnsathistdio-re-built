<?php
// Prepare the query to fetch categories
$query = "SELECT name FROM categories";
$stmt = $conn->prepare($query);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch categories into an array
$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

// Close the statement and connection
$stmt->close();
// $conn->close();
?>

<div class="grid max-w-2xl gap-6">
    <div class="space-y-1">
        <h2 class="text-2xl font-bold tracking-tighter mb-4 sm:text-3xl text-textPrimary md:text-4xl">
            Add <span class="text-primary font-bold">New Image</span>
        </h2>
    </div>
    <form onsubmit="handleFormSubmit(event, 'addimage', '.addimage-form-btn-spinner', '.addimage-form-btn-text', '.addimage-form-response-text')" class="grid gap-6" enctype="multipart/form-data">
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label for="image" class="block text-sm font-semibold leading-none text-textPrimary">Image *</label>
                <input type="file" id="image" name="image" class="hidden" accept="image/*" onchange="previewImage(event)" required />
                <label for="image" class="flex h-64 w-full rounded-md border border-textPrimary/60 bg-bgPrimary cursor-pointer overflow-hidden flex-col items-center justify-center relative">
                    <div id="imagePreview" class="w-full h-full flex items-center justify-center bg-gray-100">
                        <span class="text-textSecondary">Click to add image</span>
                    </div>
                </label>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold leading-none text-textPrimary">Image Name/Title *</label>
                <input type="text" id="name" name="name" placeholder="e.g. Stunning Sunset"
                    class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary text-textPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2"
                    required />
            </div>
            <div class="space-y-2">
                <label for="location" class="text-sm font-semibold leading-none text-textPrimary">Image Location *</label>
                <select id="location" name="location"
                    class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary"
                    required onchange="toggleCategoryField()">
                    <option value="" disabled selected>Choose an option</option>
                    <option value="hero">Hero Images Slider</option>
                    <option value="photoshoot">Photoshoot</option>
                    <option value="gallery">Gallery</option>
                </select>
            </div>
        </div>
        <div id="categoryField" class="hidden grid sm:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label for="category" class="text-sm font-semibold leading-none text-textPrimary">Category *</label>
                <select id="category" name="category"
                    class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary">
                    <option value="" disabled selected>Choose a category</option>
                    <?php if (!empty($categories)) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= htmlspecialchars($category['name']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="" disabled>No categories available</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="flex gap-4 flex-col items-center md:flex-row">
            <button type="submit" class="inline-flex w-[120px] items-center justify-center h-10 px-4 py-2 text-sm font-medium text-bgPrimary rounded-full bg-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors">
                <svg class="w-5 h-5 mx-auto text-bgPrimary animate-spin addimage-form-btn-spinner hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="addimage-form-btn-text font-bold text-bgPrimary">Add Image</span>
            </button>
            <span class="text-sm ml-4 font-light text-textPrimary addimage-form-response-text"></span>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover" />`;
            }

            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '<span class="text-textSecondary">Click to add image</span>';
        }
    }

    function toggleCategoryField() {
        const location = document.getElementById('location').value;
        const categoryField = document.getElementById('categoryField');

        if (location === 'gallery' || location === 'photoshoot') {
            categoryField.classList.remove('hidden');
        } else {
            categoryField.classList.add('hidden');
        }
    }
</script>