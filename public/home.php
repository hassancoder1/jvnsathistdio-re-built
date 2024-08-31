<?php
// Fetch all images from the database
$query = "SELECT name, location, category, image_path FROM images";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Categorize images by location
$imagesByLocation = [
    'photoshoot' => [],
    'gallery' => [],
    'hero' => []
];

while ($row = $result->fetch_assoc()) {
    $location = $row['location'];
    if (array_key_exists($location, $imagesByLocation)) {
        $imagesByLocation[$location][] = $row;
    }
}
$stmt->close();

// Generate an array of image paths for preloading
$heroImages = array_map(function ($image) {
    return getAsset($image['image_path'], 'images/' . UPLOADS);
}, $imagesByLocation['hero']);

// Set the initial background image
$initialImage = !empty($heroImages) ? $heroImages[0] : getAsset('default-hero.webp', 'images/');
?>

<!-- Preload hero images -->

<head>
    <?php foreach ($heroImages as $image): ?>
        <link rel="preload" href="<?= $image ?>" as="image">
    <?php endforeach; ?>
</head>

<!-- HERO SECTION -->
<div id="hero-section" class="relative hero-image isolate bg-cover bg-no-repeat cursor-pointer overflow-hidden" style="background-image: url('<?= $initialImage ?>');" ondblclick="changeBackgroundImage()">
    <div class="w-full h-full bg-slate-950/30 px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-16 sm:py-20 lg:py-12">
            <div class="text-center">
                <!-- <div class="mb-4 mt-16 bg-white border border-[6px] border-secondary rounded-md flex items-center justify-center mx-auto"> -->
                <img src="<?= getAsset('logo.webp', 'images/'); ?>" alt="Logo" class="w-64 mb-5 mt-16  brightness-200 mx-auto rounded-full object-contain">
                <!-- </div> -->
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Capture the Essence of Your
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-secondary to-primary font-bold">Indian Wedding</span>
                </h1>
                <p class="mt-4 text-lg leading-5 text-white/90">Experience the magic of your special day through the lens of our talented Indian wedding photographers.</p>
                <div class="mt-5 flex items-center justify-center gap-x-6">
                    <a href="/#about" class="rounded-full bg-primary px-4 py-2.5 text-sm font-semibold text-bgPrimary shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary transition group">Learn more <i class="fa fa-arrow-down ml-2 transition-transform duration-300 transform group-hover:translate-y-1"></i></a>
                </div>
                <div class="flex items-center justify-center">
                    <div class="mt-6 text-center ring-1 ring-white rounded-full w-8 h-12 flex items-center justify-center">
                        <div class="w-3 h-3 rounded-full bg-white animate-ping"></div>
                    </div>
                </div>
                <p class="mt-5 text-sm font-medium text-white animate-pulse">Double tap to change background Image.</p>
            </div>
        </div>
    </div>
</div>


<script>
    let heroImages = <?= json_encode($heroImages); ?>;

    function preloadImages(imageUrls) {
        imageUrls.forEach(url => {
            const img = new Image();
            img.src = url;
        });
    }

    preloadImages(heroImages);
</script>




