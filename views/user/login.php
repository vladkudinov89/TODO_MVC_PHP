<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="container">

        <div class="card card-container">
            <h2>Вход на сайт</h2>
            <img id="profile-img" class="profile-img-card" src="../../resources/images/login_avatar.png"/>
            <p id="profile-name" class="profile-name-card"></p>

            <form class="form-signin" action="#" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address"
                       required autofocus value="<?php echo $email; ?>">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password"
                       required value="<?php echo $password; ?>">
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit">Sign in</button>
            </form>
        </div>
    </div>

<?php include ROOT . '/views/layouts/footer.php'; ?>