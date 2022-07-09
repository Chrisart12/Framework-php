<?php
       require('helpers/helpers.php');
       require_once "database/connection.php";
       require_once "app/Managers/PostManager.php";
       require_once "app/Models/Post.php";
       use App\Managers\PostManager;
    
       $postManager = new PostManager($db);
       $posts = $postManager->readAll();
       $error = $postManager->getError();
       
     
     
       ob_start();
       // require('header.php'); 
       // require_once('getPosts.php');


?>
       <div style="margin-top:30px">
       <?php if ($error) { 
       ?>
              <div class="alert alert-danger" role="alert">
                     <?= $error ?>
              </div>
       <?php  
       }
       ?>

              <?php foreach ($posts as $post) {
              ?>
                     <div class="card">
                            <div class="card-header">
                                   <?= $post->author;?>
                                   <div style="font-size: 0.7em"><?= formateDate($post->created_at);?></div> 
                                   
                            </div>
                            <div  class="card-body">
                                   <h5 class="card-title"><?= $post->title;?></h5>
                                   <!-- cutString($post->description, 0, 100) -->
                                   <p class="card-text"><?= $post->getPart() ;?></p>
                                   <div style="display:flex;">
                                   <a href="http://localhost/MySql/PDO/post?id=<?= $post->id; ?>" class="btn btn-primary" style="margin-right: 10px;">Détail</a>
                                   <a href="http://localhost/MySql/PDO/editPost?id=<?= $post->id; ?>" class="btn btn-success" style="margin-right: 10px;">Editer</a>
                                   <form action="deletePost.php" method="post">
                                          <input type="hidden" class="form-control" name="id" value="<?= htmlentities($post->id ) ?>" >
                                          <a onclick="this.closest('form').submit();return false;" class="btn btn-danger">Effacer</a>
                                   </form>
                                   </div>
                                   
                                   
                            </div>
                     </div>
              <?php
              } 
       ?>
       </div>
       
<?php 
       $content = ob_get_clean();
       require 'app.php';
?>