<!-- ABOUT SECTION  -->
<div class="space-y-20" id="about"></div>
<div class="container lg:px-8 mx-auto px-4 max-w-screen-xl overflow-hidden">
    <div class="md:flex mt-20 mb-10 md:space-x-10 items-start relative">
        <div data-aos="fade-down" class="md:w-5/12 mt-20 md:mt-0 05xs:px-3">
            <h1 class="text-3xl mb-1 font-bold text-textPrimary lg:pr-40">
                Who Are We?</span>
            </h1>

            <p class="text-justify text-textSecondary">
                I am Rajesh Kumar, owner of Suman Studios, a photography business based in Muzaffarpur. My team and I have been working since January 2009 and have captured over 3,000 weddings. Suman Studios in Muzaffarpur is one of the leading names in the photography industry. We specialize in wedding photography, videography, pre-wedding shoots, portfolios, outdoor photography, and much more. Known for exceptional service, we have garnered a strong reputation with numerous positive reviews, ratings, and recommendations. Visit us to discover more about our services and locations.
            </p>
            <div class="h-auto py-4 flex items-center justify-center md:justify-start gap-3 flex-wrap">
                <!-- Phone Call Icon -->
                <a href="tel:+916200569546" target="_blank" class="group transition-all duration-500 hover:-translate-y-1">
                    <div class="w-8 h-8 bg-green-600 rounded-md flex items-center justify-center">
                        <i class="fas fa-phone text-white text-md"></i>
                    </div>
                </a>
                <!-- Facebook Icon -->
                <a href="https://www.facebook.com/RAJESHPHOTOGRAPHY761995/" target="_blank" class="group transition-all duration-500 hover:-translate-y-1">
                    <div class="w-8 h-8 bg-blue-600 rounded-md flex items-center justify-center">
                        <i class="fab fa-facebook-f text-white text-md"></i>
                    </div>
                </a>
                <!-- WhatsApp Icon -->
                <a href="https://wa.me/+916200569546" target="_blank" class="group transition-all duration-500 hover:-translate-y-1">
                    <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                        <i class="fab fa-whatsapp text-white text-md"></i>
                    </div>
                </a>
                <!-- Instagram Icon -->
                <a href="https://www.instagram.com/jeevansathistudio/" target="_blank" class="group transition-all duration-500 hover:-translate-y-1">
                    <div class="w-8 h-8 bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 rounded-md flex items-center justify-center">
                        <i class="fab fa-instagram text-white text-md"></i>
                    </div>
                </a>
                <!-- Mail Icon -->
                <a href="help@jeevansathistudio.in" target="_blank" class="group transition-all duration-500 hover:-translate-y-1">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-md flex items-center justify-center">
                        <i class="fas fa-envelope text-white text-md"></i>
                    </div>
                </a>
                <!-- YouTube Icon -->
                <a href="https://www.youtube.com/channel/UC5kEtpOMRrAtcMpzDCXZjQg" target="_blank" class="group transition-all duration-500 hover:-translate-y-1">
                    <div class="w-8 h-8 bg-red-600 rounded-md flex items-center justify-center">
                        <i class="fab fa-youtube text-white text-md"></i>
                    </div>
                </a>
            </div>
        </div>


        <div data-aos="fade-down" data-aos-delay="200" class="md:w-7/12 mt-20 md:mt-0 relative">
            <div
                class="w-32 h-32 rounded-full bg-secondary absolute -z-10 left-5 -top-10 animate-pulse"
                style="animation-delay: 0.2s;"></div>

            <div
                class="w-5 h-5 rounded-full absolute bg-primary -z-10 left-36 -top-12 animate-ping"
                style="animation-delay: 0.3s;"></div>

            <img
                class="w-11/12 mx-auto md:ml-auto rounded-md -z-10 brightness-90 floating bg-gray-200"
                src="<?= getAsset('about-featured.webp', 'images/'); ?>"
                loading="lazy"
                alt="About Image"
                style="animation-delay: 0.4s;" />

            <div class="w-36 h-36 rounded-full bg-primary absolute -z-10 right-3 -bottom-8 animate-pulse"
                style="animation-delay: 0.5s;"></div>

            <div class="w-5 h-5 rounded-full absolute -z-10 bg-secondary right-36 -bottom-12 animate-ping"
                style="animation-delay: 0.6s;"></div>
        </div>
    </div>
</div>

<!-- STATS SECTION  -->
<div id="stats"></div>
<div class="border-y-8 md:border-x-0 border-primary border-double my-10">
    <div class="py-24 sm:py-10 mx-auto bg-secondary">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-textPrimary">Weddings Covered</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-textPrimary sm:text-5xl count" data-count="3000">0+</dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-textPrimary">Photos Delivered</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-textPrimary sm:text-5xl count" data-count="1200000">0</dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-textPrimary">Happy Clients</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-textPrimary sm:text-5xl count" data-count="2500">0+</dd>
                </div>
            </dl>
        </div>
    </div>
</div>

