<?php

namespace MyApp;

class Controller {
  private $_errors;
  private $_values;

  public function __construct() {
    //errorオブジェクトの作成
    //stdClassはプロパティーやメソッドが定義されていない空のクラス
    //setErrorsなどで定義していく
    $this->_errors = new \stdClass();
    $this->_values = new \stdClass();
  }

  protected function setValues($key, $value) {
   $this->_values->$key = $value;
 }

 public function getValues() {
   return $this->_values;
 }

  //_errorsオブジェクトにエラーをプロパティとしてセットする
  //フォーム送信→フォーム検証→エラー
  protected function setErrors($key, $error) {
    //'email'プロパティにgetMassage()が入るなど
    $this->_errors->$key = $error;
  }

  //_errorsオブジェクトにセットされたエラーを返す
  //viewに返すことでエラーを表示できる
  public function getErrors($key) {
    //issetはNULLか定義していない変数のときfalse
    //trueの場合は$keyを、falseの場合は''を返す
    //$keyはemailやpasswordで、seterrorsによりgetMassage()が入る
    return isset($this->_errors->$key) ?  $this->_errors->$key : '';
  }

  //errorオブジェクトが空かどうか、つまりエラーがあるかどうか
  protected function hasError(){
    //emptyは1やarray(1)のときfalse
    //get-object-varsはそのスコープ内でアクセス可能なオブジェクトのプロパティを配列で取得する
    return !empty(get_object_vars($this->_errors));
  }

  protected function isLoggedIn() {
    // $_SESSION['me']
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }

  

}
