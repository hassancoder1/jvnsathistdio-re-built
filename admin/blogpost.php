<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

<?php
if (!isset($_GET['id'])) {
    // Add New Blog Post
    $pageTitle = "Add New Blog Post";
    $postTitle = "";
    $imageSrc = "";
    $imageUIText = "Click to Add an Image <br> Use a horizontal image here, ratio of ( 16:9 )";
    $buttonText = "Add Post";
    $Content = "";
    $postId = ""; // No ID for new posts
} else {
    // Edit Blog Post
    $id = decryptData($_GET['id']);
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        $pageTitle = "Edit Blog Post";
        $imageUIText = "Click to update image";
        $postTitle = htmlspecialchars($post['title']);
        $imageSrc = htmlspecialchars($post['image']);
        $buttonText = "Update Post";
        $Content = htmlspecialchars_decode($post['content']);
        $postId = $post['id']; // Existing ID
    } else {
        // Handle case where post ID does not exist
        $pageTitle = "Error";
        $imageUIText = "Required data doesn't exist in the database";
        $postTitle = "";
        $imageSrc = "";
        $Content = "<h1>Data doesn't Exists in Database Please Go to manage blog posts and select any other post to edit.</h1>";
        $buttonText = "!Error";
        $postId = "";
    }
}
?>
<div class="w-full h-auto">
    <h1 class="text-3xl font-bold my-4 text-textPrimary"><?= htmlspecialchars($pageTitle); ?></h1>
    <form id="blogForm" onsubmit="updateRichTextContent(); handleFormSubmit(event, 'blogpost', '.blogpost-form-btn-spinner', '.blogpost-form-btn-text', '.blogpost-form-response-text')" class="space-y-4 md:space-y-6 w-full" enctype="multipart/form-data">

        <!-- Hidden Field for Post ID (only used for updates) -->
        <input type="hidden" name="postId" value="<?= htmlspecialchars($postId); ?>">

        <!-- Image Upload Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
            <div class="space-y-2 w-full">
                <label for="image" class="block text-sm font-semibold leading-none text-textPrimary">Featured Image *</label>
                <input type="file" id="image" name="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                <label for="image" class="flex h-64 w-full rounded-md border border-textPrimary/60 bg-bgPrimary cursor-pointer overflow-hidden flex-col items-center justify-center relative">
                    <div id="imagePreview" class="w-full h-full flex items-center justify-center bg-gray-100">
                        <span class="text-textSecondary text-center"> <?= $imageUIText; ?></span>
                        <?php if ($imageSrc): ?>
                            <img src="<?= htmlspecialchars(ROOT_URL . ASSETS . "images/" . UPLOADS . $imageSrc); ?>" class="w-full h-full object-cover" />
                        <?php endif; ?>
                    </div>
                </label>
            </div>
        </div>


        <!-- Title Field -->
        <div class="w-full">
            <input type="text" name="title" value="<?= htmlspecialchars($postTitle); ?>" class="border border-textPrimary/60 text-textPrimary rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors" placeholder="Title: e.g. 5 Secret Tricks to Capture the moments!" required>
        </div>

        <!-- Content Field -->
        <div class="w-full border min-h-44 border-textPrimary/60 text-textPrimary rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors" id="posteditor"><?= $Content; ?></div>
        <input type="hidden" name="content" id="contentField">

        <!-- Submit Button -->
        <button type="submit" class="inline-flex w-[120px] items-center justify-center h-10 px-4 py-2 text-sm font-medium text-bgPrimary rounded-full bg-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors">
            <svg class="w-5 h-5 mx-auto text-bgPrimary animate-spin blogpost-form-btn-spinner hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="blogpost-form-btn-text font-bold text-bgPrimary"><?= htmlspecialchars($buttonText); ?></span>
        </button>
        <span class="text-sm ml-4 font-light text-textPrimary blogpost-form-response-text"></span>
    </form>
</div>

<!-- Image Preview Script -->
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
            preview.innerHTML = '<span class="text-textSecondary text-center">Click to Add an Image<br>Use a horizontal image hero ratio of ( 16:9 )</span>';
        }
    }

    function updateRichTextContent() {
        const editor = document.querySelector('.ql-editor');

        // Remove the contenteditable and spellcheck attributes
        if (editor) {
            editor.removeAttribute('contenteditable');
            editor.removeAttribute('spellcheck');
        }

        // Capture the content without the attributes
        const editorContent = editor.innerHTML;

        // Store the cleaned content in the hidden input field
        document.getElementById('contentField').value = editorContent;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    const quill = new Quill('#posteditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                [{
                    'size': ['small', false, 'large', 'huge']
                }],
                [{
                    'font': []
                }],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'align': []
                }],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }, {
                    'list': 'check'
                }],
                ['blockquote', 'code-block'],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'direction': 'rtl'
                }],
                ['link', 'image', 'video', 'formula'],
                ['clean']
            ]
        }
    });
</script>