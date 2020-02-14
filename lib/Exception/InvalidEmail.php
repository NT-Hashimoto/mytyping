<?php
//無効なメールを受け取った時の例外クラス

namespace MyApp\Exception;

//例外クラスExceptionの拡張として作る
//getMassageとか使える
class InvalidEmail extends \Exception {
  protected $message = 'Invalid Email!';
}
