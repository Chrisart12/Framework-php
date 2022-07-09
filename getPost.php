<?php 
    require_once('database/connection.php');

    // Recherche des elements enregistrés en bases de données
    $error = null;

    if (isset($_GET['id']) && $_GET['id'] != null) {
        
        $id = (int)$_GET['id'];
    
    
        try {
            $resultQuery = "SELECT * FROM posts WHERE id = :id";
    
            // Préparation de la requête
            $pdoStatement = $db->prepare($resultQuery);
        
            $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
    
            $pdoStatement->execute();
    
            $post = $pdoStatement->fetch();
    
        } catch (PDOException $e) {
            $error = $e->getMessage();
        }
    }

  

?>
