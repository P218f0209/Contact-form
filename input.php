<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MAIL FORM</title>
  <link rel="stylesheet" href="contact.css">
</head>
<body>
  <form method="POST" action="index.php">
    名前:<input type="text" name="name" required value="<?php makeBackform('name'); ?>"><br>
    e-mail:<input type="email" name="email" required value="<?php makeBackform('email'); ?>"><br>
    件名:<input type="text" name="title" required value="<?php makeBackform('title'); ?>"><br>
    <textarea name="msg" required><?php makeBackform('msg'); ?></textarea><br>
    <label>
      <input type="checkbox" name="agree" value="yes" required>
      プライバシーポリシーに同意します
    </label><br>
    
    
    <input type="submit" name="confirm" value="確認画面へ">

  </form>
</body>
</html>

