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
$initialImage = !empty($heroImages) ? $heroImages[0] : getAsset('default-hero.jpg', 'images/');
?>

<!-- Preload hero images -->

<head>
    <?php foreach ($heroImages as $image): ?>
        <link rel="preload" href="<?= $image ?>" as="image">
    <?php endforeach; ?>
</head>

<!-- HERO SECTION -->
<div id="hero-section" class="relative isolate bg-cover bg-no-repeat cursor-pointer overflow-hidden" style="background-image: url('<?= $initialImage ?>');" ondblclick="changeBackgroundImage()">
    <div class="w-full h-full bg-slate-950/30 px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-32 sm:py-40 lg:py-28">
            <div class="text-center">
                <img src="<?= getAsset('logo.svg', 'images/svgs/'); ?>" alt="Logo" class="rounded-full mx-auto w-24 h-24">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Capture the Essence of Your
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-secondary to-primary font-bold">Indian Wedding</span>
                </h1>
                <p class="mt-3 text-lg leading-5 text-white/90">Experience the magic of your special day through the lens of our talented Indian wedding photographers.</p>
                <div class="mt-6 flex items-center justify-center gap-x-6">
                    <a href="/#about" class="rounded-full bg-primary px-4 py-2.5 text-sm font-semibold text-bgPrimary shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary transition group">Learn more <i class="fa fa-arrow-down ml-2 transition-transform duration-300 transform group-hover:translate-y-1"></i></a>
                </div>
                <div class="flex items-center justify-center">
                    <div class="mt-10 text-center ring-1 ring-white rounded-full w-8 h-12 flex items-center justify-center">
                        <div class="w-3 h-3 rounded-full bg-white animate-ping"></div>
                    </div>
                </div>
                <p class="mt-8 text-sm font-medium text-white">Double tap to change background Image.</p>
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
    <div class="md:flex mt-20 mb-10 md:space-x-10 items-start relative -z-10">
        <div data-aos="fade-down" class="md:w-5/12 mt-20 md:mt-0 05xs:px-3">
            <h1 class="text-3xl mb-1 font-bold text-textPrimary lg:pr-40">
                Who Are We?</span>
            </h1>

            <p class="text-justify text-textSecondary">
                I am Rajesh kumar, owner of the Jeevansathi Studios, Photography based in Muzaffarpur. My team and I have been working since Jan-2009 & have covered more than 3k+ weddings. Jeevansathi Studio in Muzaffarpur is one of the leading businesses in the Photographers. Also known for Wedding Photographers, Photographers, Wedding Video Shooting Services, Video Shooting Services, Pre Wedding Photographers, Photographers For Portfolio, Outdoor Photographers, Model Portfolio and much more. Find Address, Contact Number, Reviews & Ratings, Photos, Maps of Jeevansathi Studio, Muzaffarpur !!!!
            </p>
        </div>


        <div data-aos="fade-down" class="md:w-7/12 mt-20 md:mt-0 relative">
            <div
                class="w-32 h-32 rounded-full bg-amber-300 absolute -z-10 left-5 -top-10 animate-pulse"></div>

            <div
                class="w-5 h-5 rounded-full absolute bg-secondary -z-10 left-36 -top-12 animate-ping"></div>

            <img
                class="w-11/12 mx-auto md:ml-auto rounded-md -z-10 brightness-90 floating bg-gray-200"
                src="<?= getAsset('about-featured.jpg', 'images/'); ?>"
                loading="lazy"
                alt="About Image" />

            <div class="w-36 h-36 rounded-full bg-primary absolute -z-10 right-3 -bottom-8 animate-pulse"></div>

            <div class="w-5 h-5 rounded-full absolute -z-10 bg-secondary right-36 -bottom-12 animate-ping"></div>
        </div>
    </div>
</div>

<!-- STATS SECTION  -->
<div id="stats"></div>
<div class="container mx-auto">
    <div class="py-24 sm:py-10 mt-10">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-textSecondary">Weddings Covered</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-textPrimary sm:text-5xl count" data-count="3000">0+</dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-textSecondary">Photos Delivered</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-textPrimary sm:text-5xl count" data-count="1200000">0</dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-textSecondary">Happy Clients</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-textPrimary sm:text-5xl count" data-count="2500">0+</dd>
                </div>
            </dl>
        </div>
    </div>
</div>

