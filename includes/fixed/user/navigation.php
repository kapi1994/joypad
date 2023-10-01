<?php
$user_menu  = userMenu();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="assets/img/joypad-logo.svg" alt="joypad-logo" width="50">
            <div class="fs-4  fw-bold">Joypad</div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <?php foreach ($user_menu as $menu_item) :
                    $name = $menu_item->name; ?>
                    <li class="nav-item"><a href="<?= $menu_item->route ?>" class="nav-link
                        <?= isset($_GET['page']) && $_GET['page'] == strtolower($name) ? 'active fw-bold border-bottom' : '' ?>
                    "><?= $name ?></a></li>
                <?php endforeach; ?>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item"><a href="index.php?page=login" class="nav-link
                <?= isset($_GET['page']) && $_GET['page'] == 'login' ? 'fw-bold active border-bottom' : '' ?>">Log in</a></li>
                    <li class="nav-item"><a href="index.php?page=register" class="nav-link
                    <?= isset($_GET['page']) && $_GET['page'] == 'register' ? 'fw-bold active border-bottom' : '' ?>
                ">Register</a></li>
                <?php else : ?>
                    <li class="nav-item"><a href="models/auth/logout.php" class="nav-link">Logout</a></li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>