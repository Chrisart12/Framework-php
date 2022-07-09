<?php 
    require_once 'helpers/helpers.php';
    require_once "database/connection.php";
    require_once "app/Managers/PostManager.php";
    require_once "app/Models/Post.php";

    use App\Managers\PostManager;
    use App\Models\Post;

    
if (isset($_POST['id'] ) && isset($_POST['author']) && isset($_POST['title']) && isset($_POST['description'])) {

    $success = null;
   
    if ($_POST['author'] && $_POST['title'] && $_POST['description']) {
        
        try {

            // On recherche le post concerné
            $postManager = new PostManager($db);

            // On recherche le post concerné
            $post = $postManager->read((int)htmlentities( $_POST['id']));

            // On affecte les nouvelles valeurs
            $post->setAuthor($_POST['author'])
                ->setTitle($_POST['title'])
                ->setDescription($_POST['description'])
                ->setCreated_at(date("Y-m-d H:i:s"));

            // On envoie les nouvelles valeur
            $result = $postManager->save($post);
    
            if ( $result) {
                $success = 'Votre article a été bien modifié';
                header('Location: '.'listPosts.php');
            } else {
                $message = "Il y a eu un problème lors de l'enregistrement";
            }

        } catch (PDOException $e) {
            $error = $e->getMessage();
        }
        
       

    } else {
        // header('Location: '.'errorPost.php');
    }

} else {

    header('Location: '.'errorPost.php');
}

?>

