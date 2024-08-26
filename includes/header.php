<link rel="shortcut icon" href="<?= getAsset('logo.png', 'images/'); ?>" type="image/x-icon">
<link href="<?= getAsset('amaranth-font.css', 'css/'); ?>" rel="stylesheet">
<script src="<?= getAsset('fontawesome.js', 'js/'); ?>" crossorigin="anonymous"></script>
<script src="<?= getAsset('tailwind.js', 'js/'); ?>"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    bgPrimary: "<?= $theme['bgPrimary']; ?>",
                    bgSecondary: "<?= $theme['bgSecondary']; ?>",
                    textPrimary: "<?= $theme['textPrimary']; ?>",
                    textSecondary: "<?= $theme['textSecondary']; ?>",
                    primary: "<?= $theme['primary']; ?>",
                    secondary: "<?= $theme['secondary']; ?>"

                },
            }
        }
    }
</script>
<link rel="stylesheet" href="<?= getAsset('custom.css', 'css/'); ?>">
<link rel="stylesheet" href="<?= getAsset('aos.css', 'css/'); ?>" />
<link
    rel="stylesheet"
    href="<?= getAsset('swiper-bundle.min.css', 'css/'); ?>" />