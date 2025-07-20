<?php
session_start();

if( isset($_POST['email']) && $_POST['email'] !== '' ){

  if( isset($_POST['send'])){

    if( isset($_POST['csrf']) && isset($_SESSION['csrf_token']) 
    && $_POST['csrf'] === $_SESSION['csrf_token'] ){

      $to = $_POST['email'];
      $subject = $_POST['title'];
      $header="From: yamamoto_t@class.tama.net";
      $body = "お問合せ\n"
        .$_POST['name'] . "\n"
        .$_POST['msg'] . "\n"
        ;

      mb_send_mail($to,$subject,$body,$header);

      include "thanks.php";
      session_destroy();
    }
  } else if( isset($_POST['confirm'])){
    include "confirm.php";
  } else if( isset($_POST['back'])){
    include "input.php";
  }
} else {
  include "input.php";
}

function makeConfirm ($name) {
  if( isset($_REQUEST[$name]) ){
    echo nl2br(htmlspecialchars($_REQUEST[$name]));
    echo '<input type="hidden" name="' . $name . '" value="' . htmlspecialchars($_REQUEST[$name]). '">';
  }
}

function makeBackform ($name) {
  if( isset($_REQUEST[$name]) ){
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
 
