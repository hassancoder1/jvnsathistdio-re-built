<div class="relative isolate px-6 lg:px-8">
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-secondary to-primary opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto h-2/4 max-w-2xl mt-10 py-32 sm:py-48 lg:py-36">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-textPrimary sm:text-6xl">Our Terms & Policies
            </h1>
            <p class="mt-6 text-lg leading-8 text-textSecondary">
                <span class="flex justify-center items-center">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
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

<div class="bg-white py-5">
    <div class="container px-4 mx-auto max-w-[1024px]">
        <!-- Section 1: Introduction -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-textPrimary mb-4">Introduction</h2>
            <p class="text-textSecondary leading-7">
                Welcome to Suman Studio & Films! Our terms and policies are designed to protect your rights while ensuring that our services run smoothly. By engaging with our website, you agree to adhere to the guidelines outlined below. Please review these terms carefully before using our services.
            </p>
        </section>

        <!-- Section 2: Service Agreement -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-textPrimary mb-4">Service Agreement</h2>
            <p class="text-textSecondary leading-7">
                We offer a range of photography services, including wedding photoshoots, pre-wedding shoots, birthday photoshoots, and more. By booking any of our services, you agree to the following terms:
            </p>
            <ul class="list-disc ml-8 text-textSecondary leading-7">
                <li>Our photographers will capture the best moments with the utmost professionalism and care.</li>
                <li>We provide high-quality images that are edited and delivered in a timely manner.</li>
                <li>Cancellations or rescheduling requests must be made at least 48 hours in advance to avoid any additional charges.</li>
                <li>Your privacy is important to us, and we ensure that your photos are stored securely.</li>
            </ul>
        </section>

        <!-- Section 3: Payment & Pricing -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-textPrimary mb-4">Payment & Pricing</h2>
            <p class="text-textSecondary leading-7">
                Our pricing is transparent and reflects the quality of service you can expect from us. Full payment is required upon booking confirmation. We accept various payment methods, including credit cards, bank transfers, and digital wallets.
            </p>
            <p class="text-textSecondary leading-7">
                For detailed pricing, please refer to our <a href="/#pricing" class="text-primary hover:underline">Pricing Page</a>.
            </p>
        </section>

        <!-- Section 4: Cancellation Policy -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-textPrimary mb-4">Cancellation Policy</h2>
            <p class="text-textSecondary leading-7">
                We understand that plans can change. In case of cancellation, we offer a full refund if the cancellation is made at least 7 days prior to the event. For cancellations made within 7 days of the event, a cancellation fee of 30% will be charged.
            </p>
        </section>

        <!-- Section 5: Privacy Policy -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-textPrimary mb-4">Privacy Policy</h2>
            <p class="text-textSecondary leading-7">
                Your privacy is of utmost importance to us. All personal information shared with us, including contact details and photographs, will be treated with strict confidentiality. We will never share your data with third parties without your explicit consent.
            </p>
        </section>

        <!-- Section 6: Intellectual Property -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-textPrimary mb-4">Intellectual Property</h2>
            <p class="text-textSecondary leading-7">
                All photographs and content created by our team remain the intellectual property of our studio. We reserve the right to use these photos in our portfolio, marketing materials, and social media unless otherwise agreed upon in writing.
            </p>
        </section>

        <!-- Section 7: Contact Us -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-textPrimary mb-4">Contact Us</h2>
            <p class="text-textSecondary leading-7">
                If you have any questions or concerns regarding our terms and policies, please feel free to <a href="/#contact" class="text-primary hover:underline">contact us</a>. We are here to ensure that your experience with Suman Studio & Films is nothing short of exceptional.
            </p>
        </section>
    </div>
</div>