<!-- SERVICES SECTION -->
<div id="services" class="py-12 mb-12">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="container mx-auto text-center my-6">
            <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Our Services</h2>
            <p class="max-w-2xl mx-auto py-2 text-lg text-textSecondary">
                From candid wedding moments to vibrant birthday celebrations and dynamic social events, we ensure that each memory is captured with creativity and professionalism.
            </p>
        </div>

        <!-- Swiper Container -->
        <div class="relative">
            <div class="services-swiper-container overflow-hidden mx-auto max-w-[90%]">
                <div class="swiper-wrapper mb-8">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col h-12 w-12 items-center justify-center rounded-lg bg-primary">
                                <img src="<?= getAsset('wedding-photoshoot-service.svg', 'images/svgs/'); ?>" alt="Wedding PhotoShoot" loading="lazy" />
                            </div>
                            <div>
                                <span class="text-base font-semibold leading-7 text-textPrimary">
                                    Wedding PhotoShoot
                                </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">We are one of the best wedding photo photographers in town ,
                                    capture your special day with us .</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col h-12 w-12 items-center justify-center rounded-lg bg-primary">
                                <img src="<?= getAsset('pre-wedding-photoshoot-service.svg', 'images/svgs/'); ?>" alt="Pre Wedding Shoots" loading="lazy" />
                            </div>
                            <div>
                                <span class="text-base font-semibold leading-7 text-textPrimary">
                                    Pre Wedding Shoots
                                </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">If marriages are said to be made in heaven then we make sure to
                                    capture your most beautiful memories through our lens.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col h-12 w-12 items-center justify-center rounded-lg bg-primary">
                                <img src="<?= getAsset('photographers-for-functions-service.svg', 'images/svgs/'); ?>" alt="PhotoGraphers For Function" loading="lazy" />
                            </div>
                            <div>
                                <span class="text-base font-semibold leading-7 text-textPrimary">
                                    PhotoGraphers For Function
                                </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">Want a memory for life time? Contact us & we will provide the
                                    best best quality photographs with our expert team.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col h-12 w-12 items-center justify-center rounded-lg bg-primary">
                                <img src="<?= getAsset('cadid-wedding-photographers-service.svg', 'images/svgs/'); ?>" alt="Candid Wedding PhotoGraphers" loading="lazy" />
                            </div>
                            <div>
                                <span class="text-base font-semibold leading-7 text-textPrimary">
                                    Candid Wedding PhotoGraphers
                                </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">Hire the best phtotographers who can sense the candidates of the
                                    wedding moment and click the best.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col h-12 w-12 items-center justify-center rounded-lg bg-primary">
                                <img src="<?= getAsset('birthday-shoot-service.svg', 'images/svgs/'); ?>" alt="BirthDay PhotoShoot" loading="lazy" />
                            </div>
                            <div>
                                <span class="text-base font-semibold leading-7 text-textPrimary">
                                    BirthDay PhotoShoot
                                </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">Picture Your Joy: Expertly crafted birthday photoshoots capturing
                                    every moment beautifully, creating unforgettable memories.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative w-[80%] mx-auto md:w-auto flex flex-col justify-center items-center text-center gap-3">
                            <div class="flex flex-col h-12 w-12 items-center justify-center rounded-lg bg-primary">
                                <img src="<?= getAsset('social-photography-service.svg', 'images/svgs/'); ?>" alt="Social PhotoGraphy" loading="lazy" />
                            </div>
                            <div>
                                <span class="text-base font-semibold leading-7 text-textPrimary">
                                    Social PhotoGraphy
                                </span>
                                <p class="mt-2 text-base leading-6 text-textSecondary">Social and influencer photography blends lifestyle and branding,
                                    creating visuals that boost personal and commercial appeal.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Custom Navigation Buttons -->
                <div class="custom-prev absolute left-0 top-1/2 -mt-10 transform -translate-y-1/2">
                    <button class="w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition duration-300 ease-in-out hover:text-bgPrimary">
                        <!-- Icon for prev -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                </div>
                <div class="custom-next absolute right-0 top-1/2 -mt-10 transform -translate-y-1/2">
                    <button class="w-8 h-8 flex items-center border-2 border-primary  justify-center rounded-full hover:bg-primary text-primary transition duration-300 ease-in-out hover:text-bgPrimary">
                        <!-- Icon for next -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                <!-- Pagination -->
                <div class="custom-pagination text-center"></div>
            </div>
        </div>
    </div>
</div>


