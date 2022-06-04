<?php $this->view('include/header') ?>
<?php $this->view('include/nav') ?>
<script type="text/javascript" src="<?= js ?>users.js"></script>

<div class="overlay">
    <div class="user-box">
        <?php
        for ($i = 0; $i < count(array_keys($data))-1; $i++) {
            if (!($data[$i]['username'] === $data[sizeof($data)-1])) {
                echo "<div class='user row'>";
                echo "<div class='icon col-sm-2'>";
                if (empty($data[$i]['filename'])){
                    echo "<img class='pic' src='public/assets/defaulticon.png" . $data[$i]['filename'] . "' alt=''>";
                } else {
                    echo "<img class='pic' src='public/assets/usericon/" . $data[$i]['filename'] . "' alt=''>";
                }
                echo "</div>";
                echo "<div class='name fw-bold m-2 p-4 col-sm-2'>";
                echo "<a href='profile" . "?nickname=" . $data[$i]['nickname'] . "'>";
                echo $data[$i]['firstname'] . ' ' . $data[$i]['lastname'];
                echo "</a>";
                echo "</div>";
                echo "<div class='status fw-bold m-2 p-4 col-sm-4'>";
                if ($data[$i]['status'] == 1) {
                    echo "<input type='button' class='pm btn btn-primary' name='pm' id='pm' value='Private Message'/>";
                    echo "<input type='hidden' class='private btn btn-primary' name='private' id='private' value='" . $data[$i]['user_token'] . "'/>";
                } else {
                    echo "Offline";      
                }
                echo "</div>";
                echo "<div class='col-2 status-dot" . $data[$i]['status'] . "'>";
                echo "<i class='fas fa-circle'></i></div>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>

<?php $this->view('include/footer') ?>