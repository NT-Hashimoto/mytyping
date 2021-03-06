<?php

// 新規登録

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Signup();
$app->run();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>タイピング</h1>
  </header>
  <div id="container">
    <form action="" method="post" id="signup" >
      <p>
        <input type="text" name="email" placeholder="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>" >
      </p>
      <p class="err"><?= h($app->getErrors('email')); ?></p>
      <p>
        <input type="password" name="password" placeholder="password">
      </p>
      <!-- エラーをgetする(表示する) -->
      <p class="err"><?= h($app->getErrors('password')); ?></p>
      <!-- formにidを付けたので、以下のボタンをクリックすればフォーム情報を送信できる -->
      <div class="btn" onclick="document.getElementById('signup').submit();">Sign Up</div>
      <p class="fs12"><a href="login.php">Log In</a></p>
    </form>
  </div>
</body>
</html>
