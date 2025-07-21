<?php
session_start();

mb_language("Japanese");
mb_internal_encoding("UTF-8");

if (isset($_POST['email']) && $_POST['email'] !== '') {

  if (isset($_POST['send'])) {

   
    if (!isset($_POST['agree']) || $_POST['agree'] !== 'yes') {
      die('プライバシーポリシーに同意してください。');
    }

    
    if (isset($_POST['csrf']) && isset($_SESSION['csrf_token']) 
        && $_POST['csrf'] === $_SESSION['csrf_token']) {

      
      $to_user = $_POST['email'];
      $subject_user = '【自動返信】お問い合わせありがとうございます';
      $body_user = "以下の内容でお問い合わせを受け付けました。\n\n"
        . "お名前: " . $_POST['name'] . "\n"
        . "件名: " . $_POST['title'] . "\n"
        . "メッセージ:\n" . $_POST['msg'] . "\n";
      $header_user = "From: 218f0209@s.obirin.ac.jp";

      
      $to_admin = "218f0209@s.obirin.ac.jp";
      $subject_admin = "【通知】お問い合わせがありました";
      $body_admin = "以下の内容でお問い合わせが届きました。\n\n"
        . "お名前: " . $_POST['name'] . "\n"
        . "メールアドレス: " . $_POST['email'] . "\n"
        . "件名: " . $_POST['title'] . "\n"
        . "メッセージ:\n" . $_POST['msg'] . "\n"
        . "同意: " . $_POST['agree'] . "\n";
      $header_admin = "From: 218f0209@s.obirin.ac.jp";

    
      $result_user = mb_send_mail($to_user, $subject_user, $body_user, $header_user);
      $result_admin = mb_send_mail($to_admin, $subject_admin, $body_admin, $header_admin);

      
      if ($result_user && $result_admin) {
        include "thanks.php";
        session_destroy();
      } else {
        echo "メールの送信に失敗しました。";
      }

    }

  } else if (isset($_POST['confirm'])) {
    include "confirm.php";

  } else if (isset($_POST['back'])) {
    include "input.php";
  }

} else {
  include "input.php";
}


function makeConfirm($name) {
  if (isset($_REQUEST[$name])) {
    echo nl2br(htmlspecialchars($_REQUEST[$name]));
    echo '<input type="hidden" name="' . $name . '" value="' . htmlspecialchars($_REQUEST[$name]) . '">';
  }
}

function makeBackform($name) {
  if (isset($_REQUEST[$name])) {
    echo htmlspecialchars($_REQUEST[$name]);
  }
}

function makeCsrf() {
  $toke_byte = openssl_random_pseudo_bytes(16);
  $csrf_token = bin2hex($toke_byte);
  $_SESSION['csrf_token'] = $csrf_token;
  echo $csrf_token;
}
?>
