<?php

/**
 * Commencez par importer le fichier sql live.sql via PHPMyAdmin.
 * 1. Sélectionnez tous les utilisateurs.
 * 2. Sélectionnez tous les articles.
 * 3. Sélectionnez tous les utilisateurs qui parlent de poterie dans un article.
 * 4. Sélectionnez tous les utilisateurs ayant au moins écrit deux articles.
 * 5. Sélectionnez l'utilisateur Jane uniquement s'il elle a écris un article ( le résultat devrait être vide ! ).
 *
 * ( PS: Sélectionnez, mais affichez le résultat à chaque fois ! ).
 */

$server = 'localhost';
$database = 'exo206';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $search = $conn->prepare("SELECT username FROM user");
    $search->execute();

    echo "<pre>";
    print_r($search->fetchAll());
    echo "</pre>";

    $search = $conn->prepare("SELECT titre FROM article");
    $search->execute();

    echo "<pre>";
    print_r($search->fetchAll());
    echo "</pre>";

    $search = $conn->prepare("SELECT * FROM article WHERE titre LIKE ('%poterie%')");
    $search->execute();

    echo "<pre>";
    print_r($search->fetchAll());
    echo "</pre>";


} catch (PDOException $exception) {
    echo "data base connexion error : " . $exception->getMessage();
    return null;
}

