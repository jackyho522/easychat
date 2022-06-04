<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>
<!--- Ctrl+F5 for hard refresh --->
<div class="overlay">
    <div class="login-form-box row">
        <div class="form-l col-6">
            <h3>Login to our site</h3>
            <p>Enter your username and password to log on:</p>
            <div>
                <img src="assets/login.jpg" class="img-fluid mw-100" style="height:700px;width:600px;">
            </div>
        </div>
        <div class="form-r col-6">
            <form class="login-form" action="login" method="POST">
                <h5>Username: </h5>
                <input type="username" class="form-control" placeholder="Username" name="username" autofocus autocomplete="off">
                <span class="invalidFeedback">
                    <?php echo $data['usernameError']; ?>
                </span>
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="invalidFeedback">
                    <?php echo $data['passwordError']; ?>
                </span>
                <div class="form-button mt-5">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <p class="options">Not registered yet? <a href="register"> Create an account!</a></p>
            </form>
        </div>
    </div>
</div>
<?php $this->view('include/footer') ?>