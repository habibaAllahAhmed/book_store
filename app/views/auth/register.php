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


  <section id="Register" class="my-5">
    <form method='POST' action="<?= route('/auth/register') ?>" class=" m-auto">
      <?= getSessionMsg('correct', false) ?>
      <?= getSessionMsg('invalid') ?>
      <h2 class="text-center mt-2 mb-4 text-success">Register</h2>
      <div class="mb-3">
        <label for="Role" class="form-label">Role:</label>
        <select name="role" class="form-control" id="Role">
          <option value="" <?= oldSelect('role', '') ?> hidden></option>
          <?php
          if (isAuth('admin')) {
            $select = oldSelect('role', 'admin', true);
            echo "<option value='admin' {$select}>Admin</option>";
          } else {
            $select = oldSelect('role', 'customer', true);
            echo "<option value='customer' {$select}>Customer</option>";
          }
          ?>
        </select>
        <?= getErr('role') ?>
      </div>
      <div class="mb-3">
        <label for="Name" class="form-label">Name:</label>
        <input type="text" name="name" class="form-control" value="<?= old('name') ?>" id="Name">
        <?= getErr('name') ?>
      </div>
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
      <div class="mb-3">
        <label for="Phone" class="form-label">Phone:</label>
        <input type="text" name="phone" value="<?= old('phone') ?>" class="form-control" id="Phone">
        <?= getErr('phone') ?>
      </div>
      <div class="mb-3">
        <label for="Gender" class="form-label">Gender:</label>
        <select name="gender" class="form-control" id="Gender">
          <option value="" <?= oldSelect('gender', '') ?> hidden></option>
          <option value="male" <?= oldSelect('gender', 'male') ?>>male</option>
          <option value="female" <?= oldSelect('gender', 'female', true) ?>>female</option>
        </select>
        <?= getErr('gender') ?>
      </div>
      <button type="submit" class="btn btn-success w-100">Register</button>
    </form>
  </section>


  <script src="<?php echo asset("js/bootstrap.js") ?>"></script>
  <script src="<?php echo asset("js/jQuery.js") ?>"></script>
</body>

</html>