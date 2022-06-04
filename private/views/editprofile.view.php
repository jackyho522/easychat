<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>
<!--https://getbootstrap.com/docs/4.0/layout/grid/-->
<div class="container-fluid shadow p-3 bg-white">
    <?php $this->view('include/crumbs') ?>
    <h4>Profile</h4>
    <div class="row">
        <form class="profile-form" action="editprofile" enctype="multipart/form-data" method="POST">
            <div class="uploadpic col-10 mx-auto border border-5 m-5">
                <div>
                    <h6 class="text-info fw-bold m-2">Profile Picture:</h6>
                </div>
                <div class="col-2">
                    <input type="file" class="form-control" name="uploadfile">
                </div>
                <span class="invalidFeedback">
                    <?php echo $data['fileError']; ?>
                </span>
            </div>

            <!--https://getbootstrap.com/docs/4.0/components/card/-->
            <div class="card col-10 mx-auto border border-5 border-info solid 10px">
                <div class="card-body">
                    <div class="row">
                        <div>
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="m-2">
                            <input type="text" class="form-control" name="firstname" placeholder="First Name">
                        </div>
                        <div class="m-2">
                            <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                        </div>
                        <span class="invalidFeedback">
                            <?php echo $data['nameError']; ?>
                        </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div>
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="m-2">
                            <input type="email" class="form-control" name="email" placeholder="Email Address">
                        </div>
                        <span class="invalidFeedback">
                            <?php echo $data['emailError']; ?>
                        </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div>
                            <h6 class="mb-0">Nickname</h6>
                        </div>
                        <div class="m-2">
                            <input type="nickname" class="form-control" name="nickname" placeholder="Nickname">
                        </div>
                        <span class="invalidFeedback">
                            <?php echo $data['nicknameError']; ?>
                        </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div>
                            <h6 class="mb-0">Age</h6>
                        </div>
                        <div class="m-2">
                            <input type="age" class="form-control" name="age" placeholder="Age">
                        </div>
                        <span class="invalidFeedback">
                            <?php echo $data['ageError']; ?>
                        </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div>
                            <h6 class="mb-0">Self Short Description</h6>
                        </div>
                        <div class="m-2">
                            <textarea type="description" class="form-control" name="description" placeholder="description" rows="5"></textarea>
                        </div>
                        <span class="invalidFeedback">
                            <?php echo $data['descriptionError']; ?>
                        </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div>
                            <h4 class="mb-0 text-danger">Enter your account details to confirm update.</h4>
                            <h6 class="mb-0 text-danger">Username*</h6>
                        </div>
                        <div class="m-2">
                            <input type="username" class="form-control" name="username" placeholder="Username">
                        </div>
                        <span class="invalidFeedback">
                            <?php echo $data['usernameError']; ?>
                        </span>
                    </div>
                    <div class="row">
                        <div>
                            <h6 class="mb-0 text-danger">Password*</h6>
                        </div>
                        <div class="m-2">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <span class="invalidFeedback">
                            <?php echo $data['passwordError']; ?>
                        </span>
                        <div class="m-2">
                            <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
                        </div>
                        <span class="invalidFeedback">
                            <?php echo $data['confirmpasswordError']; ?>
                        </span>
                    </div>
                    <hr>

                    <div class="form-button mt-5">
                        <button id="submit" type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<?php $this->view('includes/footer') ?>