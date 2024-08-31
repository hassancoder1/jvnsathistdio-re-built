<!-- HERO SECTION -->
<div class="relative isolate px-6 lg:px-8">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-secondary to-primary opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon()"></div>
    </div>
    <div class="mx-auto h-2/4 max-w-2xl mt-10 py-32 sm:py-48 lg:py-36">
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

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Card 1 -->
        <div class="bg-bgPrimary rounded-lg overflow-hidden border-2">
            <div class="relative">
                <img src="<?= getAsset('pricing-traditional.webp', 'images/'); ?>" alt="Traditional photography with bride and groom" class="w-full h-48 object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <h1 class="text-2xl text-white font-bold text-center">Traditional</h1>
                </div>
            </div>
            <div class="p-4 text-center">
                <p class="text-sm text-gray-600">Full HD Video & Photography</p>
                <p class="text-sm text-gray-600">Photobook Approx. 200 images</p>
                <h3 class="text-2xl font-semibold mt-2">₹55000</h3>
                <div class="mt-4 text-center">
                    <a href="https://wa.me/+916200569546" target="_blank" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">- Book Now -</a>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-bgPrimary rounded-lg overflow-hidden border-2">
            <div class="relative">
                <img src="<?= getAsset('pricing-cinematic.webp', 'images/'); ?>" alt="Cinematic photography with colorful scene" class="w-full h-48 object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <h1 class="text-2xl text-white font-bold text-center">Cinematic</h1>
                </div>
            </div>
            <div class="p-4 text-center">
                <p class="text-sm text-gray-600">Cinematic Video & Photography</p>
                <p class="text-sm text-gray-600">Photobook Approx. 200 Images</p>
                <h3 class="text-2xl font-semibold mt-2">₹85000</h3>
                <div class="mt-4 text-center">
                    <a href="https://wa.me/+916200569546" target="_blank" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">- Book Now -</a>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="bg-bgPrimary rounded-lg overflow-hidden border-2">
            <div class="relative">
                <img src="<?= getAsset('pricing-combopack.webp', 'images/'); ?>" alt="Combo pack with traditional and cinematic photography" class="w-full h-48 object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <h1 class="text-2xl text-white font-bold text-center">Combo Pack</h1>
                </div>
            </div>
            <div class="p-4 text-center">
                <p class="text-sm text-gray-600">Traditional Video & Photography</p>
                <p class="text-sm text-gray-600">Photobook Approx. 200 Images</p>
                <p class="text-sm text-gray-600">*Candid & Cinematic Shoot on weddings</p>
                <h3 class="text-2xl font-semibold mt-2">₹91000</h3>
                <div class="mt-4 text-center">
                    <a href="https://wa.me/+916200569546" target="_blank" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">- Book Now -</a>
                </div>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="bg-bgPrimary rounded-lg overflow-hidden border-2">
            <div class="relative">
                <img src="<?= getAsset('pricing-photo-video-candid.webp', 'images/'); ?>" alt="Cinematic video and candid photo with dramatic scene" class="w-full h-48 object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <h1 class="text-2xl text-white font-bold text-center">Cinematic Video & Candid Photo</h1>
                </div>
            </div>
            <div class="p-4 text-center">
                <p class="text-sm text-gray-600">Cinematic Video & Candid Photography</p>
                <p class="text-sm text-gray-600">Photobook Approx. 150 images</p>
                <h3 class="text-2xl font-semibold mt-2">₹121000</h3>
                <div class="mt-4 text-center">
                    <a href="https://wa.me/+916200569546" target="_blank" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">- Book Now -</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Repeat for other work --> <br><br><br>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Card 1 -->
        <div class="bg-bgPrimary rounded-lg overflow-hidden border-2">
            <div class="relative">
                <img src="<?= getAsset('pricing-engagement.webp', 'images/'); ?>" alt="Engagement" class="w-full h-48 object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <h1 class="text-2xl text-white font-bold text-center">Engagement</h1>
                </div>
            </div>
            <div class="p-4 text-center">
                <p class="text-sm text-gray-600">Full HD Video & Photography</p>
                <p class="text-sm text-gray-600">Photobook Approx. 100 Images</p>
                <h3 class="text-2xl font-semibold mt-2">₹31000</h3>
                <div class="mt-4 text-center">
                    <a href="https://wa.me/+916200569546" target="_blank" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">- Book Now -</a>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-bgPrimary rounded-lg overflow-hidden border-2">
            <div class="relative">
                <img src="<?= getAsset('pricing-oneday-wedding.webp', 'images/'); ?>" alt="Single Day Wedding" class="w-full h-48 object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <h1 class="text-2xl text-white font-bold text-center">Single Day Wedding</h1>
                </div>
            </div>
            <div class="p-4 text-center">
                <p class="text-sm text-gray-600">Cinematic Video & Photography</p>
                <p class="text-sm text-gray-600">Photobook Approx. 100 Images</p>
                <h3 class="text-2xl font-semibold mt-2">₹31000</h3>
                <div class="mt-4 text-center">
                    <a href="https://wa.me/+916200569546" target="_blank" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">- Book Now -</a>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="bg-bgPrimary rounded-lg overflow-hidden border-2">
            <div class="relative">
                <img src="<?= getAsset('pricing-pre-wedding.webp', 'images/'); ?>" alt="Pre Wedding Shoot" class="w-full h-48 object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <h1 class="text-2xl text-white font-bold text-center">Pre Wedding Shoot</h1>
                </div>
            </div>
            <div class="p-4 text-center">
                <p class="text-sm text-gray-600">Video Teaser</p>
                <p class="text-sm text-gray-600">Photobook Approx. 80 Images</p>
                <h3 class="text-2xl font-semibold mt-2">₹35000</h3>
                <div class="mt-4 text-center">
                    <a href="https://wa.me/+916200569546" target="_blank" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">- Book Now -</a>
                </div>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="bg-bgPrimary rounded-lg overflow-hidden border-2">
            <div class="relative">
                <img src="<?= getAsset('pricing-maternity.webp', 'images/'); ?>" alt="Maternity Photoshoot" class="w-full h-48 object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <h1 class="text-2xl text-white font-bold text-center">Maternity Photoshoot</h1>
                </div>
            </div>
            <div class="p-4 text-center">
                <p class="text-sm text-gray-600">25 edited pics</p>
                <p class="text-sm text-gray-600">Photobook approx. 50 images</p>
                <h3 class="text-2xl font-semibold mt-2">₹21000</h3>
                <div class="mt-4 text-center">
                    <a href="https://wa.me/+916200569546" target="_blank" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">- Book Now -</a>
                </div>
            </div>
        </div>
        <div class="bg-bgPrimary rounded-lg overflow-hidden border-2">
            <div class="relative">
                <img src="<?= getAsset('pricing-birthday.webp', 'images/'); ?>" alt="Birthday" class="w-full h-48 object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <h1 class="text-2xl text-white font-bold text-center">Birthday Photoshoot</h1>
                </div>
            </div>
            <div class="p-4 text-center">
                <p class="text-sm text-gray-600">Cinematic Birthday Highlight
                    10 edit image</p>
                <p class="text-sm text-gray-600">Photobook approx. 80 image</p>
                <h3 class="text-2xl font-semibold mt-2">₹25000</h3>
                <div class="mt-4 text-center">
                    <a href="https://wa.me/+916200569546" target="_blank" class="inline-flex items-center block rounded-md bg-gradient-to-tr from-secondary to-primary text-sm font-semibold text-bgPrimary shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-4 px-3.5 py-2.5">- Book Now -</a>
                </div>
            </div>
        </div>
    </div>
</div>