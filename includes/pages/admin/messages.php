<?php
if (!isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['user']->role_id != 2) {
    header("Location: index.php?page=errors&code=403");
}
$messages = getAllMessages();
$pages = messagePagination();
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-10 mx-auto">
            <div class="d-none my-2" id="message-message"></div>
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Full name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Read</th>
                        </tr>
                    </thead>
                    <tbody id="messages">
                        <?php foreach ($messages as $index => $message) : ?>
                            <tr id="message_<?= $index ?>">
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= $message->first_name . ' ' . $message->last_name ?></td>
                                <td><?= $message->email ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($message->created_at)) ?></td>
                                <td><button type="button" class="btn btn-primary btn-sm btn-read-message" data-id="<?= $message->id ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Read</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="message-pages">
                        <?php
                        for ($i = 0; $i < $pages; $i++) : ?>
                            <li class="page-item <?= $i == 0 ? 'active' : '' ?>"><a class="page-link message-page" data-limit='<?= $i ?>' href="#"><?= $i + 1 ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <div class="mb-1">From:<span class="ms-2" id="user-name"></span></div>
                    <div class="text-muted fw-bold me-2">Email: <span id="user-email"></span></div>
                </div>
                <hr>
                <p class="text-justify" id="user-message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>