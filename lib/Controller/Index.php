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
      // echo $email;
    }

    // //score送信
    // if (isset($_POST['score'])) {
    //   try {
    //     $ajaxModel = new \MyApp\Model\ajax();
    //     $ajaxModel->Updatescore([
    //       'score' => $_POST['score'],
    //       'email' => $email,
    //     ]);
    //   } catch (\Exception $e) {
    //     $e->getMessage();
    //     return;
    //   }
    // }//end if(isset($_POST['score']))
    // if(isset($_POST['isplaying'])){
    //   echo $_POST['isplaying'];
    //   try {
    //     $ajaxModel2 = new \MyApp\Model\ajax();
    //     $ajaxModel2->Getquizzes();
    //     echo "foo";
    //   } catch (\Exception $e) {
    //     $e->getMessage();
    //     return;
    //   }
    // }

  }//end function run()

}//end class
