<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MAIL FORM</title>
</head>
<body>
  <form method="POST" action="index.php">
    名前: 
    <?php makeConfirm('name') ?>
    <br>
    e-mail:
    <?php makeConfirm('email') ?>
    <br>
    件名:
    <?php makeConfirm('title') ?>
    <br>
    <?php makeConfirm('msg') ?>
    <br>
    <input type="submit" name="back" value="もどる">
    <input type="submit" name="send" value="送信">
    <input type="hidden" name="csrf" value="<?php makeCsrf(); ?>">

  </form>
</body>
</html>
