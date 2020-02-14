<?php

namespace MyApp;

//データを扱う
class Model {
  protected $db;

  public function __construct() {
    // データベースへの接続
    try {
      $this->db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }
}