<!-- GALLERY SECTION -->
<div id="gallery"></div>
<div class="container mx-auto px-4 mt-16 mb-24">
    <!-- Header and Description -->
    <div class="flex flex-col items-center justify-center w-full xss:p-0 mx-auto my-6 text-center xl:px-0">
        <h2 class="max-w-2xl xss:px-10 md:px-0 text-3xl font-bold leading-snug tracking-tight text-textPrimary lg:leading-tight lg:text-4xl">Gallery</h2>
        <p class="max-w-2xl py-2 text-lg leading-normal text-textSecondary">
            Explore our stunning collection of Indian wedding photography. From vibrant ceremonies to intimate moments, each image tells a unique story.
        </p>
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
            <div>
                <img class="main-image min-h-[300px] max-h-[380px] bg-gray-200 max-w-full mx-auto rounded-lg" src="" alt="Open Modal Image" loading="lazy">
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

<div class="container mx-auto px-4">
    <div class="flex flex-col items-center justify-center w-full xss:p-0 mx-auto my-6 text-center xl:px-0">
        <h2 class="max-w-2xl xss:px-10 md:px-0 text-3xl font-bold leading-snug tracking-tight text-textPrimary lg:leading-tight lg:text-4xl">Latest Blogs</h2>
        <p class="max-w-2xl py-2 text-lg leading-normal text-textSecondary">
            Stay updated with our latest insights, trends, and industry news. Explore our diverse range of topics to expand your knowledge.
        </p>
    </div>

    <div class="blogs-swiper-container overflow-hidden mt-10">
        <div class="swiper-wrapper flex gap-6">
            <?php if ($resultLatest->num_rows > 0): ?>
                <?php while ($row = $resultLatest->fetch_assoc()): ?>
                    <div onclick="redirect('/blog/<?= $row['slug']; ?>')" class="swiper-slide relative w-full sm:w-[calc(50%-12px)] cursor-pointer rounded-md overflow-hidden">
                        <img src="<?= getAsset($row['image'], 'images/' . UPLOADS); ?>" alt="<?= htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-full sm:h-auto object-cover z-20" loading="lazy">
                        <div class="absolute top-0 left-0 p-4 flex flex-col justify-end w-full h-full z-30 bg-textPrimary/50">
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
        <div class="relative rounded-full px-5 py-1 text-sm leading-6 text-textSecondary ring-1 ring-text-textPrimary-900/10 hover:ring-textPrimary/20">Check more Blogs <a href="/blogs" class="font-semibold text-primary group">View all <i class="fa fa-arrow-right ml-2 transition-transform duration-300 transform group-hover:translate-x-1"></i></a>
        </div>
    </div>
</div>


<!-- VIDEOGRAPHY SECTION -->
<div id="ytvideos" class="py-12 mb-12">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="container mx-auto text-center my-6">
            <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Our Videography</h2>
            <p class="max-w-2xl mx-auto py-2 text-lg text-textSecondary">
                Experience the magic of our videography services through these highlights. Each video captures the essence of Indian weddings with stunning visuals and heartfelt moments.
            </p>
        </div>

        <!-- Swiper Container -->
        <div class="relative">
            <div class="videography-swiper-container overflow-hidden mx-auto max-w-[90%]">
                <div class="swiper-wrapper mb-12">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <iframe src="https://www.youtube.com/embed/ardtvdR28SQ?si=RkEUcEXLoF5Se1pf" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full h-[200px] md:h-[304px] rounded-md z-20" loading="lazy"></iframe>
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <iframe src="https://www.youtube.com/embed/ardtvdR28SQ?si=RkEUcEXLoF5Se1pf" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full h-[200px] md:h-[304px] rounded-md z-20" loading="lazy"></iframe>
                    </div>
                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <iframe src="https://www.youtube.com/embed/ardtvdR28SQ?si=RkEUcEXLoF5Se1pf" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full h-[200px] md:h-[304px] rounded-md z-20" loading="lazy"></iframe>
                    </div>
                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <iframe src="https://www.youtube.com/embed/ardtvdR28SQ?si=RkEUcEXLoF5Se1pf" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full h-[200px] md:h-[304px] rounded-md z-20" loading="lazy"></iframe>
                    </div>
                </div>


                <!-- Custom Navigation Buttons -->
                <div class="custom-prev absolute left-0 top-1/2 -mt-10 transform -translate-y-1/2">
                    <button class="w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition z-30 duration-300 ease-in-out hover:text-bgPrimary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                </div>
                <div class="custom-next absolute right-0 top-1/2 -mt-10 transform -translate-y-1/2">
                    <button class="w-8 h-8 flex items-center border-2 border-primary justify-center rounded-full hover:bg-primary text-primary transition z-30 duration-300 ease-in-out hover:text-bgPrimary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                <!-- Pagination -->
                <div class="custom-pagination text-center"></div>
            </div>
        </div>
    </div>
