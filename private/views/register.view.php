<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>

<div class="overlay">
    <div class="form-box">
        <div class="form-items">
            <div class="form-top row">
                <div>
                    <img src="assets/register.jpg" class="mw-100" style="height:300px;width:1000px;">
                </div>
                <div class="mt-1">
                    <h3>Register to our site</h3>
                    <p>Enter your information: </p>
                </div>
            </div>

            <div class="form-bottom row">
                <form class="register-form" action="register" method="POST">
                    <div>
                        <h6>Name: </h6>
                        <div class="m-1">
                            <input type="text" class="form-control" name="firstname" placeholder="First Name" autocomplete="off">
                        </div>
                        <div class="m-1">
                            <input type="text" class="form-control" name="lastname" placeholder="Last Name" autocomplete="off">
                        </div>
                        <span class="invalidFeedback">
                            <?php echo $data['nameError']; ?>
                        </span>
                    </div>
                    <div class="m-1">
                        <h6>Gender: </h6>
                        <input class="btn-check" type="radio" name="gender" id="male" value="male" autocomplete="off">
                        <label class="btn btn-sm" for="male">Male</label>

                        <input class="btn-check" type="radio" name="gender" id="female" value="female" autocomplete="off">
                        <label class="btn btn-sm" for="female">Female</label>

                        <input class="btn-check" type="radio" name="gender" id="secret" value="secret" checked="checked" autocomplete="off">
                        <label class="btn btn-sm" for="secret">Secret</label>
                        <span class="invalidFeedback">
                            <?php echo $data['buttonError']; ?>
                        </span>
                    </div>
                    <div class="m-1">
                        <h6>Nickname: </h6>
                        <input type="nickname" class="form-control" name="nickname" placeholder="Nickname">
                    </div>
                    <span class="invalidFeedback">
                        <?php echo $data['nicknameError']; ?>
                    </span>
                    <div class="m-1">
                        <h6>Username: </h6>
                        <input type="username" class="form-control" name="username" placeholder="Username">
                    </div>
                    <span class="invalidFeedback">
                        <?php echo $data['usernameError']; ?>
                    </span>
                    <div class="m-1">
                        <h6>Email: </h6>
                        <input type="email" class="form-control" name="email" placeholder="E-mail Address">
                    </div>
                    <span class="invalidFeedback">
                        <?php echo $data['emailError']; ?>
                    </span>
                    <div class="m-1">
                        <h6>Password: </h6>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <span class="invalidFeedback">
                        <?php echo $data['passwordError']; ?>
                    </span>
                    <div class="m-1">
                        <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
                    </div>
                    <span class="invalidFeedback">
                        <?php echo $data['confirmpasswordError']; ?>
                    </span>
                    <br>
                    <div class="text form-check">
                        <input class="form-check-input" type="hidden" name="confirm" value="0">
                        <input class="form-check-input" type="checkbox" name="confirm" value="1">
                        <label class="form-check-label">I confirm that all data is correct</label>
                        <span class="invalidFeedback">
                            <?php echo $data['confirmError']; ?>
                        </span>
                    </div>

                    <div class="form-button mt-3 text-center">
                        <button id="submit" type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php $this->view('include/footer') ?>