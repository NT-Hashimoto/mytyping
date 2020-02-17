<?php
require_once(__DIR__ . '/../../config/config.php');
// header("Content-Type: application/json; charset=UTF-8");


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
    echo "得点を記録しました";
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







// function Getquizzes(){
//     $stmt =$db -> query("SELECT id,quiz FROM quizzes");
//     $stmt -> execute();
//     $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
//     $quiz = $stmt -> fetchAll();
//     echo json_encode($quiz);
//   }




// namespace MyApp\Model;
// class ajax extends \MyApp\Model {
//   public function Updatescore($values) {
//     echo $values['score'];
//     echo $values['email'];
//     //受け取った情報をもとにレコードをアップデート
//     $stmt = $this->db->prepare("UPDATE users set score = :score where email = :email");
//     $stmt->execute([
//         ':score' => $values['score'],
//         ':email' => $values['email'],
//        ]);
//   }

//   public function Getquizzes(){
//     $stmt = $this->db -> query("SELECT id,quiz FROM quizzes");
//     $stmt -> execute();
//     $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
//     $quiz = $stmt -> fetchAll();
//     echo json_encode($quiz);
//   }

// }


// データベース接続

// try {
//   $this->db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
// } catch (\PDOException $e) {
//   echo $e->getMessage();
//   exit;
// }
// // データ取得
// $sql = "INSERT INTO  users (score) values $score";
// $stmt = ($dbh->prepare($sql));
// $stmt->execute(array($id));

// //あらかじめ配列を生成しておき、while文で回します。
// $memberList = array();
// while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//  $memberList[]=array(
//   'id' =>$row['id'],
//   'name'=>$row['name'],
//   'mail'=>$row['mail']
//  );
// }

// //jsonとして出力
// header('Content-type: application/json');
// echo json_encode($memberList,JSON_UNESCAPED_UNICODE);