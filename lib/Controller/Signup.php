<?php

namespace MyApp\Controller;

class Signup extends \MyApp\Controller {

  public function run() {
    //ログインしていたらホームに飛ばす
    if ($this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit;
    }

    //フォームがもしポストされたら
    //POSTで送信された時点で$_SERVER['REQUEST_METHOD'] === 'POST'になり
    //このif文が処理。そのためsignup.phpの頭でapp->runしている
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //検証→ユーザー作成→画面の遷移
      $this->postProcess();
    }
  }

  //フォームを受け取ったらやること　検証→ユーザー作成→画面の遷移
  protected function postProcess() {
    // 投稿されたフォームの検証
    try {
      $this->_validate();
    } catch (\MyApp\Exception\InvalidEmail $e) {
       $this->setErrors('email', $e->getMessage());
    } catch (\MyApp\Exception\InvalidPassword $e) {
      $this->setErrors('password', $e->getMessage());
    }


    //valuesオブジェクトのemailプロパティに値をセット
    $this->setValues('email', $_POST['email']);

    //errorオブジェクトが空でなければ
    if ($this->hasError()) {
      return;
    } else {
          // user作成
          try {
                 $userModel = new \MyApp\Model\User();
                 //createの引数はobject
                 //POSTで受け取った値をkeyであるemailとpasswordに入れる
                 $userModel->create([
                   'email' => $_POST['email'],
                   'password' => $_POST['password']
                 ]);
               } catch (\MyApp\Exception\DuplicateEmail $e) {
                 //emailが既に存在する場合にエラー
                 $this->setErrors('email', $e->getMessage());
                 return;
               }

               // login画面へリダイレクト
               header('Location: ' . SITE_URL . '/login.php');
               exit;
    }

  }


  //投稿されたフォームの検証
  private function _validate() {
    //データをフィルタリング
    //filter_var(対象、フィルターの型)で対象が型に沿った場合1
    //emailがemailの型に合わなかったら
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      //例外クラスを返す
      throw new \MyApp\Exception\InvalidEmail();
    }

    //パスワードが英数文字だけでできているか
    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new \MyApp\Exception\InvalidPassword();
    }
  }


}
