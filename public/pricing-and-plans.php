<!-- Blog Header -->
<div class="relative isolate px-6 lg:px-8">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-secondary to-primary opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-2xl h-2/4 mt-10 py-32 sm:py-48 lg:py-36">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-textPrimary sm:text-6xl">Our Pricing & Plans</h1>
            <p class="mt-6 text-lg leading-8 text-textSecondary">
                <span class="flex justify-center items-center"><svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <?php
                    $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
                    echo 'Home / ' . ucwords(str_replace('-', ' ', implode(' / ', $url)));
                    ?>
                </span>
            </p>
        </div>
    </div>
</div> <!-- gradient end -->

<!-- PRICING SECTION
<div id="pricing" class="container mx-auto px-4 py-16">
    <div class="container mx-auto text-center mt-6 mb-12">
        <h2 class="text-3xl font-bold leading-snug text-textPrimary lg:text-4xl">Pricing Plans</h2>
        <img src="<?= getAsset('heading-decoration.webp', 'images/') ?>" class="h-12 -mt-1 mx-auto" alt="Heading Decoration">
    </div>

    <div class="grid gap-8 lg:grid-cols-3 lg:gap-12">
        <div class="flex flex-col p-6 pb-24 text-center bg-bgPrimary rounded-lg border border-textSecondary relative">
            <h3 class="mb-4 text-2xl font-semibold text-textPrimary">Silver</h3>
            <p class="font-light text-textSecondary sm:text-lg">Best option for personal use & for your next project.</p>
            <div class="my-8">
                <span class="text-4xl font-extrabold text-textPrimary">49,999/-</span>
            </div>
            <ul class="mb-8 space-y-4 text-left mx-auto">
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
            <a href="/get-a-quote" class="text-bgPrimary bg-primary focus:ring-2 focus:ring-primary ring-offset-2 font-medium rounded-full text-sm px-5 py-2.5 text-center w-[120px] absolute bottom-6 left-1/2 transform -translate-x-1/2">
                Get started
            </a>
        </div>

        <div class="flex flex-col p-6 pb-24 text-center bg-bgPrimary rounded-lg border border-textSecondary relative">
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
            <a href="/get-a-quote" class="text-bgPrimary bg-primary focus:ring-2 focus:ring-primary ring-offset-2 font-medium rounded-full text-sm px-5 py-2.5 text-center w-[120px] absolute bottom-6 left-1/2 transform -translate-x-1/2">
                Get started
            </a>
        </div>

        <div class="p-1 bg-gradient-to-tr from-secondary to-primary rounded-lg">
            <div class="flex flex-col p-6 pb-[104px] text-center bg-bgPrimary rounded-lg border border-textSecondary relative">
                <h3 class="mb-4 text-2xl font-semibold text-textPrimary">Deluxe</h3>
                <p class="font-light text-textSecondary sm:text-lg">Perfect for those looking for a premium experience.</p>
                <div class="my-8">
                    <span class="text-4xl font-extrabold text-textPrimary">149,999/-</span>
                </div>

                <ul class="mb-8 space-y-4 text-left mx-auto">
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
                <a href="/get-a-quote" class="text-bgPrimary bg-primary focus:ring-2 focus:ring-primary ring-offset-2 font-medium rounded-full text-sm px-5 py-2.5 text-center w-[120px] absolute bottom-6 left-1/2 transform -translate-x-1/2">
                    Get started
                </a>
            </div>
        </div>
    </div>
</div> -->

