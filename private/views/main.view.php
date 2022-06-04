<?php $this->view('include/header') ?>

<?php $this->view('include/nav') ?>

<div class='overlay'>
    <div class="parallax">
    </div>
    <div class="row m-2">
        <h1><i class="fa-solid fa-heart"></i>
            <br>Simple and Easy
        </h1>
    </div>
    <div class="row m-2">
        <div class="img-box col-sm-7 mx-auto">
            <img src="<?= assets ?>chatcover.jpeg" class="coverpic" alt="coverpic">
        </div>
        <div class="col-sm-4 mx-auto">
            <div class="mainheader display-4">
                EasyChat
            </div>
            <hr>
            <div class="maininfo p-3 mb-2">
                <h3>
                    A highly-curated platform for connecting the people.
                    <br>
                    Join us and share with the people in your life.
                </h3>
            </div>
            <hr>
            <div class="maininfo p-3 mb-2">
                <h3>
                    Lets join together!
                </h3>
                <?php if (!isset($_SESSION['user_data'])) : ?>
                <div class="maininfo text-center mt-2 mb-2 display-3">
                    <a href="login"><button type="button" class="btn btn-primary">Login</button></a>
                    <i class="fa-solid fa-key"></i>
                </div>
                <div class="maininfo text-center mt-2 display-3">
                    <a href="register"><button type="button" class="btn btn-primary">Register</button></a>
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <?php endif; ?>
            </div>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 m-5 mx-auto display-2">

        </div>
    </div>
</div>

<?php $this->view('include/footer') ?>