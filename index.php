<?php
// load vendor
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// Create the application
$app = new Silex\Application();

/* Connection */
// Credentials
$dsn = 'mysql:dbname=social_app;host=127.0.0.1;charset=utf8';
$user = 'root';
$pass = '';
// Connect to MySql
try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

/* Routes */
/**
 * GET Feed
 * @param integer, user $id
 * @return Posts list
 */
$app->get('/feed/{id}', function ($id) use ($app, $dbh) {

    // Create a Query
    $query  = " SELECT us_name, up_post, up_send_date ";
    $query .= " FROM tb_user_post up ";
    $query .= " INNER JOIN tb_user us ON us.us_id = up.up_id_user ";
    $query .= " LEFT JOIN tb_user_friend uf ON uf.uf_id_friend = up.up_id_user ";
    $query .= " WHERE uf.uf_id_user = ".$id;
    // Apply Query
    $sth = $dbh->prepare($query);
    $sth->execute([ $id ]);
    $posts = $sth->fetchAll(PDO::FETCH_ASSOC);

    // Validate
    if(empty($posts)) {
        // Invalid Id
        return new Response("Usuario invalido!", 404);
    }
    return $app->json($posts);

})->assert('id', '\d+');

/**
 * GET Friend
 * @param integer, user $id
 * @return Friends list
 */
$app->get('/friends/{id}', function ($id) use ($app, $dbh) {

    // Create a Query
    $query  = " SELECT us_username, us_name ";
    $query .= " FROM tb_user_friend uf ";
    $query .= " INNER JOIN tb_user us ON us.us_id = uf.uf_id_friend ";
    $query .= " WHERE uf.uf_id_user = ".$id;
    // Apply Query
    $sth = $dbh->prepare($query);
    $sth->execute([ $id ]);
    $posts = $sth->fetchAll(PDO::FETCH_ASSOC);

    // Validate
    if(empty($posts)) {
        // Invalid Id
        return new Response("Usuario invalido!", 404);
    }
    return $app->json($posts);

})->assert('id', '\d+');

/**
 * POST Status
 * @param integer, user $id
 * @return Friends list
 */
$app->post('/post', function(Request $request) use ($app, $dbh) {

    // decode json param
    $values = json_decode($request->getContent(), true);
    // Create a Query
    $query  = " INSERT INTO tb_user_post (up_id_user, up_post) ";
    $query .= " VALUES(:id_user, :post) ";
    // Apply Query
    $sth = $dbh->prepare($query);
    $sth->execute($values);

    // response, 201 created
    $response = new Response('Ok', 201);
    return $response;
});

$app->run();
