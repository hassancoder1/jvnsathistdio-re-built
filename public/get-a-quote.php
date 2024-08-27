<section class="w-full py-12 xss:mt-12 md:mt-0 md:py-24 lg:py-32">
    <div class="container px-4 lg:px-8 mx-auto max-w-screen-xl overflow-hidden">
        <div class="grid max-w-2xl gap-6 mx-auto">
            <div class="space-y-2">
                <h2 class="text-3xl font-bold tracking-tighter mb-4 sm:text-4xl text-textPrimary md:text-5xl">Get a <span
                        class="text-primary font-bold">Quote</span></h2>
                <p class="text-textSecondary md:text-md my-4">Ready to turn your dreams into reality? 🌟 Fill out the form
                    below
                    to get a personalized quote tailored just for you and your project! ✨</p>
            </div>
            <form class="grid gap-6"
                onsubmit="handleFormSubmit(event,'getquoteform','.getquote-form-btn-spinner','.getquote-form-btn-text','.getquote-form-response-text')">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold leading-none text-textPrimary">Name *</label>
                        <input type="text" id="name" name="name" placeholder="e.g. John Doe"
                            class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary text-textPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2"
                            required />
                    </div>
                    <div class="space-y-2">
                        <label for="phone" class="text-sm font-semibold leading-none text-textPrimary">Phone *</label>
                        <input type="tel" id="phone" name="phone" placeholder="e.g. +91xxxxxxxxxxx"
                            class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary" required />
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="service" class="text-sm font-semibold leading-none text-textPrimary">Service Required</label>
                        <select id="service" name="service"
                            class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary"
                            required>
                            <option value="" disabled selected>Choose an option</option>
                            <option value="Wedding PhotoShoot">Wedding PhotoShoot</option>
                            <option value="Pre Wedding Shoots">Pre Wedding Shoots</option>
                            <option value="PhotoGraphers For Function">PhotoGraphers For Function</option>
                            <option value="Candid Wedding PhotoGraphers">Candid Wedding PhotoGraphers</option>
                            <option value="BirthDay PhotoShoot">BirthDay PhotoShoot</option>
                            <option value="Social PhotoGraphy">Social PhotoGraphy</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div id="customService" class="space-y-2">
                        <label for="custom_service" class="text-sm font-semibold leading-none text-textPrimary">Custom Service</label>
                        <input type="text" id="custom_service" name="custom_service"
                            placeholder="Select (Other) in Service Required"
                            class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgSecondary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary" disabled />
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="eventstarttime" class="text-sm font-semibold leading-none text-textPrimary">Event Start Time</label>
                        <input type="datetime-local" id="eventstarttime" name="eventstarttime" placeholder="e.g. 1 to 3 months"
                            class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary" required />
                    </div>
                    <div class="space-y-2">
                        <label for="eventendtime" class="text-sm font-semibold leading-none text-textPrimary">Event End Time</label>
                        <input type="datetime-local" id="eventendtime" name="eventendtime" placeholder="e.g. 1 to 3 months"
                            class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary" required />
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="eventlocation" class="text-sm font-semibold leading-none text-textPrimary">Event Location</label>
                        <input type="text" id="eventlocation" name="eventlocation" placeholder="e.g. dummy place, xyz road, UP"
                            class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary" required />
                    </div>
                    <div class="space-y-2">
                        <label for="plan" class="text-sm font-semibold leading-none text-textPrimary">Select Plan</label>
                        <select type="text" id="plan" name="plan" placeholder="e.g. 10000 INR"
                            class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary" required>
                            <option value="" disabled selected>Choose an option</option>
                            <option value="Silver (49,999/- INR)">Silver (49,999/- INR)</option>
                            <option value="Gold (99,999/- INR)">Gold (99,999/- INR)</option>
                            <option value="Deluxe (149,999/- INR)">Deluxe (149,999/- INR)</option>
                            <option value="Custom">Custom</option>
                        </select>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4 hidden">
                    <div class="space-y-2">
                        <label for="budget" class="text-sm font-semibold leading-none text-textPrimary">Budget</label>
                        <input type="text" id="budget" name="budget" placeholder="e.g. 75.000/- INR"
                            class="flex h-10 w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary" />
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="details" class="text-sm font-semibold leading-none text-textPrimary">Additional Details</label>
                    <textarea id="details" name="details"
                        placeholder="Tell us more about the dream wedding! What are your expectations for the photography? Number of Guests, Functions, Any specific moments or shots you'd love us to capture? ✨💑📸"
                        class="flex min-h-[80px] w-full rounded-md border border-textPrimary/60 bg-bgPrimary px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 text-textPrimary"
                        rows="7" required></textarea>
                </div>
                <button type="submit"
                    class="inline-flex w-[120px] items-center justify-center h-10 px-4 py-2 text-sm font-medium text-bgPrimary rounded-full bg-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors">
                    <svg class="w-5 h-5 mx-auto text-bgPrimary animate-spin getquote-form-btn-spinner hidden"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="getquote-form-btn-text font-bold text-bgPrimary">Get a quote</span>
                </button>
                <p class="getquote-form-response-text font-semibold text-sm"></p>
            </form>
        </div>
    </div>
</section>