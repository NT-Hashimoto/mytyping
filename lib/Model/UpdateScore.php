<?php
require_once(__DIR__ . '/../../config/config.php');

$email=$_SESSION['me']->email;

try {
  $db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);

  //受け取った情報をもとにレコードをアップデート
  function Updatescore($values,$db) {
    $stmt = $db->prepare("UPDATE users set score = :score where email = :email");
    $stmt->execute([
        ':score' => $values['score'],
        ':email' => $values['email'],
       ]);
  }//end updatescore

  //過去の得点を取得する
  function Getscore($values,$db) {
    $stmt = $db->prepare("SELECT score FROM users where email = :email");
    $stmt->execute([
        ':email' => $values['email'],
       ]);
    $result = $stmt->fetch();
    echo "前回".$result[0]."点、今回".$values['score']."点です";
  }//end Getscore
  

  

  if(isset($_POST['score'])){
  
    Getscore([
      'score' => $_POST['score'],
      'email' => $email,
    ],$db);
    Updatescore([
      'score' => $_POST['score'],
      'email' => $email,
    ],$db);
    }//end if(isset($_POST['score']))
    
    
  
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