</div>


<section class="bg-[url('<?= getAsset('cta.jpg', 'images/'); ?>')] bg-cover bg-no-repeat bg-center my-10 py-10">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-bgPrimary">Capture Your Special Day</h2>
            <p class="mb-6 font-light text-bgSecondary md:text-lg">Let us create timeless memories of your wedding. Our team is ready to discuss your dream wedding photography. Call/WhatsApp</p>
            <a href="tel+916200569546" class="text-bgPrimary bg-amber-500 hover:bg-amber-400 focus:ring-2 focus:ring-amber-400 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none"><i class="fa fa-phone-volume"> </i> &nbsp;Call Now</a>
        </div>
    </div>

</section>

<!-- REVIEWS SECTION -->
<div id="reviews"></div>
<div class="container mx-auto px-4 py-10">
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
                        <p class="text-xl font-medium text-textPrimary text-center">"Amazing service! Would 100% best wedding photography jeevansathi
                            studio recommend! The team were amazing and listened to our vision
                            and brought it to life. The photographer was phenomenal from the
                            end result of the pictures to the actual shoot. He gave direction
                            and made us feel really comfortable! Would definitely come back
                            again!"</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <img class="w-6 h-6 rounded-full" src="<?= getAsset('reviewer-1.jpg', 'images/'); ?>" alt="Reviewer Image" loading="lazy">
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
                        <p class="text-xl font-medium text-textPrimary text-center">"Thank you for going above and beyond on our wedding day.
                            Jeevansathi studio. You were so relaxed and friendly, making us
                            feel very comfortable posing for photos! It was such a pleasure to
                            work with you. guys, great job"</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <img class="w-6 h-6 rounded-full" src="<?= getAsset('reviewer-2.jpg', 'images/'); ?>" alt="Reviewer Image" loading="lazy">
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
                        <p class="text-xl font-medium text-textPrimary text-center">"It has been an amazing experience to have the Pre-wedding shoot
                            done through Candid Wedding Stories. Sumit was professional
                            throughout and made us feel at ease. We were free to pose, suggest
                            and he captured all the moments beautifully. Thank you for giving
                            us amazing pictures. Jeevansathi Studio We loved your Team work."</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <img class="w-6 h-6 rounded-full" src="<?= getAsset('reviewer-3.jpg', 'images/'); ?>" alt="Reviewer Image" loading="lazy">
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
    <div class="mx-auto text-center my-6">
        <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Latest PhotoShoot</h2>
        <p class="max-w-2xl mx-auto py-2 text-lg text-textSecondary">
            From candid weddings to lively birthday celebrations, we capture every moment with creativity and professionalism.
        </p>
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
                class="md:col-span-2 md:row-span-2 rounded-2xl w-full h-full object-cover photoshoot-item cursor-pointer">
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
                    class="w-full h-48 object-cover photoshoot-item cursor-pointer rounded-2xl">
        <?php
            endforeach;
        endif;
        ?>
    </div>
</div>



