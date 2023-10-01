<?php
if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']->role_id != 2) {
    header("Location: index.php?page=errors&code=403");
}
$game_id = isset($_GET['id']) ? $_GET['id']  : '';
$editions = getAllGameEditions($game_id);
$platforms =  getAvailablePlatforms();
$game_name = getGameName($game_id);
?>
<div class="container">
    <div class="row mt-5">
        <div id="edition-message" class="my-2 d-none"></div>
        <div class="fs-2 mb-1"><?= $game_name->name ?></div>
        <hr>
        <div class="col-lg-8">
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Platform name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="editions">
                        <?php foreach ($editions as $index => $edition) : ?>
                            <tr id="edition_<?= $index ?>">
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= $edition->platformName ?></td>
                                <td><?= $edition->price ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($edition->created_at)) ?></td>
                                <td><?= $edition->updated_at != null ? date('d/m/Y H:i:s', strtotime($edition->updated_at)) : '-' ?></td>
                                <td><button class="btn btn-sm btn-success btn-edit-edition" data-id='<?= $edition->id ?>' data-index='<?= $index ?>'>Edit</button></td>
                                <td><button class="btn btn-sm btn-danger btn-delete-edition" data-id='<?= $edition->id ?>' data-index="<?= $index ?>" data-status='<?= $edition->is_deleted ?>'><?= $edition->is_deleted == 0  ? "Delete" : "Activate" ?></button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 mt-2 mt-lg-0">
            <form action="#">
                <input type="hidden" name="game_id" id="game_id" value="<?= $game_id ?>">
                <input type="hidden" name="game_edition_id" id="game_edition_id">
                <input type="hidden" name="game_edition_index" id="game_edition_index">
                <div class="mb-2">
                    <label for="platform" class="mb-1">Platform</label>
                    <select name="platform" id="platform" class="form-select">
                        <option value="0">Choose</option>
                        <?php foreach ($platforms as $platform) : ?>
                            <option value="<?= $platform->id ?>"><?= $platform->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="mt-1 d-none" id="platform-error"></div>
                </div>
                <div class="mb-2">
                    <label for="price" class="mb-1">Price</label>
                    <input type="number" name="price" id="price" class="form-control" min="1" step="1" value="1">
                    <div class="mt-1 d-none" id="price-error"></div>
                </div>
                <div class="mb-2">
                    <label for="image" class="mb-1">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <div class="d-none mt-1" id="image-error"></div>
                    <img src="" alt="" class="d-none img-fluid mt-2" id="img-cover">
                </div>
                <div class="d-grid gap-1">
                    <button class="btn btn-sm btn-primary" id="btnSaveEdition" type="button">Save</button>
                    <button class="btn btn-sm btn-danger" id="btnResetEdition" type="button">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>