
<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="contact_area">
                    <h2>Contact Us</h2>
                    <form action="contact-send" method="POST" class="contact_form">
                        <input class="form-control" type="text" placeholder="Name*" name="name" value="<?= isset($data['paramsContact']['name']) ? $data['paramsContact']['name'] : ""  ?>">
                        <input class="form-control" type="email" placeholder="Email*" name="email" value="<?= isset($data['paramsContact']['email']) ? $data['paramsContact']['email'] : ""  ?>">
                        <textarea class="form-control" cols="30" rows="10" placeholder="Message*" name="message" > <?= isset($data['paramsContact']['message']) ? $data['paramsContact']['message'] : ""  ?>  </textarea>
                        <input type="submit" value="Send Message" name="submitContact">
                    </form>

                    <?php
                        if (isset($data['errors'])) {

                            foreach ($data['errors'] as $error) {

                                echo "<div class='alert-danger'>". $error . "</div>";
                            }
                        }

                    ?>

                </div>
            </div>
        </div>

    </div>
</section>