<!-- PRICING SECTION  -->
<div id="pricing"></div>
<div class="container mx-auto px-4">
    <div class="flex flex-col items-center justify-center w-full mx-auto mt-10 py-10 text-center">
        <h2 class="max-w-2xl text-3xl font-bold leading-snug tracking-tight text-textPrimary lg:leading-tight lg:text-4xl">
            Pricing Plans
        </h2>
        <p class="max-w-2xl py-2 text-lg leading-normal text-textSecondary">
            Discover our flexible pricing plans designed to fit every budget and need. Choose the perfect package to capture your special moments.
        </p>
    </div>
    <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 -z-10 lg:space-y-0">
        <!-- Pricing Card -->
        <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-textPrimary bg-bgPrimary rounded-lg border border-textSecondary shadow xl:p-8">
            <h3 class="mb-4 text-2xl font-semibold text-textPrimary">Silver</h3>
            <p class="font-light text-textSecondary sm:text-lg">Best option for personal use & for your next project.</p>
            <div class="flex justify-center items-baseline my-8">
                <span class="mr-2 text-5xl font-extrabold text-textPrimary">$29</span>
            </div>
            <!-- List -->
            <ul role="list" class="mb-8 space-y-4 text-left">
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Individual configuration</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">No setup, or hidden fees</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Team size: <span class="font-semibold">1 developer</span></span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Premium support: <span class="font-semibold">6 months</span></span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Free updates: <span class="font-semibold">6 months</span></span>
                </li>
            </ul>
            <a href="/get-a-quote" class="text-bgPrimary bg-primary focus:ring-2 focus:ring-primary ring-offset-2 font-medium rounded-full text-sm px-5 py-2.5 text-center w-[120px] mx-auto">Get started</a>
        </div>
        <!-- Pricing Card -->
        <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-textPrimary bg-bgPrimary rounded-lg border border-textSecondary shadow xl:p-8">
            <h3 class="mb-4 text-2xl font-semibold text-textPrimary">Gold</h3>
            <p class="font-light text-textSecondary sm:text-lg">Relevant for multiple users, extended & premium support.</p>
            <div class="flex justify-center items-baseline my-8">
                <span class="mr-2 text-5xl font-extrabold text-textPrimary">$99</span>
            </div>
            <!-- List -->
            <ul role="list" class="mb-8 space-y-4 text-left">
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Individual configuration</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">No setup, or hidden fees</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Team size: <span class="font-semibold">10 developers</span></span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Premium support: <span class="font-semibold">24 months</span></span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Free updates: <span class="font-semibold">24 months</span></span>
                </li>
            </ul>
            <a href="/get-a-quote" class="text-bgPrimary bg-primary focus:ring-2 focus:ring-primary ring-offset-2 font-medium rounded-full text-sm px-5 py-2.5 text-center w-[120px] mx-auto">Get started</a>
        </div>
        <!-- Pricing Card -->
        <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-textPrimary bg-bgPrimary rounded-lg border border-textSecondary shadow xl:p-8">
            <h3 class="mb-4 text-2xl font-semibold text-textPrimary">Deluxe</h3>
            <p class="font-light text-textSecondary sm:text-lg">Best for large scale uses and extended redistribution rights.</p>
            <div class="flex justify-center items-baseline my-8">
                <span class="mr-2 text-5xl font-extrabold text-textPrimary">$499</span>
            </div>
            <!-- List -->
            <ul role="list" class="mb-8 space-y-4 text-left">
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Individual configuration</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">No setup, or hidden fees</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Team size: <span class="font-semibold">100+ developers</span></span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Premium support: <span class="font-semibold">36 months</span></span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fa fa-check text-green-500 flex-shrink w-5 h-5"></i>
                    <span class="text-text-Primary">Free updates: <span class="font-semibold">36 months</span></span>
                </li>
            </ul>
            <a href="/get-a-quote" class="text-bgPrimary bg-primary focus:ring-2 focus:ring-primary ring-offset-2 font-medium rounded-full text-sm px-5 py-2.5 text-center w-[120px] mx-auto">Get started</a>
        </div>
    </div>
</div>



<!-- CONTACT SECTION  -->
<div class="my-20" id="contact"></div>
<div class="container mx-auto px-4">
    <div class="flex flex-col items-center justify-center w-full xss:p-0 mx-auto mt-10 py-10 text-center xl:px-0">
        <h2 class="max-w-2xl xss:px-10 md:px-0 text-3xl font-bold leading-snug tracking-tight text-textPrimary lg:leading-tight lg:text-4xl">Contact Us</h2>
        <p class="max-w-2xl py-2 text-lg leading-normal text-textSecondary">
            Have questions or need assistance? Get in touch with us and let’s make your wedding memories unforgettable. We’re here to help!
        </p>
    </div>
    <div class="md:flex mt-6 mb-10 md:space-x-10 items-start z-1">
        <div class="md:w-6/12 md:mt-0">
            <ul class="my-6 md:mb-0">
                <li class="flex my-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded bg-primary text-bgPrimary">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="mx-4 mb-4">
                        <h3 class="mb-2 text-lg font-medium leading-6 text-textPrimary">Reach Us</h3>
                        <p class="text-textSecondary my-2">We’re here to capture your special moments. Contact us <br>to discuss your wedding photography needs and get a personalized quote.</p>
                        <p class="text-textSecondary my-2">Website: <a href="/get-a-quote" class="text-primary font-medium hover:underline" target="_blank">Get a quote</a></p>
                        <p class="text-textSecondary my-2">Phone Call: <a href="tel:+916200569546" class="text-primary font-medium hover:underline" target="_blank">+91-6200569546</a></p>
                        <p class="text-textSecondary my-2">WhatsApp: <a href="https://wa.me/+916200569546" class="text-primary font-medium hover:underline" target="_blank">+91-6200569546</a></p>
                        <p class="text-textSecondary my-2">E-Mail: <a href="mailto:help@jeevansathistudio.in" class="text-primary font-medium hover:underline" target="_blank">Help@Jeevansathistudio.in</a></p>
                    </div>
                </li>
                <li class="flex my-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded bg-primary text-bgPrimary">
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