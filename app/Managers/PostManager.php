<?php 

namespace App\Managers;

require_once 'helpers/helpers.php';
require_once "app/Models/Post.php";
use App\Models\Post;

use PDO;
// require_once "app/Models/Post.php";

class PostManager 
{
    private $pdo;
    private $pdoStatement;
    private $error;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get the value of id
     */ 
    private function create(Post $post)
    {

        $postQuery = "INSERT INTO posts (author, title, description, created_at) VALUE(:author, :title, :description, :created_at)";

        // Préparation de la requête
        $pdoStatement = $this->pdo->prepare($postQuery);
        
        $pdoStatement->bindValue(':author', $post->author, PDO::PARAM_STR);
        $pdoStatement->bindValue(':title', $post->title, PDO::PARAM_STR);
        $pdoStatement->bindValue(':description', $post->description, PDO::PARAM_STR);
        $pdoStatement->bindValue(':created_at', $post->created_at);
 
        $result = $pdoStatement->execute();

        return $result;

    }

    /**
     * Get the value of lastname
     */ 
    public function read(int $id)
    {
        if ($id) {
            
            try {
                $resultQuery = "SELECT * FROM posts WHERE id = :id";
        
                // Préparation de la requête
                $pdoStatement = $this->pdo->prepare($resultQuery);
            
                $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

                $pdoStatement->setFetchMode(PDO::FETCH_CLASS, "App\Models\Post"); 

                $pdoStatement->execute();
        
                // $post = $pdoStatement->fetch(PDO::FETCH_CLASS, "App\Models\Post");
                $post = $pdoStatement->fetch();

                return $post;
        
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
            }
        }
    }

    /**
     * Get the value of lastname
     */ 
    public function readAll()
    {
        try {
            $resultQuery = "SELECT * FROM posts";
    
            // Préparation de la requête
            $pdoStatement = $this->pdo->prepare($resultQuery);

            // J'assigne un fetch mode classe pour avoir les objets de type poste au lieur d'un stdclass
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, "App\Models\Post"); 
            $pdoStatement->execute();
    
            $posts = $pdoStatement->fetchAll();

            return $posts;
    
        } catch (PDOException $e) {
            
            $this->error = $e->getMessage();
        }
    }

    /**
     * Set the value of lastname
     * @return  self
     */ 
    public function save(Post $post)
    {
        // On vérifie si l'objet à un id
        // Si l'objet à un id, c'est un ancien objet, on appelle la méthode create
        // Sinon on appelle la method update
        if ($post->getId()) {

            return $this->update($post);
        } else {
           
            return $this->create($post);
        }
    }

    /**
     * Set the value of lastname
     * @return  self
     */ 
    private function update(Post $post)
    {


        $postQuery = "UPDATE posts SET author= :author, title= :title, description= :description, created_at= :created_at WHERE id= :id LIMIT 1";

        // Préparation de la requête
        $pdoStatement = $this->pdo->prepare($postQuery);

        $pdoStatement->bindParam(':id',$post->getId(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':author', $post->getAuthor(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':title', $post->getTitle(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':description', $post->getDescription(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':created_at', $post->getCreated_at());

        $result = $pdoStatement->execute();
    

        return $result;

    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function delete(Post $post)
    {
        $postQuery = "DELETE FROM posts WHERE id= :id LIMIT 1";

        // Préparation de la requête
        $pdoStatement = $this->pdo->prepare($postQuery);

        $pdoStatement->bindValue(':id', $post->getId(), PDO::PARAM_INT);
        
        $result = $pdoStatement->execute();

        return $result;
    }


    /**
     * Get the value of error
     */ 
    public function getError()
    {
        return $this->error;
    }
}