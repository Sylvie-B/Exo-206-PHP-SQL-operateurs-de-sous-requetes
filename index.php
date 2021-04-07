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

//1
    $search = $conn->prepare("SELECT username FROM user");
    $search->execute();

    echo "1<pre>";
    print_r($search->fetchAll());
    echo "</pre>";

//2
    $search = $conn->prepare("SELECT titre FROM article");
    $search->execute();

    echo "2<pre>";
    print_r($search->fetchAll());
    echo "</pre>";

//3
    $search = $conn->prepare("
        SELECT username FROM user
            WHERE id = ANY (SELECT user_fk FROM article WHERE titre LIKE '%poterie%')
    ");
    $search->execute();

    echo "3<pre>";
    print_r($search->fetchAll());
    echo "</pre>";

//4
//    $search = $conn->prepare("
//        SELECT username FROM user
//        INNER JOIN article ON
//    ");
//    $search->execute();
//
//    echo "4<pre>";
//    print_r($search->fetchAll());
//    echo "</pre>";

//5
    $search = $conn->prepare("
        SELECT username FROM user
        INNER JOIN article ON article.user_fk = user.id
        WHERE username LIKE ('jane%')
    ");
    $search->execute();

    echo "5<pre>";
    print_r($search->fetchAll());
    echo "</pre>";


} catch (PDOException $exception) {
    echo "data base connexion error : " . $exception->getMessage();
    return null;
}

