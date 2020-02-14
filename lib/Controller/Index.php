<?php

namespace MyApp\Controller;


class Index extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }else{
      $email=$_SESSION['me']->email;
      echo $email;
    }

    
    if (isset($_POST['score'])) {
      try {
        $ajaxModel = new \MyApp\Model\ajax();
        $ajaxModel->Updatescore([
          'score' => $_POST['score'],
          'email' => $email,
        ]);
      } catch (\Exception $e) {
        $e->getMessage();
        return;
      }

    }

  }

}
