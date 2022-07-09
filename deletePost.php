<?php 
    require_once 'helpers/helpers.php';
    require_once "database/connection.php";
    require_once "app/Managers/PostManager.php";
    require_once "app/Models/Post.php";

    use App\Managers\PostManager;
    use App\Models\Post;

if (isset($_POST['id'])   && $_POST['id']) {

    $success = null;
        
    try {
        $postManager = new PostManager($db);
        // Je recherche le post à effacer
        $post = $postManager->read((int)htmlentities( $_POST['id']));
       
        // Je passe le post à effacer au manager
        $result = $postManager->delete($post);

        
        
      

        if ( $result) {
            $success = 'Votre article a été bien éffacé.';
            header('Location: '.'listPosts.php');
        } else {
            $message = "Il y a eu un problème lors de l'enregistrement";
        }

    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
        

} else {

    header('Location: '.'errorPost.php');
}

?>