<!-- SERVICES SECTION -->
<div id="services" class="py-12 mb-12">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="container mx-auto text-center mt-6 mb-12">
            <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Our Services</h2> <img src="<?= getAsset('heading-decoration.webp', 'images/'); ?>" class="h-12 -mt-1 mx-auto" alt="Heading Decoration">
        </div> <!-- Swiper Container -->
        <div class="relative">
            <div class="services-swiper-container overflow-hidden mx-auto max-w-[90%]">
                <div class="swiper-wrapper mb-8"> <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col items-center justify-center"> <img class="h-40 w-40 rounded-full border-4 border-primary" src="<?= getAsset('wedding-photoshoot-service.webp', 'images/'); ?>" alt="Wedding PhotoShoot" loading="lazy" /> </div>
                            <div> <span class="text-base font-semibold leading-7 text-textPrimary"> Wedding PhotoShoot </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">We are one of the best wedding photo photographers in town , capture your special day with us .</p>
                            </div>
                        </div>
                    </div> <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col items-center justify-center"> <img class="h-40 w-40 rounded-full border-4 border-primary" src="<?= getAsset('pre-wedding-photoshoot-service.webp', 'images/'); ?>" alt="Pre Wedding Shoots" loading="lazy" /> </div>
                            <div> <span class="text-base font-semibold leading-7 text-textPrimary"> Pre Wedding Shoots </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">If marriages are said to be made in heaven then we make sure to capture your most beautiful memories through our lens.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col items-center justify-center"> <img class="h-40 w-40 rounded-full border-4 border-primary" src="<?= getAsset('photographers-for-functions-service.webp', 'images/'); ?>" alt="PhotoGraphers For Function" loading="lazy" /> </div>
                            <div> <span class="text-base font-semibold leading-7 text-textPrimary"> PhotoGraphers For Function </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">Want a memory for life time? Contact us & we will provide the best best quality photographs with our expert team.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col items-center justify-center"> <img class="h-40 w-40 rounded-full border-4 border-primary" src="<?= getAsset('cadid-wedding-photographers-service.webp', 'images/'); ?>" alt="Candid Wedding PhotoGraphers" loading="lazy" /> </div>
                            <div> <span class="text-base font-semibold leading-7 text-textPrimary"> Candid Wedding PhotoGraphers </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">Hire the best phtotographers who can sense the candidates of the wedding moment and click the best.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col items-center justify-center"> <img class="h-40 w-40 rounded-full border-4 border-primary" src="<?= getAsset('birthday-shoot-service.webp', 'images/'); ?>" alt="BirthDay PhotoShoot" loading="lazy" /> </div>
                            <div> <span class="text-base font-semibold leading-7 text-textPrimary"> BirthDay PhotoShoot </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">Picture Your Joy: Expertly crafted birthday photoshoots capturing every moment beautifully, creating unforgettable memories.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col items-center justify-center"> <img class="h-40 w-40 rounded-full border-4 border-primary" src="<?= getAsset('social-photography-service.webp', 'images/'); ?>" alt="Social PhotoGraphy" loading="lazy" /> </div>
                            <div> <span class="text-base font-semibold leading-7 text-textPrimary"> Social PhotoGraphy </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">Social and influencer photography blends lifestyle and branding, creating visuals that boost personal and commercial appeal.</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- Custom Navigation Buttons -->
                <div class="custom-prev absolute left-0 top-1/2 -mt-10 transform -translate-y-1/2"> <button class="w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition duration-300 ease-in-out hover:text-bgPrimary"> <!-- Icon for prev --> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg> </button> </div>
                <div class="custom-next absolute right-0 top-1/2 -mt-10 transform -translate-y-1/2"> <button class="w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition duration-300 ease-in-out hover:text-bgPrimary"> <!-- Icon for next --> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg> </button> </div> <!-- Pagination -->
            </div>
        </div>
    </div>
</div>


<!-- GALLERY SECTION -->
<div id="gallery"></div>
<div class="container mx-auto px-4 mt-16 mb-24">
    <!-- Header and Description -->
    <div class="container mx-auto text-center mt-6 mb-12">
        <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Gallery</h2>
        <img src="<?= getAsset('heading-decoration.webp', 'images/') ?>" class="h-12 -mt-1 mx-auto" alt="Heading Decoration">
    </div>

    <!-- Filter Tabs -->
    <div class="tabs flex justify-center items-center gap-1 text-center flex-wrap mx-auto w-full">
        <?php
        // Filter gallery images
        $galleryImages = $imagesByLocation['gallery'] ?? [];
        $categories = [];

        // Get unique categories
        foreach ($galleryImages as $image) {
            $category = $image['category'];
            if (!empty($category) && !in_array($category, $categories)) {
                $categories[] = $category;
            }
        }

        // Show the "All" tab and dynamically generate other tabs
        if (count($categories) > 0) :
        ?>
            <span class="tab bg-primary text-bgPrimary font-medium me-2 border-2 border-primary cursor-pointer px-5 py-1 my-3 rounded-full" data-category="all">All</span>
            <?php foreach ($categories as $category) : ?>
                <span class="tab bg-bgPrimary text-primary hover:border-primary border-2 font-medium me-2 cursor-pointer px-5 py-1 my-3 rounded-full" data-category="<?= htmlspecialchars($category) ?>"><?= htmlspecialchars($category) ?></span>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Image Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-5 mx-auto max-w-[1200px] gallery">
        <?php if (!empty($galleryImages)) : ?>
            <?php foreach ($galleryImages as $image) : ?>
                <img class="gallery-item h-auto max-w-full bg-gray-200 rounded-lg cursor-pointer hover:ring-primary ring-2 ring-transparent ring-offset-2"
                    data-category="<?= htmlspecialchars($image['category']) ?>"
                    data-title="<?= htmlspecialchars($image['name']) ?>"
                    src="<?= getAsset($image['image_path'], 'images/' . UPLOADS); ?>"
                    alt="<?= htmlspecialchars($image['name']) ?>"
                    data-aos="fade-up" loading="lazy">
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Modal for Gallery View -->
    <div class="opened-gallery fixed top-0 left-0 w-full px-6 min-h-screen bg-textPrimary z-[47] hidden" data-aos="zoom-in">
        <div class="flex justify-between items-center text-bgPrimary p-4 max-auto">
            <div class="flex gap-3">
                <span class="font-medium gallery-title">Title</span>
                <span class="font-normal px-3 py-0.5 text-sm border border-bgPrimary rounded-full gallery-category">Category</span>
            </div>
            <div class="flex items-center gap-3">
                <i class="fa fa-times closeBtn text-2xl text-bgPrimary cursor-pointer"></i>
            </div>
        </div>

        <div class="grid gap-2">
            <div class="mt-8">
                <img class="main-image min-h-[300px] max-h-[380px] ring-primary ring-2 ring-offset-2 max-w-full mx-auto rounded-lg" src="" alt="Open Modal Image" loading="lazy">
            </div>
            <div class="flex justify-start items-center gap-4 overflow-x-auto w-full px-2 md:px-8 py-3 thumbnails">
                <!-- Thumbnails will be populated dynamically -->
            </div>
        </div>
    </div>
