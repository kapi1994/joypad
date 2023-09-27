<?php
if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']->role_id != 1) {
    header("Location: index.php?page=errorrs&code=403");
}
$publishers = getAvailablePublishers();
$genres = getAllGenres();
$pegi_rating = getPegiRating();
$games = getAllGames();
$pages = gamePagination();
?>
<div class="container">
    <div class="row mt-5 mb-2">
        <div class="d-none my-2" id="game-message"></div>
        <div class="col-lg-2">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search...">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Publisher name</th>
                            <th scope="col">Editions</th>
                            <th scope="col">Release at</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="games">
                        <?php foreach ($games as $index => $game) : ?>
                            <tr id="game_<?= $index ?>">
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= $game->gameName ?></td>
                                <td><?= $game->publisherName ?></td>
                                <td><a href='admin.php?page=editions&id=<?= $game->id ?>' class="btn btn-sm btn-primary">Add</a></td>
                                <td><?= date('d/m/Y', strtotime($game->release_date)); ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($game->created_at)) ?></td>
                                <td><?= $game->updated_at != null ? date('d/m/Y H:i:s', strtotime($game->updated_at)) : '-' ?></td>
                                <td><button class="btn btn-sm btn-success btn-edit-game" data-id='<?= $game->id ?>' data-index='<?= $index ?>'>Edit</button></td>
                                <td><button class="btn btn-sm btn-danger btn-delete-game" data-id='<?= $game->id ?>' data-status='<?= $game->is_deleted ?>' data-index='<?= $index ?>'>
                                        <?= $game->is_deleted == 0 ? "Delete" : "Activate" ?></button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="game-pages">
                        <?php for ($i = 0; $i < $pages; $i++) : ?>
                            <li class="page-item <?= $i == 0 ? 'active' : '' ?>"><a class="page-link game-page" href="#" data-limit='<?= $i ?>'>
                                    <?= $i + 1 ?>
                                </a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-lg-4 mt-2 mt-lg-0">
            <form action="#">
                <input type="hidden" name="game_id" id="game_id">
                <input type="hidden" name="game_index" id="game_index">
                <div class="mb-2">
                    <label for="name" class="mb-1">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <div class="mt-1 d-none" id="name-error"></div>
                </div>
                <div class="mb-2">
                    <label for="short-description" class="mb-1">Short description</label>
                    <textarea name="short-description" id="short-description" cols="30" rows="3" class="form-control"></textarea>
                    <div class="mt-1 d-none" id="short-description-error"></div>
                </div>
                <div class="mb-2">
                    <label for="long-description" class="mb-1">Long description</label>
                    <textarea name="long-description" id="long-description" cols="30" rows="5" class="form-control"></textarea>
                    <div class="mt-1 d-none" id="long-description-error"></div>
                </div>
                <div class="mb-2">
                    <label for="publishers" class="mb-1">Pulbishers</label>
                    <select name="publishers" id="publishers" class="form-select">
                        <option value="0">Choose</option>
                        <?php foreach ($publishers as $publisher) : ?>
                            <option value="<?= $publisher->id ?>"><?= $publisher->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="mt-1 d-none" id="publisher-error"></div>
                </div>
                <div class="mb-2">
                    <label for="pegi-rating" class="mb-1">Pegi rating</label>
                    <select name="pegi-rating" id="pegi-rating" class="form-select">
                        <option value="0">Choose</option>
                        <?php foreach ($pegi_rating as $pegi_rating) : ?>
                            <option value="<?= $pegi_rating->id ?>"><?= $pegi_rating->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="mt-1 d-none" id="pegi-rating-error"></div>
                </div>
                <div class="mb-2">
                    <label for="genres" class="mb-1">Genres</label>
                    <div class="row">
                        <?php foreach ($genres as $genre) : ?>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?= $genre->id ?>" name='genres' id="genre_<?= $genre->id ?>">
                                    <label class="form-check-label" for="genre_<?= $genre->id ?>">
                                        <?= $genre->name ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-1 d-none" id="genres-error"></div>
                </div>
                <div class="mb-2">
                    <label for="date" class="mb-1">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                    <div class="mt-2 d-none" id="date-error"></div>
                </div>
                <div class="mb-2">
                    <label for="trailer" class="mb-1">Trailer</label>
                    <input type="text" name="trailer" id="trailer" class="form-control">
                    <div id="trailer-error" class="mt-1 d-none"></div>
                    <div class="ratio ratio-16x9 d-none  mt-2">
                        <iframe id="trailer_url" src="" title="YouTube video" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="d-grid gap-1">
                    <button class="btn btn-sm btn-primary" id="btnSaveGame" type="button">Save</button>
                    <button class="btn btn-sm btn-danger" id="btnResetGame" type="button">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>