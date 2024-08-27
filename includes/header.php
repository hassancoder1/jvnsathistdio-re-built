<!-- Favicons Started  -->
<link rel="apple-touch-icon" sizes="57x57" href="<?= getAsset('apple-icon-57x57.png', 'images/favicons/'); ?>">
<link rel="apple-touch-icon" sizes="60x60" href="<?= getAsset('apple-icon-60x60.png', 'images/favicons/'); ?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?= getAsset('apple-icon-72x72.png', 'images/favicons/'); ?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?= getAsset('apple-icon-76x76.png', 'images/favicons/'); ?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?= getAsset('apple-icon-114x114.png', 'images/favicons/'); ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?= getAsset('apple-icon-120x120.png', 'images/favicons/'); ?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?= getAsset('apple-icon-144x144.png', 'images/favicons/'); ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?= getAsset('apple-icon-152x152.png', 'images/favicons/'); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?= getAsset('apple-icon-180x180.png', 'images/favicons/'); ?>">
<link rel="icon" type="image/png" sizes="192x192" href="<?= getAsset('android-icon-192x192.png', 'images/favicons/'); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= getAsset('favicon-32x32.png', 'images/favicons/'); ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?= getAsset('favicon-96x96.png', 'images/favicons/'); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= getAsset('favicon-16x16.png', 'images/favicons/'); ?>">
<link rel="manifest" href="<?= getAsset('manifest.json', 'images/favicons/'); ?>">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?= getAsset('ms-icon-144x144.png', 'images/favicons/'); ?>">
<meta name="theme-color" content="#FF5C61">
<!-- Favicons End -->
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