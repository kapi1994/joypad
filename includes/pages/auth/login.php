<div class="container">
    <div class="row mt-5">
        <div class="col-lg-4 mx-auto">
            <div class="d-none my-2" id="login-message"></div>
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                <img src="assets/img/joypad-logo.svg" alt="joypad-logo" width="80">
                <div class="fs-1  fw-bold">Joypad</div>
            </div>
            <form action="#">
                <div class="mb-2">
                    <label for="email" class="mb-1">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                    <div class="d-none mt-1" id="email-error"></div>
                </div>
                <div class="mb-2">
                    <label for="password" class="mb-1">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div class="d-none mt-1" id="password-error"></div>
                </div>
                <div class="d-grid"><button class="btn btn-sm btn-dark" id="btnLogIn" type="button">Log in</button></div>
                <div class="d-flex justify-content-center mt-2">
                    <div class="me-2">Don't have an account?</div>
                    <a href="index.php?page=register" class="text-decoration-none">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>