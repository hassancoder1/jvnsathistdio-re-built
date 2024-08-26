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
    "Pricing" => "/#pricing",
    "Blogs" => "/blogs",
    "Contact" => "/#contact",
];

if (empty($pageKey)) {
    $textColor = "text-white";
} else {
    $textColor = "text-textPrimary";
}
?>



<body class="overflow-hidden">
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
                    <span class="text-xl font-bold <?= $textColor; ?> hero-text">SUMAN STUDIOS</span>
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
                        <span class="text-xl font-bold text-textPrimary">SUMAN STUDIOS</span>
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
                    <a href="https://theeaglestech.com/" class="flex gap-2 md:mt-8" aria-label="Footer Logo">
                        <span class="text-2xl mt-4 mx-4 font-semibold capitalize text-bgPrimary">
                            SUMAN STUDIOS </span>
                    </a>

                    <p class="text-md m-4 text-bgSecondary text-justify">
                        We capture your most precious moments with passion and precision. From weddings to portfolios, our team is dedicated to delivering high-quality photography that tells your unique story. Trust us to make your memories last a lifetime.
                    </p>
                    <div class="my-6 mx-4 lg:mb-0 ">

                        <a href="" target="_blank" class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mx-2" rel="dofollow" aria-label="Facebook"><i class="fab fa-facebook-f text-2xl text-blue-500"></i></a>
                        <a href="" target="_blank" class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mx-2" rel="dofollow" aria-label="X (Formerly Twitter)"><i class="fab fa-x-twitter text-2xl text-zinc-200"></i></a>
                        <a href="" target="_blank" class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mx-2" rel="dofollow" aria-label="Linkedin"><i class="fab fa-linkedin-in text-2xl text-sky-700"></i></a>
                        <a href="" target="_blank" class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mx-2" rel="dofollow" aria-label="Whatsapp"><i class="fab fa-whatsapp text-2xl text-green-500"></i></a>
                        <a href="" target="_blank" class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mx-2" rel="dofollow" aria-label="Email"><i class="far fa-envelope text-2xl text-indigo-400"></i></a>
                        <a href="" target="_blank" class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mx-2" rel="dofollow" aria-label="Upwork"><i class="fab fa-upwork text-2xl text-lime-500"></i></a>
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
                    <a href=""
                        class="text-bgPrimary underline hover:text-bgSecondary capitalize" aria-label="Website Name">
                        Suman Studios</a>.
                    <br />
                    <span class="text-xs">
                        Built with <i class="fas fa-heart text-rose-600 mx-1"></i> by
                        <a href="https://github.com/hassancoder1" target="_blank"
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