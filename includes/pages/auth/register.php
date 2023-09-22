<div class="container">
    <div class="row mt-5">
        <div class="col-lg-4 mx-auto">
            <div class="d-none my-2" id="register-message"></div>
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                <img src="assets/img/joypad-logo.svg" alt="joypad-logo" width="80">
                <div class="fs-1  fw-bold">Joypad</div>
            </div>
            <form action="#">
                <div class="mb-2">
                    <label for="first-name" class="mb-1">First name</label>
                    <input type="text" name="first-name" id="first-name" class="form-control">
                    <div class="d-none mt-1" id="first-name-error"></div>
                </div>
                <div class="mb-2">
                    <label for="last-name" class="mb-1">Last name</label>
                    <input type="email" name="last-name" id="last-name" class="form-control">
                    <div class="d-none mt-1" id="last-name-error"></div>
                </div>
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
                <div class="d-grid"><button class="btn btn-sm btn-dark" id="btnRegister" type="button">Register</button></div>
                <div class="d-flex justify-content-center mt-2">
                    <div class="me-2">Allready have an account?</div>
                    <a href="index.php?page=login" class="text-decoration-none">Log in</a>
                </div>
            </form>
        </div>
    </div>
</div>