<?php
if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']->role_id != 1) {
    header("Location: index.php?page=errors&code=403");
}
$user_id = isset($_SESSION['user']) ? $_SESSION['user']->id : '';
$wishlistItems = getWishlistItems($user_id);
?>
<div class="container">
    <div class="row mt-5" id="wishlist_items">
        <?php
        if (count($wishlistItems) > 0) :
            foreach ($wishlistItems as $wishlistItem) : ?>
                <div class="col-6 col-lg-2 mb-2 text-center">
                    <div class="card h-100">
                        <img src="assets/img/covers/<?= $wishlistItem->image_name ?>" class="img-fluid" alt="...">
                        <div class="card-body">
                            <a href="index.php?page=game&id=<?= $wishlistItem->id ?>" class="text-decoration-none text-dark">
                                <h5 class="card-title text-uppercase">
                                    <span class="me-1"><?= $wishlistItem->platformName ?></span>
                                    <span class="me-1">-</span>
                                    <span><?= $wishlistItem->gameName ?></span>
                                </h5>
                            </a>
                            <div class="d-grid gap-1">
                                <button class="btn btn-sm btn-dark add-to-cart" data-id='<?= $wishlistItem->editionId ?>'>Add to cart</button>
                                <button class="btn btn-sm btn-danger btn-remove-item" type='button' data-id='<?= $wishlistItem->id ?>'>Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;
        else : ?>
            <div class="mt-3 d-flex flex-column justify-content-center align-items-center gap-2">
                <div class="h2">No products</div>
                <a href='index.php?page=games' class='btn btn-sm btn-dark'>Go to home page</a>
            </div>
        <?php endif; ?>
    </div>
</div>