</div>


<?php
// Fetch the latest 3 posts from the database
$sqlLatest = "SELECT id, title, slug, date, image FROM posts ORDER BY date DESC LIMIT 3";
$stmtLatest = $conn->prepare($sqlLatest);
$stmtLatest->execute();
$resultLatest = $stmtLatest->get_result();
?>
<!-- BLOGS SECTION  -->
<div class="container mx-auto px-4">
    <div class="container mx-auto text-center mt-6 mb-12">
        <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Our Blogs</h2>
        <img src="<?= getAsset('heading-decoration.webp', 'images/') ?>" class="h-12 -mt-1 mx-auto" alt="Heading Decoration">
    </div>

    <div class="blogs-swiper-container overflow-hidden mt-10">
        <div class="swiper-wrapper flex gap-6">
            <?php if ($resultLatest->num_rows > 0): ?>
                <?php while ($row = $resultLatest->fetch_assoc()): ?>
                    <div onclick="redirect('/blog/<?= $row['slug']; ?>')" class="swiper-slide relative w-full sm:w-[calc(50%-12px)] cursor-pointer rounded-md overflow-hidden h-[400px]"> <!-- Fixed height -->
                        <img src="<?= getAsset($row['image'], 'images/' . UPLOADS); ?>" alt="<?= htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-full object-cover z-20" loading="lazy"> <!-- Fixed height for image -->
                        <div class="absolute top-0 left-0 p-4 flex flex-col justify-end w-full h-full z-30 bg-textPrimary/20">
                            <h3 class="text-2xl font-bold text-bgPrimary"><?= htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="text-md text-bgPrimary font-medium"><?= date('F j, Y', strtotime($row['date'])); ?></p>
                            <a href="/blog/<?= $row['slug']; ?>" class="text-sm font-semibold leading-6 text-bgPrimary transition group">Read more <i class="fa fa-arrow-right ml-2 transition-transform duration-300 transform group-hover:translate-x-1"></i></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center text-textSecondary">No latest blog posts available.</p>
            <?php endif; ?>
        </div>

        <!-- Custom Next/Prev Buttons -->
        <div class="flex justify-center mt-5 md:mt-10 space-x-6">
            <button class="custom-prev w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition z-30 duration-300 ease-in-out hover:text-bgPrimary">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6z" />
                </svg>
            </button>
            <button class="custom-next w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition z-30 duration-300 ease-in-out hover:text-bgPrimary">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.59 16.59L13.17 12l-4.58-4.59L10 6l6 6-6 6z" />
                </svg>
            </button>
        </div>
    </div>
</div>

<?php
$stmtLatest->close();
?>



<div class="w-full flex justify-center items-center mt-16 relative">
    <div class="sm:mb-8 sm:flex mx-auto sm:justify-center max-w-[250px]">
        <a href="/blogs" class="relative rounded-full px-5 py-1 text-sm leading-6 text-textSecondary border border-1 border-textPrimary/20 hover:border-textPrimary/40 group">Dive In Blogs <span class="font-semibold text-primary">Explore <i class="fa fa-arrow-right ml-2 transition-transform duration-300 transform group-hover:translate-x-1"></i></span>
        </a>
    </div>
</div>




