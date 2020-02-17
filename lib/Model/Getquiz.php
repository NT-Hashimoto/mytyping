<?php
require_once(__DIR__ . '/../../config/config.php');
header("Content-Type: application/json; charset=UTF-8");


$email=$_SESSION['me']->email;

try {
  $db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);

  
  function Getquizzes($db){
        $stmt = $db -> query("SELECT quiz FROM quizzes");
        $stmt -> execute();
        $quiz = $stmt -> fetchAll(PDO::FETCH_COLUMN);
        echo json_encode($quiz);
      }


  if(isset($_GET['isplaying'])){
    Getquizzes($db);
    }//end if(isset($_POST['score']))
    
    
  
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}
