<?php

  use Trnx\Blog\model\Post;
  $posts = Post::getPosts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="src/resources/main.css">
</head>
<body>
  <?php require_once 'src/resources/nav.php'; ?>
  <div class="post-container">
    <h1>Bienvenido a mi blog</h1>
    <?php

      foreach ($posts as $post) {
        echo "<div><a href='{$post->getUrl()}'>{$post->getPostName()}</a></div>";
      }
    
    ?>
  </div>
</body>
</html>