<!-- PRICING SECTION -->
<div id="pricing" class="container mx-auto px-4 py-8">
    <div class="grid gap-6 my-16 lg:grid-cols-1">
        <!-- Silver Plan Card -->
        <div class="hover:bg-gradient-to-tr from-secondary to-primary rounded-lg p-0.5 border-2 hover:border-transparent">
            <div class="relative flex flex-wrap gap-2 bg-white p-1.5 rounded-md items-center justify-between overflow-hidden md:flex-nowrap w-full h-full">
                <!-- Plan Info -->
                <div class="bg-white flex-shrink-0 p-6 text-center md:h-full flex flex-col justify-center items-center w-full md:w-1/4 lg:w-1/6 order-4 md:order-1">
                    <h3 class="mb-2 text-2xl font-semibold text-textPrimary">Silver</h3>
                    <span class="text-4xl font-extrabold text-textPrimary">49,999/-</span>

                    <a href="/get-a-quote" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">Get started</a>
                </div>
                <!-- Plan Features -->
                <div class="relative w-full lg:w-1/3 rounded-md overflow-hidden order-1 md:order-2">
                    <img src="<?= getAsset('about-featured.webp', 'images/'); ?>" class="w-full h-full object-cover" alt="Feature 1">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-center text-bgPrimary font-bold p-4">
                        <p>Photo Album: <span class="font-semibold">250 - 300</span></p>
                        <p>Video highlight + Long Video.</p>

                    </div>
                </div>
                <div class="relative w-full lg:w-1/3 rounded-md overflow-hidden order-2 md:order-3">
                    <img src="<?= getAsset('about-featured.webp', 'images/'); ?>" class="w-full h-full object-cover" alt="Feature 2">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-center text-bgPrimary font-bold p-4">
                        <p>Two Day Wedding Cinematography.</p>
                        <p>Two Day Wedding Photography.</p>
                    </div>
                </div>
                <div class="relative w-full lg:w-1/3 rounded-md overflow-hidden order-3 md:order-4">
                    <img src="<?= getAsset('about-featured.webp', 'images/'); ?>" class="w-full h-full object-cover" alt="Feature 3">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-center text-bgPrimary font-bold p-4">
                        <p>All Soft Copy Video On PenDrive.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gold Plan Card -->
        <div class="hover:bg-gradient-to-tr from-secondary to-primary rounded-lg p-0.5 border-2 hover:border-transparent">
            <div class="relative flex flex-wrap gap-2 bg-white p-1.5 rounded-md items-center justify-between overflow-hidden md:flex-nowrap w-full h-full">
                <!-- Plan Features -->
                <div class="relative w-full lg:w-1/3 rounded-md overflow-hidden order-1">
                    <img src="<?= getAsset('about-featured.webp', 'images/'); ?>" class="w-full h-full object-cover" alt="Feature 1">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-center text-bgPrimary font-bold p-4">
                        <p>Two Day Wedding Photography.</p>
                        <p>Video highlight + Teaser + Long Video.</p>
                    </div>
                </div>
                <div class="relative w-full lg:w-1/3 rounded-md overflow-hidden order-2">
                    <img src="<?= getAsset('about-featured.webp', 'images/'); ?>" class="w-full h-full object-cover" alt="Feature 2">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-center text-bgPrimary font-bold p-4">
                        <p>Photo Album: <span class="font-semibold">300 - 350</span></p>
                        <p>Photo + Candid.</p>
                    </div>
                </div>
                <div class="relative w-full lg:w-1/3 rounded-md overflow-hidden order-3">
                    <img src="<?= getAsset('about-featured.webp', 'images/'); ?>" class="w-full h-full object-cover" alt="Feature 3">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-center text-bgPrimary font-bold p-4">
                        <p>Video + Cinematography.</p>
                        <p>All Soft Copy Video On PenDrive.</p>
                    </div>
                </div>
                <!-- Plan Info -->
                <div class="bg-white flex-shrink-0 p-6 text-center md:h-full flex flex-col justify-center items-center w-full md:w-1/4 lg:w-1/6 order-4">
                    <h3 class="mb-2 text-2xl font-semibold text-textPrimary">Gold</h3>
                    <span class="text-4xl font-extrabold text-textPrimary">99,999/-</span>

                    <a href="/get-a-quote" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">Get started</a>
                </div>
            </div>
        </div>

        <!-- Deluxe Plan Card -->
        <div class="hover:bg-gradient-to-tr from-secondary to-primary rounded-lg p-0.5 border-2 hover:border-transparent">
            <div class="relative flex flex-wrap gap-2 bg-white p-1.5 rounded-md items-center justify-between overflow-hidden md:flex-nowrap w-full h-full">
                <!-- Plan Info -->
                <div class="bg-white flex-shrink-0 p-6 text-center md:h-full flex flex-col justify-center items-center w-full md:w-1/4 lg:w-1/6 order-4 md:order-1">
                    <h3 class="mb-2 text-2xl font-semibold text-textPrimary">Deluxe</h3>
                    <span class="text-4xl font-extrabold text-textPrimary">149,999/-</span>

                    <a href="/get-a-quote" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">Get started</a>
                </div>
                <!-- Plan Features -->
                <div class="relative w-full lg:w-1/3 rounded-md overflow-hidden order-1 md:order-2">
                    <img src="<?= getAsset('about-featured.webp', 'images/'); ?>" class="w-full h-full object-cover" alt="Feature 1">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-center text-bgPrimary font-bold p-4">
                        <p>Pre-Wedding + Two Day Wedding Photography.</p>
                        <p>Pre-Wedding + Photo + Video.</p>
                    </div>
                </div>
                <div class="relative w-full lg:w-1/3 rounded-md overflow-hidden order-2 md:order-3">
                    <img src="<?= getAsset('about-featured.webp', 'images/'); ?>" class="w-full h-full object-cover" alt="Feature 2">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-center text-bgPrimary font-bold p-4">
                        <p>Video highlight + Teaser + Reel + Long Video.</p>
                        <p>Photo Album: <span class="font-semibold">300 - 350</span></p>
                    </div>
                </div>
                <div class="relative w-full lg:w-1/3 rounded-md overflow-hidden order-3 md:order-4">
                    <img src="<?= getAsset('about-featured.webp', 'images/'); ?>" class="w-full h-full object-cover" alt="Feature 3">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center text-center text-bgPrimary font-bold p-4">
                        <p>Wedding Day Photo + Candid.</p>
                        <p>Video + Cinematography.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>