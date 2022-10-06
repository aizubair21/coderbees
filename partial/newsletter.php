<div class="pb-3">
    <div class="mb-3 border-bottom border-primary">
        <h4 class="m-0 py-2 px-4 bg-primary text-light d-inline-flex">Newsletter</h4>
    </div>
    <div class="bg-light text-justify p-4 mb-3">
        <p>Wanna subscribe your newslatter. Everytime you get an email, if there anything chagnge of updated or added.<br>If you do please subscribe !</p>
        <div class="input-group" style="width: 100%;">
            <form name="newsletterForm">
                <input type="email" id="newsletterEmailField" class="form-control form-control-lg" placeholder="Your Email" name="email">
                <small>Subscribe can get all emaail by his provided email.</small>
                <div class="input-group-append py-3">
                    <button type="button" id="newsletterButon" onclick="getNewsletter(newsletterForm.email.value)" name="subscribe" class="btn btn-primary">Subscribe</button>
                </div>

            </form>
        </div>
    </div>
</div>