<!-- VIDEOGRAPHY SECTION -->
<div id="ytvideos" class="container mx-auto px-4 py-12 mb-12">
    <div class="container mx-auto text-center mt-6 mb-12">
        <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Our Videography</h2>
        <img src="<?= getAsset('heading-decoration.webp', 'images/') ?>" class="h-12 -mt-1 mx-auto" alt="Heading Decoration">
    </div>

    <div class="videography-swiper-container overflow-hidden mt-10">
        <div class="swiper-wrapper flex gap-4">
            <!-- Video Cards - Repeat the following block for each video -->
            <a class="swiper-slide relative w-full cursor-pointer rounded-md overflow-hidden aspect-video"
                href="https://www.youtube.com/watch?v=DOcGfrTkfqw" target="_blank">
                <img src="https://img.youtube.com/vi/DOcGfrTkfqw/maxresdefault.jpg" alt="Video Thumbnail"
                    class="w-full h-full object-cover rounded-md">
                <div class="absolute inset-0 flex items-center justify-center bg-textPrimary bg-opacity-30 z-30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 256 256">
                        <g fill="#Ff302C">
                            <g transform="scale(3.55556,3.55556)">
                                <path d="M61.115,18.856c2.551,2.647 2.885,6.853 2.885,17.144c0,10.291 -0.334,14.497 -2.885,17.144c-2.552,2.647 -5.209,2.856 -25.115,2.856c-19.906,0 -22.563,-0.209 -25.115,-2.856c-2.551,-2.647 -2.885,-6.853 -2.885,-17.144c0,-10.291 0.334,-14.497 2.885,-17.144c2.551,-2.647 5.209,-2.856 25.115,-2.856c19.906,0 22.563,0.209 25.115,2.856zM31.464,44.476l13.603,-8.044l-13.603,-7.918z"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="absolute bottom-4 left-4 z-30 flex items-center space-x-2">
                    <span class="text-bgPrimary text-sm font-semibold">Watch on YouTube <i class="fas fa-up-right-from-square text-bgPrimary"></i></span>
                </div>
            </a>

            <a class="swiper-slide relative w-full cursor-pointer rounded-md overflow-hidden aspect-video"
                href="https://www.youtube.com/watch?v=a4kk1vVovko" target="_blank">
                <img src="https://img.youtube.com/vi/a4kk1vVovko/maxresdefault.jpg" alt="Video Thumbnail"
                    class="w-full h-full object-cover rounded-md">
                <div class="absolute inset-0 flex items-center justify-center bg-textPrimary bg-opacity-30 z-30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 256 256">
                        <g fill="#Ff302C">
                            <g transform="scale(3.55556,3.55556)">
                                <path d="M61.115,18.856c2.551,2.647 2.885,6.853 2.885,17.144c0,10.291 -0.334,14.497 -2.885,17.144c-2.552,2.647 -5.209,2.856 -25.115,2.856c-19.906,0 -22.563,-0.209 -25.115,-2.856c-2.551,-2.647 -2.885,-6.853 -2.885,-17.144c0,-10.291 0.334,-14.497 2.885,-17.144c2.551,-2.647 5.209,-2.856 25.115,-2.856c19.906,0 22.563,0.209 25.115,2.856zM31.464,44.476l13.603,-8.044l-13.603,-7.918z"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="absolute bottom-4 left-4 z-30 flex items-center space-x-2">
                    <span class="text-bgPrimary text-sm font-semibold">Watch on YouTube <i class="fas fa-up-right-from-square text-bgPrimary"></i></span>
                </div>
            </a>

            <a class="swiper-slide relative w-full cursor-pointer rounded-md overflow-hidden aspect-video"
                href="https://www.youtube.com/watch?v=pTM_7OJpJes" target="_blank">
                <img src="https://img.youtube.com/vi/pTM_7OJpJes/maxresdefault.jpg" alt="Video Thumbnail"
                    class="w-full h-full object-cover rounded-md">
                <div class="absolute inset-0 flex items-center justify-center bg-textPrimary bg-opacity-30 z-30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 256 256">
                        <g fill="#Ff302C">
                            <g transform="scale(3.55556,3.55556)">
                                <path d="M61.115,18.856c2.551,2.647 2.885,6.853 2.885,17.144c0,10.291 -0.334,14.497 -2.885,17.144c-2.552,2.647 -5.209,2.856 -25.115,2.856c-19.906,0 -22.563,-0.209 -25.115,-2.856c-2.551,-2.647 -2.885,-6.853 -2.885,-17.144c0,-10.291 0.334,-14.497 2.885,-17.144c2.551,-2.647 5.209,-2.856 25.115,-2.856c19.906,0 22.563,0.209 25.115,2.856zM31.464,44.476l13.603,-8.044l-13.603,-7.918z"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="absolute bottom-4 left-4 z-30 flex items-center space-x-2">
                    <span class="text-bgPrimary text-sm font-semibold">Watch on YouTube <i class="fas fa-up-right-from-square text-bgPrimary"></i></span>
                </div>
            </a>
            <!-- Repeat the above block for each video -->
        </div>

        <!-- Custom Next/Prev Buttons -->
        <div class="flex justify-center mt-5 md:mt-10 space-x-6">
            <button class="custom-prev w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition z-30 duration-300 ease-in-out hover:text-bgPrimary">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6z" />
                </svg>
            </button>
            <button class="custom-next w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition z-30 duration-300 ease-in-out hover:text-bgPrimary">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.59 16.59L13.17 12l-4.58-4.59L10 6l6 6-6 6z" />
                </svg>
            </button>
        </div>
    </div>
</div>




<section class="bg-[url('<?= getAsset('cta.webp', 'images/'); ?>')] bg-cover bg-no-repeat bg-center my-10 py-10">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-bgPrimary">Capture Your Special Day</h2>
            <p class="mb-6 font-light text-bgSecondary md:text-lg">Let us create timeless memories of your wedding. Our team is ready to discuss your dream wedding photography. Call/WhatsApp</p>
            <a href="tel+916200569546" class="text-bgPrimary bg-secondary hover:bg-secondary/80 focus:ring-2 focus:ring-amber-400 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none"><i class="fa fa-phone-volume"> </i> &nbsp;Call Now</a>
        </div>
    </div>

</section>

