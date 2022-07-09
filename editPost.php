<?php

    require_once 'helpers/helpers.php';
    require_once "database/connection.php";
    require_once "app/Managers/PostManager.php";
    require_once "app/Models/Post.php";

    use App\Managers\PostManager;
    use App\Models\Post;

    $postManager = new PostManager($db);

    $post = $postManager->read($_GET['id']);
    
    $error = $postManager->getError();
    require('header.php');  
    // require('header.php');
    // require('getPost.php');

?>

        <form action="updatePost.php" method="post" >
            <input type="hidden" class="form-control" name="id" value="<?= htmlentities($post->id ) ?>" >
            <div class="mb-3">
                <label for="author" class="form-label">Auteur</label>
                <input type="text" class="form-control" id="author" name="author" value="<?= htmlentities($post->author ) ?>" >
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlentities($post->title) ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea  id="description" name="description" class="form-control"  required="required"><?= htmlentities($post->description); ?> </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

<?php require('footer.php'); ?>