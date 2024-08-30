<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageDetails['title']); ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDetails['description']); ?>">
    <?php include INCLUDES . "header.php"; ?>
</head>
<?php
$MenuLinks = [
    "About" => "/#about",
    "Services" => "/#services",
    "Gallery" => "/#gallery",
    "Pricing" => "/pricing-and-plans",
    "Blogs" => "/blogs",
    "Contact" => "/#contact",
];

if (empty($pageKey)) {
    $textColor = "text-white";
} else {
    $textColor = "text-textPrimary";
}
?>



<body class="overflow-hidden bg-bgPrimary">
    <div id="preloader" class="w-screen z-50 bg-bgPrimary fixed flex flex-col justify-center items-center h-screen <?php echo ($pageKey === 'blogs' || $pageKey === 'blog' || $pageKey === 'terms-and-policies') ? '-mt-[39px]' : ''; ?>">
        <div class="container mt-24">
            <svg class="w-8 h-8 mx-auto text-textPrimary animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>

            <div class="w-32 mx-auto mt-10 bg-bgSecondary rounded-full h-1.5">
                <div class="bg-textPrimary/75 h-1.5 rounded-full w-10 preloader-progress" style="width:0%;"></div>
            </div>
        </div>
    </div>
    <header class="fixed inset-x-0 top-0 z-[45] border-bgSecondary navbar" x-data="{ open: false }" @open-menu.window="open = true; $('body').addClass('overflow-hidden')" @close-menu.window="open = false; $('body').removeClass('overflow-hidden')">
        <nav class="flex items-center justify-between p-4 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5">
                    <span class="text-xl font-bold <?= $textColor; ?> hero-text">SUMAN STUDIO & Films</span>
                    <!-- <img class="h-8 w-auto" src="https://placehold.co/100x100" alt=""> -->
                </a>
            </div>
            <div class="flex lg:hidden">
                <button @click="open = !open; $('body').toggleClass('overflow-hidden')" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 <?= $textColor; ?> hero-text">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <?php foreach ($MenuLinks as $name => $link) {
                    echo '<a href="' . $link . '" class="text-sm font-semibold leading-6 ' . $textColor . ' hero-text">' . $name . '</a>';
                }
                ?>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="/get-a-quote" class="text-sm font-semibold leading-6 <?= $textColor; ?> hero-text">Get a quote</a>
            </div>
        </nav>
        <div
            x-show="open"
            @click.away="open = false; $('body').removeClass('overflow-hidden')"
            class="fixed inset-0  bg-bgPrimary h-screen lg:hidden"
            role="dialog"
            aria-modal="true">
            <div
                class="fixed inset-0 top-0 flex flex-col bg-bgPrimary px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
                x-show="open"
                x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">
                <div class="flex items-center justify-between">
                    <a href="/" class="-m-1.5 p-1.5">
                        <span class="text-xl font-bold text-textPrimary">SUMAN STUDIO & Films</span>
                    </a>
                    <button
                        @click="open = false; $('body').removeClass('overflow-hidden')"
                        type="button"
                        class="-m-2.5 rounded-md p-2.5 text-textPrimary">
                        <span class="sr-only">Close menu</span>
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root bg-bgPrimary z-40">
                    <div class="-my-6 divide-y divide-gray-500/10 bg-bgPrimary z-40">
                        <div class="space-y-2 py-6 bg-bgPrimary z-40">
                            <?php foreach ($MenuLinks as $name => $link) {
                                echo <<<HTML
                            <a
                                @click="open = false; $('body').removeClass('overflow-hidden')"
                                href='{$link}'
                                class='-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-textPrimary hover:bg-bgSecondary'>
                                {$name}
                            </a>
                            HTML;
                            }
                            ?>
                            <div class="py-6">
                                <a
                                    href="/get-a-quote"
                                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-textPrimary hover:bg-bgSecondary">Get a quote <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </header>



    <?php include PUBLIC_PAGES . $pageDetails['file']; ?>

    <!-- ====== Footer Section Start -->
    <footer class="relative bg-textPrimary pt-16 mt-10">
        <div class="container mx-auto xss:px-0 md:px-4">
            <div class="flex flex-wrap text-left lg:text-left">
                <div class="w-full lg:w-6/12 xss:px-3 md:px-4 -mt-[1.82rem]">
                    <a href="/" class="flex gap-2 md:mt-8" aria-label="Footer Logo">
                        <!-- <span class="text-2xl mt-4 mx-4 font-semibold capitalize text-bgPrimary">
                            SUMAN STUDIO & Films </span> -->
                        <img src="<?= getAsset('logo.webp', 'images/'); ?>" alt="Logo" class="w-52  brightness-200 rounded-full object-contain ml-4">
                    </a>

                    <p class="text-md m-4 text-bgSecondary text-justify">
                        We capture your most precious moments with passion and precision. From weddings to portfolios, our team is dedicated to delivering high-quality photography that tells your unique story. Trust us to make your memories last a lifetime.
                    </p>
                    <!-- <div class="my-6 z-30 flex">
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
                    <div class="h-auto py-4 ml-4 flex items-center justify-start gap-4 flex-wrap">
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
                    <!-- Display view count -->
                    <?php
                    // Fetch view count
                    $result = mysqli_query($conn, "SELECT value FROM admin WHERE specific_key = 'viewcount'");
                    $viewCount = mysqli_fetch_assoc($result)['value'];

                    echo <<<HTML
                <div class="m-4 mb-0">
                    <strong class="text-lg text-bgPrimary">Total visitors: $viewCount</strong>
                </div>
                HTML;
                    ?>
                </div>

                <div class="w-full lg:w-6/12 xss:px-0 md:px-4">
                    <div class="flex flex-wrap items-top mb-6">
                        <div class="w-full lg:w-4/12 px-4 ml-auto">
                            <span class="block uppercase text-bgPrimary text-sm font-semibold mb-2">
                                Site Navigation </span>
                            <ul class="list-unstyled">
                                <li><a class="text-bgPrimary hover:text-bgSecondary block pb-2 text-sm" href="/#services">Services</a></li>
                                <li><a class="text-bgPrimary hover:text-bgSecondary block pb-2 text-sm" href="/blogs">Blogs</a></li>
                                <li><a class="text-bgPrimary hover:text-bgSecondary block pb-2 text-sm" href="/#pricing">Pricing</a></li>

                                <li><a class="text-bgPrimary hover:text-bgSecondary block pb-2 text-sm" href="/get-a-quote">Get a Quote</a></li>
                            </ul>
                        </div>
                        <div class="w-full lg:w-4/12 px-4 xss:mt-3 md:mt-0">
                            <span class="block uppercase text-gray-100 text-sm font-semibold mb-2">
                                Info Links </span>
                            <ul class="list-unstyled">
                                <li><a class="text-bgPrimary hover:text-bgSecondary block pb-2 text-sm" href="/#about">About Us</a></li>
                                <li><a class="text-bgPrimary hover:text-bgSecondary block pb-2 text-sm" href="/#contact">Contact Us</a></li>
                                <li><a class="text-bgPrimary hover:text-bgSecondary block pb-2 text-sm" href="/terms-and-policies">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-3 border-textSecondary">
        <div class="flex flex-wrap items-center md:justify-between justify-center">
            <div class="w-full md:w-4/12 px-4 py-2 mx-auto text-center">
                <div class="text-sm text-bgSecondary/80 font-semibold py-1">
                    Copyright © <span id="currentYear"></span>
                    <a href="/"
                        class="text-bgPrimary underline hover:text-bgSecondary capitalize" aria-label="Website Name">
                        Suman Studio & Films</a>.
                    <br />
                    <span class="text-xs">
                        Built with <i class="fas fa-heart text-rose-600 mx-1"></i> by
                        <a href="https://linkedin.com/in/hassancoder" target="_blank"
                            class="text-bgSecondary/80 underline hover:text-bgSecondary">Hassan Coder</a>
                    </span>
                </div>
            </div>
        </div>
    </footer>
    <?php include INCLUDES . "footer.php"; ?>
    <script>
        $(document).ready(() => {
            setTimeout(() => {
                fetch(rootURL + "/" + apiSlug + "/updateviewscount");
            }, 30000);
        });
        const isHome = <?= $pageKey === '' ? true : false ?>;
    </script>
</body>

</html>