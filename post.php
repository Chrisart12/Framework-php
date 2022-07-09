<?php 
    require('helpers/helpers.php');
    require_once "database/connection.php";
    require_once "app/Managers/PostManager.php";
    require_once "app/Models/Post.php";

    $postManager = new PostManager($db);

    $post = $postManager->read($_GET['id']);
    $error = $postManager->getError();
    require('header.php'); 
    // require_once('getPost.php');
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
    <div class="card">
        <div class="card-header">
            <?= $post->author;?>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $post->title;?></h5>
            <p class="card-text"><?= $post->description;?></p>
            <a href="/post" class="btn btn-primary">Détail</a>
        </div>

    </div>
<?php require('footer.php'); ?>