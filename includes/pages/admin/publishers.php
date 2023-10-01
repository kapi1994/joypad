<?php
if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']->role_id != 2) {
    header("Location: index.php?page=errors&code=403");
}
$publishers = getAllPublishers();
$pages = publisherPagination();
?>
<div class="container">
    <div class="row mt-5">
        <div class="d-none my-2" id="publisher-message"></div>
        <div class="col-lg-8">
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="row">#</th>
                            <th scope="row">Name</th>
                            <th scope="row">Created at</th>
                            <th scope="row">Updated at</th>
                            <th scope="row">Edit</th>
                            <th scope="row">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="publishers">
                        <?php foreach ($publishers as  $index => $publisher) : ?>
                            <tr id="publisher_<?= $index ?>">
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= $publisher->name ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($publisher->created_at)) ?></td>
                                <td><?= $publisher->updated_at != null ? date('d/m/Y H:i:s', strtotime($publisher->updated_at)) : '-' ?></td>
                                <td><button type="button" class="btn btn-sm btn-success btn-edit-publisher" data-id="<?= $publisher->id ?>" data-index="<?= $index ?>">Edit</button></td>
                                <td><button type="button" class="btn btn-sm btn-danger btn-delete-publisher" data-id="<?= $publisher->id ?>" data-index="<?= $index ?>" data-status="<?= $publisher->is_deleted ?>"><?= $publisher->is_deleted == 0 ? "Delete" : "Activate" ?></button> </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="publisher-pages">
                        <?php for ($i = 0; $i < $pages; $i++) : ?>
                            <li class="page-item  <?= $i == 0 ? 'active' : '' ?>"><a class="page-link  publisher-page" href='#' data-limit="<?= $i ?>"><?= $i + 1 ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-lg-4 mt-2 mt-lg-0">
            <form action="#">
                <input type="hidden" name="publisher_id" id="publisher_id">
                <input type="hidden" name="publisher_index" id="publisher_index">
                <div class="mb-2">
                    <label for="name" class="mb-1">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <div class="mt-1 d-none" id="name-error"></div>
                </div>
                <div class="d-grid gap-1">
                    <button class="btn btn-sm btn-primary" id="btnSavePublisher" type="button">Save</button>
                    <button class="btn btn-sm btn-danger" id="btnResetPublisher" type="button">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>