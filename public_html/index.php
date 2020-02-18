<?php

// ユーザーの一覧

require_once(__DIR__ . '/../config/config.php');


$app = new MyApp\Controller\Index();

$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  
</head>
<body>

  <p id="target">click to start</p>
  <p class="info">
    Letter count: <span id="score">0</span>,
    Miss count: <span id="miss">0</span>,
    Time left: <span id="timer">0.00</span>
  </p>
  <p id="comment">hi</p>

  <div id="container">
    <form action="logout.php" method="post" id="logout">
       <input type="submit" value="Log Out">
    </form>
  </div>

  <script src="main.js"></script>

</body>
</html>
