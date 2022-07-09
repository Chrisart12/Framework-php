<?php 
    require_once 'helpers/helpers.php';
    require_once "database/connection.php";
    require_once "app/Managers/PostManager.php";
    require_once "app/Models/Post.php";

    use App\Managers\PostManager;
    use App\Models\Post;

        if (isset($_POST['author']) && isset($_POST['title']) && isset($_POST['description'])) {

            if ($_POST['author'] && $_POST['title'] && $_POST['description']) {

                // Création d'un nouveau post
                $post = new Post();

                $post->setAuthor($_POST['author'])
                    ->setTitle($_POST['title'])
                    ->setDescription($_POST['description'])
                    ->setCreated_at(date("Y-m-d H:i:s"));

                // Insertion en base de données via un manager
                $postManager = new PostManager($db);
            
                $result = $postManager->save($post);
       
                if ( $result) {
                    header('Location: '.'listPosts.php');
                } else {
                    $message = "Il y a eu un problème lors de l'enregistrement";
                }

            } else {
                header('Location: '.'errorPost.php');
            }
        
        } else {
            header('Location: '.'errorPost.php');
        }

        
?>

