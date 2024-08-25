<section class="bg-bgSecondary">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-bgPrimary rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-textPrimary md:text-2xl">
                    Sign in to Admin account
                </h1>
                <form onsubmit="handleFormSubmit(event,'loginform','.login-form-btn-spinner','.login-form-btn-text','.login-form-response-text')" class="space-y-4 md:space-y-6">
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-textPrimary ">Username</label>
                        <input type="text" name="username" id="username" class="border border-textPrimary/60 text-textPrimary rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors" placeholder="e.g. Abc123" required>
                    </div>
                    <div class="relative">
                        <label for="password" class="block mb-2 text-sm font-medium text-textPrimary">Password</label>
                        <input type="password" name="password" id="password" placeholder="e.g. YbDSk4Uyt@EFKi" class="border border-textPrimary/60 text-textPrimary rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary transition-colors" required>
                        <i class="fa fa-eye-slash absolute text-textPrimary top-11 right-3 cursor-pointer" onclick="togglePassword('password')"></i>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-textPrimary/60 rounded-lg focus:ring-3 focus:ring-primary cursor-pointer">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="rememberme" class="text-textSecondary cursor-pointer">Remember me</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-bgPrimary bg-primary hover:bg-primary/90 focus:ring-2 focus:outline-none focus:ring-primary focus:ring-offset-2 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="w-5 h-5 mx-auto text-bgPrimary animate-spin login-form-btn-spinner hidden"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span class="login-form-btn-text font-bold text-bgPrimary">Signin</span>
                    </button>
                    <p class="text-sm text-center font-light text-bgPrimary login-form-response-text"></p>
                </form>
            </div>
        </div>
    </div>
</section>