<!-- REVIEWS SECTION -->
<div id="reviews"></div>
<div class="container mx-auto px-4 py-10">
    <div class="container mx-auto text-center mt-6 mb-12">
        <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Customer Reviews</h2>
        <img src="<?= getAsset('heading-decoration.webp', 'images/') ?>" class="h-12 -mt-1 mx-auto" alt="Heading Decoration">
    </div>
    <!-- Swiper Slider for Reviews -->
    <div class="reviews-swiper-container overflow-hidden mt-10">
        <div class="swiper-wrapper">
            <!-- Review Slide 1 -->
            <div class="swiper-slide">
                <figure class="max-w-screen-md mx-auto">
                    <svg class="h-12 mx-auto mb-3 text-textSecondary" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor" />
                    </svg>
                    <blockquote>
                        <p class="text-md font-medium text-textPrimary text-center">"Amazing service! Would 100% best wedding photography jeevansathi
                            studio recommend! The team were amazing and listened to our vision
                            and brought it to life. The photographer was phenomenal from the
                            end result of the pictures to the actual shoot. He gave direction
                            and made us feel really comfortable! Would definitely come back
                            again!"</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <img class="w-10 h-10 rounded-full" src="<?= getAsset('reviewer-1.webp', 'images/'); ?>" alt="Reviewer Image" loading="lazy">
                        <div class="flex items-center divide-x-2 divide-textSecondary">
                            <div class="pr-3 font-medium text-textPrimary">Kumar C</div>
                            <!-- <div class="pl-3 text-sm font-light text-textSecondary">Entrepreneur, Mumbai</div> -->
                        </div>
                    </figcaption>
                </figure>
            </div>

            <!-- Add more slides similarly here -->
            <!-- Review Slide 2 -->
            <div class="swiper-slide">
                <figure class="max-w-screen-md mx-auto">
                    <svg class="h-12 mx-auto mb-3 text-textSecondary" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor" />
                    </svg>
                    <blockquote>
                        <p class="text-md font-medium text-textPrimary text-center">"Thank you for going above and beyond on our wedding day.
                            Jeevansathi studio. You were so relaxed and friendly, making us
                            feel very comfortable posing for photos! It was such a pleasure to
                            work with you. guys, great job"</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <img class="w-10 h-10 rounded-full" src="<?= getAsset('reviewer-2.webp', 'images/'); ?>" alt="Reviewer Image" loading="lazy">
                        <div class="flex items-center divide-x-2 divide-textSecondary">
                            <div class="pr-3 font-medium text-textPrimary">Bharati</div>
                        </div>
                    </figcaption>
                </figure>
            </div>

            <!-- Review Slide 3 -->
            <div class="swiper-slide">
                <figure class="max-w-screen-md mx-auto">
                    <svg class="h-12 mx-auto mb-3 text-textSecondary" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor" />
                    </svg>
                    <blockquote>
                        <p class="text-md font-medium text-textPrimary text-center">"It has been an amazing experience to have the Pre-wedding shoot
                            done through Candid Wedding Stories. Sumit was professional
                            throughout and made us feel at ease. We were free to pose, suggest
                            and he captured all the moments beautifully. Thank you for giving
                            us amazing pictures. Jeevansathi Studio We loved your Team work."</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <img class="w-10 h-10 rounded-full" src="<?= getAsset('reviewer-3.webp', 'images/'); ?>" alt="Reviewer Image" loading="lazy">
                        <div class="flex items-center divide-x-2 divide-textSecondary">
                            <div class="pr-3 font-medium text-textPrimary">Pankaj K</div>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
        <!-- Custom Next/Prev Buttons -->
        <div class="flex justify-center mt-5 md:mt-10 space-x-6">
            <button class="custom-prev w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition z-30 duration-300 ease-in-out hover:text-bgPrimary">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6z" />
                </svg>
            </button>
            <button class="custom-next w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition z-30 duration-300 ease-in-out hover:text-bgPrimary">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.59 16.59L13.17 12l-4.58-4.59L10 6l6 6-6 6z" />
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- PHOTOSHOOT SECTION -->
<div id="photoshoot" class="container mx-auto px-4 py-8">
    <div class="container mx-auto text-center mt-6 mb-12">
        <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Latest PhotoShoot</h2>
        <img src="<?= getAsset('heading-decoration.webp', 'images/') ?>" class="h-12 -mt-1 mx-auto" alt="Heading Decoration">
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <?php
        $images = $imagesByLocation['photoshoot'];
        if (count($images) > 0) :
            // Handle the first large image
            $firstImage = array_shift($images);
        ?>
            <img data-category="<?= htmlspecialchars($firstImage['category']) ?>"
                data-title="<?= htmlspecialchars($firstImage['name']) ?>"
                src="<?= getAsset($firstImage['image_path'], 'images/' . UPLOADS); ?>"
                alt="<?= htmlspecialchars($firstImage['name']) ?>"
                data-aos="fade-up"
                loading="lazy"
                class="md:col-span-2 md:row-span-2 rounded-2xl w-full h-full object-cover photoshoot-item cursor-pointer hover:ring-primary ring-2 ring-transparent ring-offset-2">
            <?php
            // Handle the remaining smaller images
            foreach ($images as $image):
            ?>
                <img data-category="<?= htmlspecialchars($image['category']) ?>"
                    data-title="<?= htmlspecialchars($image['name']) ?>"
                    src="<?= getAsset($image['image_path'], 'images/' . UPLOADS); ?>"
                    alt="<?= htmlspecialchars($image['name']) ?>"
                    data-aos="fade-up"
                    loading="lazy"
                    class="w-full h-48 object-cover photoshoot-item cursor-pointer rounded-2xl hover:ring-primary ring-2 ring-transparent ring-offset-2">
        <?php
            endforeach;
        endif;
        ?>
    </div>
