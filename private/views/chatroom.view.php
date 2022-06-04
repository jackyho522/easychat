<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>
<script type="text/javascript" src="<?= js ?>chatroom.js"></script>

<div class="overlay">
    <div class="chat-box">
        <br>
        <h3 class="text-center">Public Chat</h3>
        <br>

        <div class="row">
            <!---user information--->
            <div class="col-sm-3">
                <?php
                $login_id = '';
                foreach ($_SESSION['user_data'] as $key => $value) {
                    $login_id = explode(',', $value['id'])[1];
                ?>
                    <input type="hidden" name="login_id" id="login_id" value="<?php echo $login_id; ?>" />
                    <div class="mt-3 mb-3 text-center">
                        <?php
                        echo "<img src='";
                        if (isset($value['profile'])) {
                            echo assets . 'usericon/' . $value['profile'];
                        } else {
                            echo assets . 'defaulticon.png';
                        }
                        echo "' class='img-fluid rounded mx-auto d-block border-3 img-thumbnail'";
                        echo "width='150'>";
                        ?>
                        <h3 class="mt-2 text-success"><?php echo $value['name']; ?></h3>
                        <a href="editprofile" class="btn btn-primary mt-2 mb-2">Edit</a>
                        <input type="button" class="btn btn-primary mt-2 mb-2" name="logout" id="logout" value="Logout" />
                    </div>
                <?php
                }
                ?>
            </div>
            <!---chat area--->
            <div class="col-sm-7 m-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-sm-6">
                                <h3>Chat Room</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="msg_area">
                        <?php
                        foreach ($data as $chat) {
                            if (isset($_SESSION['user_data'][$chat['uuid']])) {
                                $from = 'Me';
                                $row_class = 'row justify-content-start';
                                $background_class = 'text-dark alert-primary';
                            } else {
                                $from = $chat['username'];
                                $row_class = 'row justify-content-end';
                                $background_class = 'alert-success';
                            }
                            echo '<div class="' . $row_class . '">
                            <div class="col-sm-10">
                                <div class="shadow-sm alert ' . $background_class . '">
                                    <b>' . $from . ' : </b>' . $chat["msg"] . '
                                    <br>
                                <div class="text-right">
                                    <small class="text-muted"><i>' . $chat["created_on"] . '</i></small>
                                </div>
                                </div>
                            </div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>

                <form class="chat_form" name="chat_form" id="chat_form" data-parsley-errors-container="#error" method="POST">
                    <div class="input-group mb-3">
                        <textarea class="form-control" id="chat_msg" name="chat_msg" placeholder="Type Message Here" data-parsley-maxlength="500" data-parsley-pattern="/[A-Za-z\d!@#$%^&*()\-_+=~\/\?\[\]\|\'{}+]{0,}$/" data-parsley-pattern-message="Only english and numbers are allowed." required data-parsley-required-message="The textbox is empty."></textarea>
                        <div class="input-group-append">
                            <button type="submit" name="send" id="send" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </div>
                    <div id="error"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->view('includes/footer') ?>