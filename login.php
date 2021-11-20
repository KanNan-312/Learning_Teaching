<?php
    // $wrong_cred = "";
    // if(isset($_POST["id"]) and isset($_POST["password"])) {
    //     $usr_id = $_POST["id"];
    //     $usr_pwd = $_POST["password"];
    //     $sql = "SELECT * FROM Users WHERE id = '$usr_id' AND password = '$usr_pwd'";
    //     $result = mysqli_query($conn, $sql);
    //     if(mysqli_num_rows($result) === 1) {
    //         $row = mysqli_fetch_assoc($result);
    //         $_SESSION["id"] = $usr_id;
    //         $_SESSION["user_real_name"] = $row["name"];
    //         $_SESSION["role"] = $row["Role"];
    //         echo "
    //             <script>window.location.href = 'index.php?page=home';</script>;
    //         ";
    //     }
    //     else {
    //         $wrong_cred = "Wrong id or password.";
    //     }
    // }
    $_SESSION["id"] = '123';
?>

<h1 class="login-header">Login</h1>
<div class="bg-text" id="form">
    <form action="index.php", method="post" name="login_form">
        <div class="mb-3">
            <label class="form-label">Your ID:</label>
            <input type="text" class="form-control" name="id" placeholder="ID ...">
        </div>
        <div class="mb-3">
            <label class="form-label" >Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Password ...">
        </div>
        <?php //echo $wrong_cred ?>
        <div style="text-align: center">
            <p id="wrong-info-alert" style="color: red;"></p>
            <button type="submit" class="btn btn-primary" style="background-color: white; border: none; color: black;">Login</button>
        </div>
    </form>
</div>