</div>
<!-- PRICING SECTION -->
<div id="pricing" class="container mx-auto px-4 py-16">
    <div class="container mx-auto text-center mt-6 mb-12">
        <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Pricing Plans</h2>
        <img src="<?= getAsset('heading-decoration.webp', 'images/') ?>" class="h-12 -mt-1 mx-auto" alt="Heading Decoration">
    </div>

    <div class="grid gap-8 lg:grid-cols-3 lg:gap-12">
        <div class="p-1 bg-gradient-to-tr from-secondary to-primary rounded-lg">
            <div class="flex flex-col p-6 pb-[104px] text-center bg-bgPrimary rounded-lg border border-textSecondary relative">
                <h3 class="mb-4 text-2xl font-semibold text-textPrimary">Silver</h3>
                <p class="font-light text-textSecondary sm:text-lg">Best option for personal use & for your next project.</p>
                <div class="my-8">
                    <span class="text-4xl font-extrabold text-textPrimary">49,999/-</span>
                </div>
                <ul class="mb-[136px] space-y-4 text-left mx-auto">
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-yellow-500"></i>
                        <span class="text-textPrimary">Photo Album: <span class="font-semibold">250 - 300</span></span>
                    </li>

                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-yellow-500"></i>
                        <span class="text-textPrimary">Video highlight + Long Video.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-yellow-500"></i>
                        <span class="text-textPrimary">Two Day Wedding Cinematography.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Two Day Wedding Photography.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">All Soft Copy Video On PenDrive.</span>
                    </li>
                </ul>
                <a href="/get-a-quote" class="text-bgPrimary bg-primary hover:ring-2 hover:ring-primary ring-offset-2 font-medium rounded-full text-sm px-5 py-2.5 text-center w-[120px] absolute bottom-6 left-1/2 transform -translate-x-1/2">
                    Get started
                </a>
            </div>
        </div>

        <div class="p-1 bg-gradient-to-tr from-secondary to-primary rounded-lg">
            <div class="flex flex-col p-6 pb-[104px] text-center bg-bgPrimary rounded-lg border border-textSecondary relative">
                <h3 class="mb-4 text-2xl font-semibold text-textPrimary">Gold</h3>
                <p class="font-light text-textSecondary sm:text-lg">Ideal for those seeking a more comprehensive package.</p>
                <div class="my-8">
                    <span class="text-4xl font-extrabold text-textPrimary">99,999/-</span>
                </div>
                <ul class="mb-24 space-y-4 text-left mx-auto">
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-yellow-500"></i>
                        <span class="text-textPrimary">Two Day Wedding Photography.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-yellow-500"></i>
                        <span class="text-textPrimary">Video highlight + Teaser + Long Video.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Photo Album: <span class="font-semibold">300 - 350</span></span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Photo + Candid.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Video + Cinematography.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">All Soft Copy Video On PenDrive.</span>
                    </li>
                </ul>
                <a href="/get-a-quote" class="text-bgPrimary bg-primary hover:ring-2 hover:ring-primary ring-offset-2 font-medium rounded-full text-sm px-5 py-2.5 text-center w-[120px] absolute bottom-6 left-1/2 transform -translate-x-1/2">
                    Get started
                </a>
            </div>
        </div>

        <div class="p-1 bg-gradient-to-tr from-secondary to-primary rounded-lg">
            <div class="flex flex-col p-6 pb-[104px] text-center bg-bgPrimary rounded-lg border border-textSecondary relative">
                <h3 class="mb-4 text-2xl font-semibold text-textPrimary">Deluxe</h3>
                <p class="font-light text-textSecondary sm:text-lg">Perfect for those looking for a premium experience.</p>
                <div class="my-8">
                    <span class="text-4xl font-extrabold text-textPrimary">149,999/-</span>
                </div>

                <ul class="mb-12 space-y-4 text-left mx-auto">
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Pre-Wedding + Two Day Wedding Photography.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Pre-Wedding + Photo + Video.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Video highlight + Teaser + Reel + Long Video.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Photo Album: <span class="font-semibold">300 - 350</span></span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Wedding Day Photo + Candid.</span>
                    </li>
                    <li class="flex items-center space-x-3 mx-auto">
                        <i class="fa fa-check text-green-500"></i>
                        <span class="text-textPrimary">Video + Cinematography.</span>
                    </li>
                </ul>
                <a href="/get-a-quote" class="text-bgPrimary bg-primary hover:ring-2 hover:ring-primary ring-offset-2 font-medium rounded-full text-sm px-5 py-2.5 text-center w-[120px] absolute bottom-6 left-1/2 transform -translate-x-1/2">
                    Get started
                </a>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT SECTION  -->
