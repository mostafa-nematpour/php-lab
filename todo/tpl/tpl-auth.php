<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodePen - login-signup</title>
  <link rel="icon" href="<?= BASE_URL ?>assets/img/t.svg">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/auth-style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div id="background">
    <div id="panel-box">
      <div class="panel">
        <div class="auth-form on" id="login">
          <div id="form-title">Log In</div>



          <form action="<?= site_url('auth.php?action=login') ?>" method="POST">
            <input name="email" type="text" required="required" placeholder="Email" />
            <input name="password" type="password" required="required" placeholder="Password" />

            <?php if ($alert == 1) : ?>
              <h5>Log in to access the account</h5>
            <?php elseif ($alert == 2) : ?>
              <h3>Operation Faile</h3>
            <?php endif; ?>

            <button type="Submit">Log In</button>
          </form>
        </div>
        <div class="auth-form" id="signup">
          <div id="form-title">Register</div>
          <form action="<?= site_url('auth.php?action=register') ?>" method="POST">
            <input name="username" type="text" required="required" placeholder="Username" />
            <input name="password" type="password" required="required" placeholder="Password" />
            <input name="email" type="text" required="required" placeholder="Email" />
            <button type="Submit">Sign Up</button>
          </form>
        </div>
      </div>
      <div class="panel">
        <div id="switch">Sign Up</div>
        <div id="image-overlay"></div>
        <div id="image-side" style="background: url('<?= BASE_URL ?>assets/img/Learning.jpg');background-size: auto 100%; background-position: center center; background-repeat: no-repeat;"></div>
      </div>
    </div>
  </div>
  <!-- partial -->
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src="<?= BASE_URL ?>assets/js/auth-script.js"></script>

</body>

</html>