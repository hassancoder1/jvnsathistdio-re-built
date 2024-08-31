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
            </main>
        </div>

    <?php else : ?>

        <!-- Login page -->
        <div id="alertContainer" class="fixed left-0 flex justify-center items-center w-full hidden">
            <span class="border border-2 px-4 py-2 rounded-md">
                <i class="fa mr-2"></i>
                <span class="font-bold"></span>
            </span>
        </div>

        <!-- Load login content -->
        <?php include ADMIN_PAGES . $pageDetails['file']; ?>

    <?php endif; ?>

    <?php include INCLUDES . "footer.php"; ?>
</body>

</html>