<div class="my-20" id="contact"></div>
<div class="container mx-auto px-4">
    <div class="container mx-auto text-center mt-6 mb-12">
        <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Contact Us</h2>
        <img src="<?= getAsset('heading-decoration.webp', 'images/') ?>" class="h-12 -mt-1 mx-auto" alt="Heading Decoration">
    </div>
    <div class="md:flex mt-6 mb-10 md:space-x-10 items-start z-1">
        <div class="md:w-6/12 md:mt-0">
            <ul class="my-6 md:mb-0">
                <li class="flex my-4">
                    <div class="flex min-w-10 min-h-10 max-w-10 max-h-10 items-center justify-center rounded bg-primary text-bgPrimary">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="mx-4 mb-4">
                        <h3 class="mb-2 text-lg font-medium leading-6 text-textPrimary">Reach Us</h3>
                        <p class="text-textSecondary my-2">We’re here to capture your special moments. Contact us <br>to discuss your wedding photography needs and get a personalized quote.</p>
                        <p class="text-textSecondary my-2">Website: <a href="https://wa.me/+916200569546" target="_blank" class="text-primary font-medium hover:underline" target="_blank">Get a quote</a></p>
                        <p class="text-textSecondary my-2">Phone Call: <a href="tel:+916200569546" class="text-primary font-medium hover:underline" target="_blank">+91-6200569546</a></p>
                        <p class="text-textSecondary my-2">WhatsApp: <a href="https://wa.me/+916200569546" class="text-primary font-medium hover:underline" target="_blank">+91-6200569546</a></p>
                        <p class="text-textSecondary my-2">E-Mail: <a href="mailto:help@jeevansathistudio.in" class="text-primary font-medium hover:underline" target="_blank">Help@Jeevansathistudio.in</a></p>
                    </div>
                </li>
                <li class="flex my-4">
                    <div class="flex min-w-10 min-h-10 max-w-10 max-h-10 items-center justify-center rounded bg-primary text-bgPrimary">
                        <i class="fa fa-location-dot"></i>
                    </div>
                    <div class="ml-4 mb-4">
                        <h3 class="mb-2 text-lg font-medium leading-6 text-textPrimary">Our Address
                        </h3>
                        <p class="text-textSecondary">Prema comlex Bhagwanpur
                            Muzaffarpur</p>
                        <p class="text-textSecondary">Bihar 842001 India <a href="https://maps.app.goo.gl/UHsuFMJm2epT3n7K6" target="_blank" title="Open Google Maps"><i class="fas fa-up-right-from-square text-primary"></i></a></p>
                    </div>
                </li>
            </ul>
        </div>
        <form
            onsubmit="handleFormSubmit(event,'contactform','.contact-form-btn-spinner','.contact-form-btn-text','.contact-form-response-text')"
            class="md:w-6/12">
            <div class="grid grid-cols-1 gap-x-8 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-semibold leading-6 text-textPrimary">Name *</label>
                    <div class="mb-2.5">
                        <input type="text" name="name" id="name" autocomplete="given-name"
                            class="block w-full rounded-md border border-textSecondary px-3.5 py-2 text-textPrimary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-semibold leading-6 text-textPrimary">Email (Optional)</label>
                    <div class="mb-2.5">
                        <input type="email" name="email" id="email" autocomplete="email"
                            class="block w-full rounded-md border border-textSecondary px-3.5 py-2 text-textPrimary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="phone" class="block text-sm font-semibold leading-6 text-textPrimary">Phone *</label>
                    <div class="mb-2.5">
                        <input type="tel" name="phone" id="phone" autocomplete="phone"
                            class="block w-full rounded-md border border-textSecondary px-3.5 py-2 text-textPrimary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block text-sm font-semibold leading-6 text-textPrimary">Message *</label>
                    <div class="">
                        <textarea name="message" id="message" rows="4"
                            class="block w-full rounded-md border border-textSecondary px-3.5 py-2 text-textPrimary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 sm:text-sm sm:leading-6"
                            required></textarea>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-start">

                    <button type="submit"
                        class="inline-flex items-center block rounded-full bg-primary center text-sm font-semibold text-bgPrimary shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary  px-3.5 py-2.5"> <svg class="w-5 h-5 mx-auto text-bgPrimary animate-spin contact-form-btn-spinner hidden"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span class="contact-form-btn-text font-semibold text-bgPrimary">Let's talk <i class="fa fa-send ml-2 text-bgPrimary" aria-hidden="true"></i></span>
                    </button>
                    <div class="ml-2">
                        <p class="contact-form-response-text font-semibold text-sm text-textPrimary"></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>