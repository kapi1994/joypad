<?php
if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']->role_id != 2) {
    header("Location: index.php?page=errorrs&code=403");
}
$platforms = getAllPlatforms();
$pages = platformPagination();
?>
<div class="container">
    <div class="row mt-5">
        <div class="d-none my-2" id="platform-message"></div>
        <div class="col-lg-8">
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="platforms">
                        <?php foreach ($platforms as $index => $platform) : ?>
                            <tr id="platform_<?= $index ?>">
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= $platform->name ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($platform->created_at)) ?></td>
                                <td><?= $platform->updated_at != null ? date('d/m/Y H:i:s', strtotime($platform->updated_at)) : '-' ?></td>
                                <td><button class="btn btn-sm btn-success btn-edit-platform" type="button" data-index='<?= $index ?>' data-id='<?= $platform->id ?>'>Edit</button></td>
                                <td><button class="btn btn-sm btn-danger btn-delete-platform" type="button" data-id='<?= $platform->id ?>' data-index='<?= $index ?>' data-status='<?= $platform->is_deleted ?>'>
                                        <?= $platform->is_deleted == 0 ? "Delete" : "Activate" ?>
                                    </button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="platform-pages">
                        <?php for ($i = 0; $i < $pages; $i++) : ?>
                            <li class="page-item <?= $i == 0 ? 'active' : '' ?>"><a class="page-link platform-page" data-limit='<?= $i ?>' href="#"><?= $i + 1 ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-lg-4 mt-2 mt-lg-0">
            <form action="#">
                <input type="hidden" name="platform_id" id="platform_id">
                <input type="hidden" name="platform_index" id="platform_index">
                <div class="mb-2">
                    <label for="name" class="mb-1">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <div class="d-none mt-1" id="name-error"></div>
                </div>
                <div class="d-grid gap-1">
                    <button class="btn btn-sm btn-primary" type="button" id="btnSavePlatform">Save</button>
                    <button class="btn btn-sm btn-danger" id="btnResetPlatform" type="button">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>