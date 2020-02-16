<?php

namespace MyApp\Model;

// $score = $_POST['score'];

// echo $score;
class ajax extends \MyApp\Model {
  public function Updatescore($values) {
    echo $values['score'];
    echo $values['email'];
    //受け取った情報をもとにレコードをアップデート
    $stmt = $this->db->prepare("UPDATE users set score = :score where email = :email");
    $stmt->execute([
        ':score' => $values['score'],
        ':email' => $values['email'],
       ]);
  }

  public function Getquizzes(){
    $sql = "SELECT quiz FROM qizzes";
$sth = $pdo -> prepare($sql);
$sth -> bindValue(':gender', $gender, PDO::PARAM_STR);
$sth -> bindValue(':type', $type, PDO::PARAM_STR);
$sth -> execute();
$aryResult = $sth -> fetchAll(PDO::FETCH_COLUMN);

  }

}


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