<?php
// Fetch the stored value from the database
$sql = "SELECT * FROM admin";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Initialize variables to store the categorized data
$login_data = [];
$theme_data = [];
$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $encrypted_json = $row['value']; // Store login data
        $decrypted_json = decryptData($encrypted_json);

        if ($row['specific_key'] === 'login') {
            $account = json_decode($decrypted_json, true);
        } elseif ($row['specific_key'] === 'colortheme') {
            $colorTheme = json_decode($decrypted_json, true);
        }
    }
} else {
    echo "No admin data found.";
}

// Fetch categories from the database
$category_sql = "SELECT * FROM categories"; // Replace with your actual table name
$category_stmt = $conn->prepare($category_sql);
$category_stmt->execute();
$category_result = $category_stmt->get_result();

if ($category_result->num_rows > 0) {
    while ($category_row = $category_result->fetch_assoc()) {
        $categories[] = $category_row; // Store entire row for easy access to ID and name
    }
} else {
    echo "No categories found.";
}
?>

<div class="h-auto w-full">
    <h1 class="text-3xl font-bold my-4 text-textPrimary">Login Credentials</h1>
    <form onsubmit="handleFormSubmit(event,'updateaccount','.updateaccount-form-btn-spinner','.updateaccount-form-btn-text','.updateaccount-form-response-text')" class="space-y-4 md:space-y-6 min-w-[300px] max-w-[600px]">
        <div>
            <label for="username" class="block mb-2 text-sm font-medium text-textPrimary">Username</label>
            <input type="text" name="username" id="username" class="border border-textPrimary/60 text-textPrimary rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors" placeholder="e.g. Abc123" value="<?= htmlspecialchars($account['username']); ?>" required>
        </div>
        <div class="relative">
            <label for="password" class="block mb-2 text-sm font-medium text-textPrimary">Password</label>
            <input type="password" name="password" id="password" placeholder="e.g. YbDSk4Uyt@EFKi" class="border border-textPrimary/60 text-textPrimary rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors" value="<?= htmlspecialchars($account['password']); ?>" required>
            <i class="fa fa-eye-slash absolute text-textPrimary top-11 right-3 cursor-pointer" onclick="togglePassword('password')"></i>
        </div>
        <button type="submit" class="inline-flex w-[120px] items-center justify-center h-10 px-4 py-2 text-sm font-medium text-bgPrimary rounded-full bg-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors">
            <svg class="w-5 h-5 mx-auto text-bgPrimary animate-spin updateaccount-form-btn-spinner hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="updateaccount-form-btn-text font-bold text-bgPrimary">Update</span>
        </button>
        <span class="text-sm ml-4 font-light text-textPrimary updateaccount-form-response-text"></span>
    </form>

    <hr class="my-5">
    <h1 class="text-3xl font-bold my-4 text-textPrimary" id="colorscheme">Website Colour Theme</h1>
    <form onsubmit="handleFormSubmit(event,'updatetheme','.updatetheme-form-btn-spinner','.updatetheme-form-btn-text','.updatetheme-form-response-text')" class="space-y-4 md:space-y-6 min-w-[300px] max-w-[90%]">
        <div class="flex justify-between flex-wrap md:flex-row flex-col items-center gap-12 border-b-2 border-bgSecondary">
            <!-- Text Colours -->
            <div class="flex-1 flex justify-between items-center my-4 max-w-[300px]">
                <label for="textprimary" class="font-semibold text-textPrimary">Primary Text Colour: </label>
                <input type="color" id="textprimarycolor" name="textprimarycolorfield" class="w-8 h-6 cursor-pointer border-none outline-none rounded-full" value="<?= htmlspecialchars($colorTheme['textPrimary']); ?>">
                <input type="text" id="textprimary" name="textprimarytextfield" class="w-20 h-9 border-2 outline-none rounded-md pl-2 hidden" value="<?= htmlspecialchars($colorTheme['textPrimary']); ?>">
            </div>

            <div class="flex-1 flex justify-between items-center my-4 max-w-[300px]">
                <label for="textsecondary" class="font-semibold text-textPrimary">Secondary Text Colour: </label>
                <input type="color" id="textsecondarycolor" name="textsecondarycolorfield" class="w-8 h-6 cursor-pointer border-none outline-none rounded-full" value="<?= htmlspecialchars($colorTheme['textSecondary']); ?>">
                <input type="text" id="textsecondary" name="textsecondarytextfield" class="w-20 h-9 border-2 outline-none rounded-md pl-2 hidden" value="<?= htmlspecialchars($colorTheme['textSecondary']); ?>">
            </div>
        </div>

        <div class="flex justify-between flex-wrap md:flex-row flex-col items-center gap-12 border-b-2 border-bgSecondary">
            <!-- Background Colours -->
            <div class="flex-1 flex justify-between items-center my-4 max-w-[300px]">
                <label for="bgprimary" class="font-semibold text-textPrimary">Primary Background Colour: </label>
                <input type="color" id="bgprimarycolor" name="bgprimarycolorfield" class="w-8 h-6 cursor-pointer border-none outline-none rounded-full" value="<?= htmlspecialchars($colorTheme['bgPrimary']); ?>">
                <input type="text" id="bgprimary" name="bgprimarytextfield" class="w-20 h-9 border-2 outline-none rounded-md pl-2 hidden" value="<?= htmlspecialchars($colorTheme['bgPrimary']); ?>">
            </div>

            <div class="flex-1 flex justify-between items-center my-4 max-w-[300px]">
                <label for="bgsecondary" class="font-semibold text-textPrimary">Secondary Background Colour: </label>
                <input type="color" id="bgsecondarycolor" name="bgsecondarycolorfield" class="w-8 h-6 cursor-pointer border-none outline-none rounded-full" value="<?= htmlspecialchars($colorTheme['bgSecondary']); ?>">
                <input type="text" id="bgsecondary" name="bgsecondarytextfield" class="w-20 h-9 border-2 outline-none rounded-md pl-2 hidden" value="<?= htmlspecialchars($colorTheme['bgSecondary']); ?>">
            </div>
        </div>

        <div class="flex justify-between flex-wrap md:flex-row flex-col items-center gap-12 border-b-2 border-bgSecondary">
            <!-- Accent Colours -->
            <div class="flex-1 flex justify-between items-center my-4 max-w-[300px]">
                <label for="primary" class="font-semibold text-textPrimary">Primary Accent Colour: </label>
                <input type="color" id="primarycolor" name="primarycolorfield" class="w-8 h-6 cursor-pointer border-none outline-none rounded-full" value="<?= htmlspecialchars($colorTheme['primary']); ?>">
                <input type="text" id="primary" name="primarytextfield" class="w-20 h-9 border-2 outline-none rounded-md pl-2 hidden" value="<?= htmlspecialchars($colorTheme['primary']); ?>">
            </div>

            <div class="flex-1 flex justify-between items-center my-4 max-w-[300px]">
                <label for="secondary" class="font-semibold text-textPrimary">Secondary Accent Colour: </label>
                <input type="color" id="secondarycolor" name="secondarycolorfield" class="w-8 h-6 cursor-pointer border-none outline-none rounded-full" value="<?= htmlspecialchars($colorTheme['secondary']); ?>">
                <input type="text" id="secondary" name="secondarytextfield" class="w-20 h-9 border-2 outline-none rounded-md pl-2 hidden" value="<?= htmlspecialchars($colorTheme['secondary']); ?>">
            </div>
        </div>

        <div class="flex justify-between flex-wrap md:flex-row flex-col items-center gap-12 border-b-2 border-bgSecondary">
            <div class="flex-1 flex justify-between items-center my-4 max-w-[300px]">
                <label for="usehexvalue" class="font-semibold text-textPrimary">Use Hex Values Instead? </label>
                <input type="checkbox" id="usehexvalue" name="usehexvalue" class="w-6 h-6 cursor-pointer border-none outline-none rounded-full">
            </div>
        </div>

        <button type="submit" class="inline-flex w-[180px] items-center justify-center h-10 px-4 py-2 text-sm font-medium text-bgPrimary rounded-full bg-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors">
            <svg class="w-5 h-5 mx-auto text-bgPrimary animate-spin updatetheme-form-btn-spinner hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="updatetheme-form-btn-text font-bold text-bgPrimary">Update Color Theme</span>
        </button>
        <span class="text-sm ml-4 text-center font-light text-textPrimary updatetheme-form-response-text"></span>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function toggleTextInputs(checked) {
                const textInputs = document.querySelectorAll('input[type="text"]');
                textInputs.forEach(input => {
                    if (input.id.startsWith('textprimary') ||
                        input.id.startsWith('textsecondary') ||
                        input.id.startsWith('bgprimary') ||
                        input.id.startsWith('bgsecondary') ||
                        input.id.startsWith('primary') ||
                        input.id.startsWith('secondary')) {
                        input.classList.toggle('hidden', !checked);
                    }
                });
            }

            function syncColorAndTextInputs() {
                const colorInputs = document.querySelectorAll('input[type="color"]');
                colorInputs.forEach(colorInput => {
                    const textInput = document.querySelector(`input[name="${colorInput.name.replace('colorfield', 'textfield')}"]`);
                    if (textInput) {
                        colorInput.addEventListener('input', function() {
                            textInput.value = colorInput.value;
                        });
                        textInput.addEventListener('input', function() {
                            colorInput.value = textInput.value;
                        });
                    }
                });
            }

            const checkbox = document.getElementById('usehexvalue');
            checkbox.addEventListener('change', function() {
                toggleTextInputs(this.checked);
            });
            toggleTextInputs(checkbox.checked);
            syncColorAndTextInputs();
        });
    </script>


    <!-- Manage Categories Section -->
    <hr class="my-5" id="categories">
    <h1 class="text-3xl font-bold my-4 text-textPrimary">Manage Categories</h1>

    <!-- Existing Categories List -->
    <div class="space-y-4 md:space-y-6 min-w-[300px] max-w-[600px]">
        <?php if (!empty($categories)): ?>
            <ul class="list-disc pl-5">
                <?php foreach ($categories as $category): ?>
                    <li class="flex justify-between items-center my-2">
                        <span class="text-textPrimary"><?= htmlspecialchars($category['name']); ?></span>
                        <span onclick="confirmDelete('<?= ROOT_URL . API_SLUG . '/deleterecord?id=' . encryptData($category['id']); ?>&table=<?= encryptData('categories'); ?>')"
                            class="text-red-500 hover:text-red-700">
                            <i class="fa fa-trash-alt"></i>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-textPrimary">No categories found.</p>
        <?php endif; ?>
    </div>

    <!-- Add New Category Form -->
    <form onsubmit="handleFormSubmit(event,'addcategory','.addcategory-form-btn-spinner','.addcategory-form-btn-text','.addcategory-form-response-text')" class="space-y-4 md:space-y-6 min-w-[300px] max-w-[600px]">
        <div class="mt-3 border-t-2 pt-3">
            <label for="new_category" class="block mb-2 text-sm font-medium text-textPrimary">New Category Name</label>
            <input type="text" name="category_name" id="new_category" class="border border-textPrimary/60 text-textPrimary rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors" placeholder="e.g. Photography" required>
        </div>
        <button type="submit" class="inline-flex w-[180px] items-center justify-center h-10 px-4 py-2 text-sm font-medium text-bgPrimary rounded-full bg-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors">
            <svg class="w-5 h-5 mx-auto text-bgPrimary animate-spin addcategory-form-btn-spinner hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="addcategory-form-btn-text font-bold text-bgPrimary">Add Category</span>
        </button>
        <span class="text-sm ml-4 text-center font-light text-textPrimary addcategory-form-response-text"></span>
    </form>
</div>