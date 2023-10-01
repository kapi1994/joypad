<?php
$admin_links = adminMenu();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="admin.php">
            <img src="assets/img/joypad-logo.svg" alt="joypad-logo" width="50">
            <div class="fs-4  fw-bold">Joypad</div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <?php foreach ($admin_links as $link) :
                    $name = $link->name; ?>
                    <li class="nav-item"><a href="<?= $link->route ?>" class="nav-link <?= isset($_GET['page']) && $_GET['page'] == strtolower($name) ? 'active border-bottom fw-bold' : '' ?>"><?= $link->name ?></a></li>
                <?php endforeach; ?>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a href="models/auth/logout.php" class="nav-link">Logout</a></li>
            </ul>

        </div>
    </div>
</nav>