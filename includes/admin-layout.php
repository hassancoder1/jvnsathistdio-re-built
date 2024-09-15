<?php
$isLogin = $page === 'login';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageDetails['title']); ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDetails['description']); ?>">

    <?php include INCLUDES . "header.php"; ?>
</head>

<body class="<?= $isLogin ? '' : 'h-screen flex bg-bgPrimary' ?>" x-data="{ isSideMenuOpen: false }">

    <?php if (!$isLogin) : ?>

        <!-- Sidebar -->
        <aside class="z-20 fixed top-0 left-0 w-64 h-full bg-bgPrimary border-r-2 border-bgSecondary/40 transform transition-transform duration-300 -translate-x-full md:translate-x-0 overflow-y-scroll"
            :class="{ '-translate-x-0': isSideMenuOpen, '-translate-x-full': !isSideMenuOpen && window.innerWidth < 768 }">
            <div class="py-4">
                <a class="text-lg px-6 font-bold text-textPrimary" href="/<?= ADMIN_SLUG ?>/home"><?php
                                                                                                    echo ucwords(str_replace('-', ' ', ADMIN_SLUG));
                                                                                                    ?></a>
                <!-- Close button on mobile -->
                <button class="text-textPrimary float-right cursor-pointer mt-2 md:hidden" @click="isSideMenuOpen = false">
                    <i class="fa fa-times text-lg mr-5 -mt-2 text-textPrimary"></i>
                </button>
                <ul class="mt-6">
                    <?php foreach ($adminRoutes as $route => $details) :
                        if ($route !== "login" && isset($details['label'], $details['icon'])) :
                            $isActive = ($page === $route);
                    ?>
                            <li class="relative px-6 py-3 my-1 hover:bg-bgSecondary <?= $isActive ? 'bg-bgSecondary' : ''; ?>">
                                <span class="absolute inset-y-0 left-0 w-[6px] bg-primary rounded-tr-lg rounded-br-lg <?= $isActive ? 'block' : 'hidden'; ?>" aria-hidden="true"></span>
                                <?php
                                $route = $route === 'dashboard' ? 'home' : $route;
                                $pageURL = ROOT_URL . ADMIN_SLUG . "/" . $route;
                                ?>
                                <a class="inline-flex items-center w-full text-sm font-semibold text-textPrimary" href="<?= $pageURL; ?>">
                                    <i class="fa <?= $details['icon']; ?> text-textPrimary"></i>
                                    <span class="ml-4"><?= htmlspecialchars($details['title']); ?></span>
                                </a>
                            </li>
                    <?php endif;
                    endforeach; ?>
                </ul>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden md:ml-64">
            <!-- Top bar -->
            <header class="z-10 fixed top-0 left-0 right-0 bg-bgPrimary border-b-2 border-bgSecondary/40 flex items-center justify-between md:justify-end h-16 px-6">
                <!-- Mobile toggle button -->
                <button class="p-1 rounded-md focus:outline-none md:hidden" @click="isSideMenuOpen = !isSideMenuOpen">
                    <i class="fa fa-bars text-lg text-textPrimary"></i>
                </button>
                <!-- Logout button -->
                <form action="<?= ROOT_URL . API_SLUG ?>/logout" method="POST" class="flex justify-center items-center gap-3">
                    <input type="hidden" name="logout" value="true">
                    <a href="<?= ROOT_URL; ?>" target="_blank" class="p-2 rounded-md focus:outline-none" title="Open Website">
                        <i class="fa fa-external-link-alt text-textPrimary"></i>
                    </a>
                    <a href=""
                        x-data="{ spinning: false }"
                        @click.prevent="spinning = true; window.location.reload();"
                        class="p-2 rounded-md focus:outline-none"
                        title="Refresh Page">
                        <i :class="{ 'animate-spin': spinning }" class="fa fa-refresh text-textPrimary"></i>
                    </a>

                    <button type="submit" class="p-2 rounded-md focus:outline-none" title="logout">
                        <i class="fa fa-arrow-right-from-bracket text-textPrimary"></i>
                    </button>
                </form>
            </header>

            <!-- Page content -->
            <main class="overflow-y-auto p-6 mt-16 bg-bgPrimary">
                <?php include ADMIN_PAGES . $pageDetails['file']; ?>

                <!-- Delete modal -->
                <div id="deleteModal" class="hidden overflow-hidden fixed top-0 left-0 z-50 bg-slate-900/50 flex justify-center items-center w-full h-screen">
                    <div class="relative flex justify-center items-center p-4 w-full max-w-md h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative p-4 text-center bg-bgPrimary rounded-lg shadow sm:p-5">
                            <button id="closeBtn" class="text-textPrimary absolute top-2.5 right-2.5 bg-transparent hover:bg-bgSecondary/30 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <svg class="text-textSecondary w-11 h-11 mb-3.5 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="mb-4 text-textPrimary">Are you sure you want to delete this item?</p>
                            <div class="flex justify-center items-center space-x-4">
                                <button id="cancelBtn" class="py-2 px-3 text-sm font-medium text-textPrimary bg-bgPrimary rounded-lg border border-2 hover:bg-bgSecondary/30 focus:ring-4 focus:outline-none focus:ring-primary focus:z-10">
                                    No, cancel
                                </button>
                                <button id="yesBtn" class="py-2 px-3 text-sm font-medium text-center text-bgPrimary bg-red-500 rounded-lg hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-700">
                                    Yes, I'm sure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>

    <?php else :  ?>

        <!-- Load login content -->
        <?php include ADMIN_PAGES . $pageDetails['file']; ?>

    <?php endif; ?>

    <?php include INCLUDES . "footer.php"; ?>
    <script>
        window.confirmDelete = function(deleteURL) {
            let deleteModal = document.getElementById("deleteModal");
            deleteModal.classList.remove('hidden');
            document.getElementById("closeBtn").onclick = () => {
                deleteModal.classList.add('hidden');
            };
            document.getElementById("cancelBtn").onclick = () => {
                deleteModal.classList.add('hidden');
            };
            document.getElementById("yesBtn").onclick = () => {
                window.location.href = deleteURL;
            };
        };
    </script>

</body>

</html>