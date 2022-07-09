<?php 
    require_once('database/connection.php');
    require('class/Post.php');

    // Recherche des elements enregistrés en bases de données
    $error = null;

    try {
        $resultQuery = "SELECT * FROM posts";

        // Préparation de la requête
        $pdoStatement = $db->prepare($resultQuery);
        $pdoStatement->execute();

        $posts = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'Post');
        // $posts = $pdoStatement->fetchAll();

    } catch (PDOException $e) {
        $error = $e->getMessage();
    }

?>
