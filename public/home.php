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

            <!-- <div class="my-6 z-30 flex -ml-5">
                <a href="https://www.facebook.com/RAJESHPHOTOGRAPHY761995/" target="_blank" class="h-8 w-8 flex items-center justify-center transition rounded-full outline-none focus:outline-none mx-2 hover:scale-110" rel="dofollow" aria-label="Facebook">
                    <i class="fab fa-facebook-f text-2xl text-blue-500"></i>
                </a>
                <a href="https://wa.me/+916200569546" target="_blank" class="h-8 w-8 flex items-center justify-center transition rounded-full outline-none focus:outline-none mx-2 hover:scale-110" rel="dofollow" aria-label="Whatsapp">
                    <i class="fab fa-whatsapp text-2xl text-green-500"></i>
                </a>
                <a href="https://www.instagram.com/jeevansathistudio/" target="_blank" class="h-8 w-8 flex items-center justify-center transition rounded-full outline-none focus:outline-none mx-2 hover:scale-110" rel="dofollow" aria-label="Instagram">
                    <i class="fab fa-instagram text-2xl text-pink-500"></i>
                </a>
                <a href="mailto:help@jeevansathistudio.in" target="_blank" class="h-8 w-8 flex items-center justify-center transition rounded-full outline-none focus:outline-none mx-2 hover:scale-110" rel="dofollow" aria-label="Email">
                    <i class="far fa-envelope text-2xl text-indigo-400"></i>
                </a>
                <a href="https://www.youtube.com/channel/UC5kEtpOMRrAtcMpzDCXZjQg" target="_blank" class="h-8 w-8 flex items-center justify-center transition rounded-full outline-none focus:outline-none mx-2 hover:scale-110" rel="dofollow" aria-label="YouTube">
                    <i class="fab fa-youtube text-2xl text-red-500"></i>
                </a>
                <a href="tel:+916200569546" target="_blank" class="h-4 w-4 flex items-center justify-center transition rounded-full outline-none focus:outline-none m-2 mx-3 hover:scale-110" rel="dofollow" aria-label="Phone">
                    <i class="fa fa-phone-volume text-2xl text-green-500"></i>
                </a>
            </div> -->

            <div class="h-auto py-4 flex items-center justify-center md:justify-start gap-4 flex-wrap">
                <a href="https://www.facebook.com/RAJESHPHOTOGRAPHY761995/" target="_blank" class="group transition-all duration-500 hover:-translate-y-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 93 92" fill="none">
                        <rect x="1.13867" width="91.5618" height="91.5618" rx="15" fill="#337FFF" />
                        <path d="M57.4233 48.6403L58.7279 40.3588H50.6917V34.9759C50.6917 32.7114 51.8137 30.4987 55.4013 30.4987H59.1063V23.4465C56.9486 23.1028 54.7685 22.9168 52.5834 22.8901C45.9692 22.8901 41.651 26.8626 41.651 34.0442V40.3588H34.3193V48.6403H41.651V68.671H50.6917V48.6403H57.4233Z" fill="white" />
                    </svg>
                </a>
                <a href="https://wa.me/+916200569546" target="_blank" class="group transition-all duration-500 hover:-translate-y-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 93 92" fill="none">
                        <rect x="1.13867" width="91.5618" height="91.5618" rx="15" fill="#00D95F" />
                        <path d="M23.5068 66.8405L26.7915 54.6381C24.1425 49.8847 23.3009 44.3378 24.4211 39.0154C25.5413 33.693 28.5482 28.952 32.89 25.6624C37.2319 22.3729 42.6173 20.7554 48.0583 21.1068C53.4992 21.4582 58.6306 23.755 62.5108 27.5756C66.3911 31.3962 68.7599 36.4844 69.1826 41.9065C69.6053 47.3286 68.0535 52.7208 64.812 57.0938C61.5705 61.4668 56.8568 64.5271 51.5357 65.7133C46.2146 66.8994 40.6432 66.1318 35.8438 63.5513L23.5068 66.8405ZM36.4386 58.985L37.2016 59.4365C40.6779 61.4918 44.7382 62.3423 48.7498 61.8555C52.7613 61.3687 56.4987 59.5719 59.3796 56.7452C62.2605 53.9185 64.123 50.2206 64.6769 46.2279C65.2308 42.2351 64.445 38.1717 62.4419 34.6709C60.4388 31.1701 57.331 28.4285 53.6027 26.8734C49.8745 25.3184 45.7352 25.0372 41.8299 26.0736C37.9247 27.11 34.4729 29.4059 32.0124 32.6035C29.5519 35.801 28.2209 39.7206 28.2269 43.7514C28.2237 47.0937 29.1503 50.3712 30.9038 53.2192L31.3823 54.0061L29.546 60.8167L36.4386 58.985Z" fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M54.9566 46.8847C54.5093 46.5249 53.9856 46.2716 53.4254 46.1442C52.8651 46.0168 52.2831 46.0186 51.7236 46.1495C50.8831 46.4977 50.3399 47.8134 49.7968 48.4713C49.6823 48.629 49.514 48.7396 49.3235 48.7823C49.133 48.8251 48.9335 48.797 48.7623 48.7034C45.6849 47.5012 43.1055 45.2965 41.4429 42.4475C41.3011 42.2697 41.2339 42.044 41.2557 41.8178C41.2774 41.5916 41.3862 41.3827 41.5593 41.235C42.165 40.6368 42.6098 39.8959 42.8524 39.0809C42.9063 38.1818 42.6998 37.2863 42.2576 36.5011C41.9157 35.4002 41.265 34.42 40.3825 33.6762C39.9273 33.472 39.4225 33.4036 38.9292 33.4791C38.4359 33.5546 37.975 33.7709 37.6021 34.1019C36.9548 34.6589 36.4411 35.3537 36.0987 36.135C35.7562 36.9163 35.5939 37.7643 35.6236 38.6165C35.6256 39.0951 35.6864 39.5716 35.8046 40.0354C36.1049 41.1497 36.5667 42.2144 37.1754 43.1956C37.6145 43.9473 38.0937 44.6749 38.6108 45.3755C40.2914 47.6767 42.4038 49.6305 44.831 51.1284C46.049 51.8897 47.3507 52.5086 48.7105 52.973C50.1231 53.6117 51.6827 53.8568 53.2237 53.6824C54.1018 53.5499 54.9337 53.2041 55.6462 52.6755C56.3588 52.1469 56.9302 51.4518 57.3102 50.6512C57.5334 50.1675 57.6012 49.6269 57.5042 49.1033C57.2714 48.0327 55.836 47.4007 54.9566 46.8847Z" fill="white" />
                    </svg>
                </a>
                <a href="https://www.instagram.com/jeevansathistudio/" target="_blank" class="group transition-all duration-500 hover:-translate-y-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 93 92" fill="none">
                        <rect x="1.13867" width="91.5618" height="91.5618" rx="15" fill="url(#paint0_linear_7092_54439)" />
                        <path d="M38.3762 45.7808C38.3762 41.1786 42.1083 37.4468 46.7132 37.4468C51.3182 37.4468 55.0522 41.1786 55.0522 45.7808C55.0522 50.383 51.3182 54.1148 46.7132 54.1148C42.1083 54.1148 38.3762 50.383 38.3762 45.7808ZM33.8683 45.7808C33.8683 52.8708 39.619 58.618 46.7132 58.618C53.8075 58.618 59.5581 52.8708 59.5581 45.7808C59.5581 38.6908 53.8075 32.9436 46.7132 32.9436C39.619 32.9436 33.8683 38.6908 33.8683 45.7808ZM57.0648 32.4346C57.0646 33.0279 57.2404 33.608 57.5701 34.1015C57.8997 34.595 58.3684 34.9797 58.9168 35.2069C59.4652 35.4342 60.0688 35.4939 60.6511 35.3784C61.2334 35.2628 61.7684 34.9773 62.1884 34.5579C62.6084 34.1385 62.8945 33.6041 63.0105 33.0222C63.1266 32.4403 63.0674 31.8371 62.8404 31.2888C62.6134 30.7406 62.2289 30.2719 61.7354 29.942C61.2418 29.6122 60.6615 29.436 60.0679 29.4358H60.0667C59.2708 29.4361 58.5077 29.7522 57.9449 30.3144C57.3821 30.8767 57.0655 31.6392 57.0648 32.4346ZM36.6072 66.1302C34.1683 66.0192 32.8427 65.6132 31.9618 65.2702C30.7939 64.8158 29.9606 64.2746 29.0845 63.4002C28.2083 62.5258 27.666 61.6938 27.2133 60.5266C26.8699 59.6466 26.4637 58.3214 26.3528 55.884C26.2316 53.2488 26.2073 52.4572 26.2073 45.781C26.2073 39.1048 26.2336 38.3154 26.3528 35.678C26.4639 33.2406 26.8731 31.918 27.2133 31.0354C27.668 29.8682 28.2095 29.0354 29.0845 28.1598C29.9594 27.2842 30.7919 26.7422 31.9618 26.2898C32.8423 25.9466 34.1683 25.5406 36.6072 25.4298C39.244 25.3086 40.036 25.2844 46.7132 25.2844C53.3904 25.2844 54.1833 25.3106 56.8223 25.4298C59.2612 25.5408 60.5846 25.9498 61.4677 26.2898C62.6356 26.7422 63.4689 27.2854 64.345 28.1598C65.2211 29.0342 65.7615 29.8682 66.2161 31.0354C66.5595 31.9154 66.9658 33.2406 67.0767 35.678C67.1979 38.3154 67.2221 39.1048 67.2221 45.781C67.2221 52.4572 67.1979 53.2466 67.0767 55.884C66.9656 58.3214 66.5573 59.6462 66.2161 60.5266C65.7615 61.6938 65.2199 62.5266 64.345 63.4002C63.4701 64.2738 62.6356 64.8158 61.4677 65.2702C60.5872 65.6134 59.2612 66.0194 56.8223 66.1302C54.1855 66.2514 53.3934 66.2756 46.7132 66.2756C40.033 66.2756 39.2432 66.2514 36.6072 66.1302ZM36.4001 20.9322C33.7371 21.0534 31.9174 21.4754 30.3282 22.0934C28.6824 22.7316 27.2892 23.5878 25.897 24.977C24.5047 26.3662 23.6502 27.7608 23.0116 29.4056C22.3933 30.9948 21.971 32.8124 21.8497 35.4738C21.7265 38.1394 21.6982 38.9916 21.6982 45.7808C21.6982 52.57 21.7265 53.4222 21.8497 56.0878C21.971 58.7494 22.3933 60.5668 23.0116 62.156C23.6502 63.7998 24.5049 65.196 25.897 66.5846C27.289 67.9732 28.6824 68.8282 30.3282 69.4682C31.9204 70.0862 33.7371 70.5082 36.4001 70.6294C39.0687 70.7506 39.92 70.7808 46.7132 70.7808C53.5065 70.7808 54.3592 70.7526 57.0264 70.6294C59.6896 70.5082 61.5081 70.0862 63.0983 69.4682C64.7431 68.8282 66.1373 67.9738 67.5295 66.5846C68.9218 65.1954 69.7745 63.7998 70.4149 62.156C71.0332 60.5668 71.4575 58.7492 71.5768 56.0878C71.698 53.4202 71.7262 52.57 71.7262 45.7808C71.7262 38.9916 71.698 38.1394 71.5768 35.4738C71.4555 32.8122 71.0332 30.9938 70.4149 29.4056C69.7745 27.7618 68.9196 26.3684 67.5295 24.977C66.1395 23.5856 64.7431 22.7316 63.1003 22.0934C61.5081 21.4754 59.6894 21.0514 57.0284 20.9322C54.3612 20.811 53.5085 20.7808 46.7152 20.7808C39.922 20.7808 39.0687 20.809 36.4001 20.9322Z" fill="white" />
                        <defs>
                            <linearGradient id="paint0_linear_7092_54439" x1="90.9407" y1="91.5618" x2="-0.621143" y2="-2.46459e-06" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FBE18A" />
                                <stop offset="0.21" stop-color="#FCBB45" />
                                <stop offset="0.38" stop-color="#F75274" />
                                <stop offset="0.52" stop-color="#D53692" />
                                <stop offset="0.74" stop-color="#8F39CE" />
                                <stop offset="1" stop-color="#5B4FE9" />
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
                <a href="mailto:help@jeevansathistudio.in" target="_blank" class="group transition-all duration-500 hover:-translate-y-2">
                    <svg width="40" height="40" viewBox="0 0 92 92" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.638672" y="0.5" width="90.5618" height="90.5618" rx="14.5" fill="white" stroke="#C4CFE3" />
                        <path d="M22.0065 66.1236H30.4893V45.5227L18.3711 36.4341V62.4881C18.3711 64.4997 20.001 66.1236 22.0065 66.1236Z" fill="#4285F4" />
                        <path d="M59.5732 66.1236H68.056C70.0676 66.1236 71.6914 64.4937 71.6914 62.4881V36.4341L59.5732 45.5227" fill="#34A853" />
                        <path d="M59.5732 29.7693V45.5229L71.6914 36.4343V31.587C71.6914 27.0912 66.5594 24.5282 62.9663 27.2245" fill="#FBBC04" />
                        <path d="M30.4893 45.5227V29.769L45.0311 40.6754L59.5729 29.769V45.5227L45.0311 56.429" fill="#EA4335" />
                        <path d="M18.3711 31.587V36.4343L30.4893 45.5229V29.7693L27.0962 27.2245C23.4971 24.5282 18.3711 27.0912 18.3711 31.587Z" fill="#C5221F" />
                    </svg>
                </a>
                <a href="https://www.youtube.com/channel/UC5kEtpOMRrAtcMpzDCXZjQg" target="_blank" class="group transition-all duration-500 hover:-translate-y-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 93 93" fill="none">
                        <rect x="1.13867" y="1" width="91.5618" height="91.5618" rx="15" fill="#FF0000" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M67.5615 29.2428C69.8115 29.8504 71.58 31.6234 72.1778 33.8708C73.2654 37.9495 73.2654 46.4647 73.2654 46.4647C73.2654 46.4647 73.2654 54.98 72.1778 59.0586C71.5717 61.3144 69.8032 63.0873 67.5615 63.6866C63.4932 64.7771 47.1703 64.7771 47.1703 64.7771C47.1703 64.7771 30.8557 64.7771 26.7791 63.6866C24.5291 63.079 22.7606 61.306 22.1628 59.0586C21.0752 54.98 21.0752 46.4647 21.0752 46.4647C21.0752 46.4647 21.0752 37.9495 22.1628 33.8708C22.7689 31.615 24.5374 29.8421 26.7791 29.2428C30.8557 28.1523 47.1703 28.1523 47.1703 28.1523C47.1703 28.1523 63.4932 28.1523 67.5615 29.2428ZM55.5142 46.4647L41.9561 54.314V38.6154L55.5142 46.4647Z" fill="white" />
                    </svg>
                </a>
                <a href="tel:+916200569546" target="_blank" class="group transition-all duration-500 hover:-translate-y-2">
                    <div class="bg-[#51C332] w-9 h-9 rounded-md flex items-center justify-center">
                        <i class="fa fa-phone-volume  text-xl text-white"></i>
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
                        <p class="text-lg font-medium text-textPrimary text-center">"Amazing service! Would 100% best wedding photography jeevansathi
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
                        <p class="text-lg font-medium text-textPrimary text-center">"Thank you for going above and beyond on our wedding day.
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
                        <p class="text-lg font-medium text-textPrimary text-center">"It has been an amazing experience to have the Pre-wedding shoot
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
                        <p class="text-textSecondary my-2">Website: <a href="/get-a-quote" class="text-primary font-medium hover:underline" target="_blank">Get a quote</a></p>
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