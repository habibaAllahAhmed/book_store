<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo asset("css/bootstrap.css"); ?>">
  <link rel="stylesheet" href="<?php echo asset("css/global.css"); ?>">
  <link rel="stylesheet" href="<?php echo asset("css/index.responsive.css"); ?>">

</head>

<body>

  <?php include __DIR__ . "/../components/navbar.php"; ?>

  <section id="Login" class="my-5">
    <form class=" m-auto" method="POST" action="<?= route('/auth/login') ?>">
      <?= getSessionMsg('invalid') ?>
      <h2 class="text-center mt-2 mb-4 text-success">Login</h2>
      <div class="mb-3">
        <label for="Email" class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" value="<?= old('email') ?>" id="Email">
        <?= getErr('email') ?>
      </div>
      <div class="mb-3">
        <label for="Password" class="form-label">Password:</label>
        <input type="password" name="password" class="form-control" value="<?= old('password') ?>" id="Password">
        <?= getErr('password') ?>
      </div>
      <button type="submit" class="btn btn-success w-100">Login</button>
    </form>
  </section>

  <script src="<?php echo asset("js/bootstrap.js") ?>"></script>
  <script src="<?php echo asset("js/jQuery.js") ?>"></script>
</body>

</html>