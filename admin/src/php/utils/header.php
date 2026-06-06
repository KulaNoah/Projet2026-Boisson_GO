<header id="header">

    <?php if (str_contains($_SERVER['REQUEST_URI'], 'admin')): ?>

        <div class="bg-dark text-white p-4 mb-4">
            <div class="container">
                <h1>Administration Boisson Go</h1>
                <p class="mb-0">Gestion du site</p>
            </div>
        </div>

        <?php
        if (file_exists('src/php/utils/admin_menu.php')) {
            include 'src/php/utils/admin_menu.php';
        }
        ?>

    <?php else: ?>

        <?php
        if (file_exists('admin/src/php/utils/public_menu.php')) {
            include 'admin/src/php/utils/public_menu.php';
        }
        ?>

        <div class="bg-primary text-white p-4 mb-4">
            <div class="container">
                <h1>🥤 Boisson Go</h1>
                <p class="mb-0">Votre boutique de boissons en ligne</p>
            </div>
        </div>

    <?php endif; ?>

</header>