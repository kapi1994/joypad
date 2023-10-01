<div class="container">
    <div class="row mt-5">
        <div class="col-lg-6 mx-auto">
            <div class="d-none my-2" id="contact-message"></div>
            <div class="fs-2 mb-3">Contact us</div>
            <form action="#">
                <div class="mb-2">
                    <label for="first-name" class="mb-1">First name</label>
                    <input type="text" name="first-name" id="first-name" class="form-control">
                    <div class="mb-1 d-none" id="first-name-error"></div>
                </div>
                <div class="mb-2">
                    <label for="last-name" class="mb-1">Last name</label>
                    <input type="text" name="last-name" id="last-name" class="form-control">
                    <div class="mb-1 d-none" id="last-name-error"></div>
                </div>
                <div class="mb-2">
                    <label for="email" class="mb-1">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                    <div class="mb-1 d-none" id="email-error"></div>
                </div>
                <div class="mb-2">
                    <label for="message" class="mb-1">Message</label>
                    <textarea name="message" id="message" cols="30" rows="5" class="form-control"></textarea>
                    <div class="mb-1 d-none" id="message-error"></div>
                </div>
                <div class="col-4 col-lg-3">
                    <div class="d-grid"><button class="btn btn-sm btn-dark" id="btnContactUs" type="button">Contact us</button></div>
                </div>
            </form>
        </div>
    </div>
</div>