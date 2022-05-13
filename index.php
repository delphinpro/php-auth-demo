<?php
require_once __DIR__.'/boot.php';

$user = null;

if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Php auth demo</title>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<div class="container">
  <div class="row py-5">
    <div class="col-lg-6">

        <?php if ($user) { ?>

          <h1>Welcome back, <?=$user['username']?>!</h1>

          <form class="mt-5" method="post" action="do_logout.php">
            <button type="submit" class="btn btn-primary">Logout</button>
          </form>

        <?php } else { ?>

          <h1 class="mb-5">Registration</h1>

            <?php flash(); ?>

          <form method="post" action="do_register.php">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">Register</button>
              <a class="btn btn-outline-primary" href="login.php">Login</a>
            </div>
          </form>

        <?php } ?>

    </div>
  </div>
</div>

</body>
</html>
