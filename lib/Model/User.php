<?php

namespace MyApp\Model;

class User extends \MyApp\Model {
  // valuesには
  // [
  //   'email' => $_POST['email'],
  //   'password' => $_POST['password']
  // ]
  // というような配列が入る
  public function create($values) {
    //受け取った情報をもとにレコードを追加
    $stmt = $this->db->prepare("insert into users (email, password, created, modified) values (:email, :password, now(), now())");
       $res = $stmt->execute([
         ':email' => $values['email'],
         ':password' => password_hash($values['password'], PASSWORD_DEFAULT)
       ]);
       if ($res === false) {
         throw new \MyApp\Exception\DuplicateEmail();
       }

  }

  public function login($values) {
    $stmt = $this->db->prepare("select * from users where email = :email");
    $stmt->execute([
      ':email' => $values['email']
    ]);
    //データをオブジェクト形式で取得
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();

    //userがいない場合
    if (empty($user)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    // パスワードがマッチしなかった場合
    if (!password_verify($values['password'], $user->password)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    return $user;
  }

  //score
  public function inputscore($values) {
    //受け取った情報をもとにレコードを追加
    $stmt = $this->db->prepare("insert into users (score) values (:score");
       $res = $stmt->execute([
         ':score' => $values['score'],
       ]);
       echo json_encode($res);
       if ($res === false) {
         throw new \MyApp\Exception\DuplicateEmail();
       }
      }
}