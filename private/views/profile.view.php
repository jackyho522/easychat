<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>
<!--https://getbootstrap.com/docs/4.0/layout/grid/-->
<div class="overlay">
    <?php if (isset($_SESSION['user_data'])) : ?>
        <?php $this->view('include/crumbs') ?>
    <?php endif; ?>

    <div class="row">
        <form class="profile-form" action="profile">
            <div class="userprofile row">
                <div class="userinfo col">
                    <div>
                        <h2 class="fw-bold m-2">Profile Picture:</h2>
                    </div>
                    <div class="usericon row">
                        <?php
                        echo "<img src='";
                        if (isset($data['filename'])) {
                            echo assets . 'usericon/' . $data['filename'];
                        } else {
                            echo assets . 'defaulticon.png';
                        }
                        echo "' class='rounded m-5 d-block border-3 img-thumbnail'";
                        echo "style='width:300px'>";
                        ?>
                    </div>
                    <div class="username card border-info">
                        <div class="row">
                            <div>
                                <h6 class="m-2">Full Name</h6>
                            </div>
                            <div class="text-success fw-bold m-2">
                                <?php echo $data['firstname'] . ' ' . $data['lastname']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div>
                                <h6 class="m-2">Email</h6>
                            </div>
                            <div class="text-success fw-bold m-2">
                                <?php echo $data['email']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div>
                                <h6 class="m-2">Nickname</h6>
                            </div>
                            <div class="text-success fw-bold m-2">
                                <?php echo $data['nickname']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--https://getbootstrap.com/docs/4.0/components/card/-->
                <div class="userdetail card col border-info">
                    <div class="card-body">
                        <div class="row">
                            <div>
                                <h6 class="mb-0">Age</h6>
                            </div>
                            <div class="text-success fw-bold m-2">
                                <?php echo $data['age']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div>
                                <h6 class="mb-0">Gender</h6>
                            </div>
                            <div class="text-success fw-bold m-2">
                                <?php echo $data['gender']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div>
                                <h6 class="mb-0">Self Short Description</h6>
                            </div>
                            <div class="text-success fw-bold m-2">
                                <?php echo $data['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<?php $this->view('includes/footer') ?>