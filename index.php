<?php
// load vendor
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/functions.php';
require_once __DIR__ . '/src/connect.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
global $dbh;

// Create the application
$app = new Silex\Application();

//------------------------------------------------------------------------------
// Routes
//------------------------------------------------------------------------------
/**
 * GET Feed
 * @param integer, user $id
 * @return Posts list
 */
$app->get('/feed/{id}', function ($id) use ($app, $dbh) {

    // Create a Query
    $query  = " SELECT us_name AS name, up_post AS status, up_send_date AS send_date ";
    $query .= " FROM tb_user_post up ";
    $query .= " INNER JOIN tb_user us ON us.us_id = up.up_id_user ";
    $query .= " LEFT JOIN tb_user_friend uf ON uf.uf_id_friend = up.up_id_user ";
    $query .= " WHERE uf.uf_id_user = ".$id;
    // Apply Query
    $sth = $dbh->prepare($query);
    $sth->execute([ $id ]);
    $posts = $sth->fetchAll(PDO::FETCH_ASSOC);

    // Validate
    if( empty($posts) ) {
        // Invalid Id
        return new Response("Invalid User!", 404);
    }
    // Return Serialized Posts
    return $app->json($posts);

})->assert('id', '\d+');

/**
 * GET Friend
 * @param integer, user $id
 * @return Friends list
 */
$app->get('/friends/{id}', function ($id) use ($app, $dbh) {

    // Create a Query
    $query  = " SELECT us_username AS username, us_name AS name";
    $query .= " FROM tb_user_friend uf ";
    $query .= " INNER JOIN tb_user us ON us.us_id = uf.uf_id_friend ";
    $query .= " WHERE uf.uf_id_user = ".$id;
    // Apply Query
    $sth = $dbh->prepare($query);
    $sth->execute([ $id ]);
    $posts = $sth->fetchAll(PDO::FETCH_ASSOC);

    // Validate
    if( empty($posts) ) {
        // Invalid Id
        return new Response("Invalid User!", 404);
    }
    // Return Serialized Friends
    return $app->json($posts);

})->assert('id', '\d+');

/**
 * POST Status
 * @param Request (user id, post status)
 * @return Friends list
 */
$app->post('/post', function(Request $request) use ($app, $dbh) {

    // decode json param
    $values = json_decode($request->getContent(), true);
    $error = validate_post($values);

    if ( $error == '' ){

      // Create a Query
      $query  = " INSERT INTO tb_user_post (up_id_user, up_post, up_send_date) ";
      $query .= " VALUES(:user, :post, NOW()) ";

      // Apply Query
      try {
        $sth = $dbh->prepare($query);
        $sth->execute($values);
  		} catch (ServiceException $e) {

        // Catch an Error
  			$code = $e->getCode();
  			$error_message = $e->getMessage();
  			$error = 'POST_STATUS. Error: '.$code.": ".$error_message;
  		}
    }

    // Return Conditions
    if( $error == '' ) {
      // response, 201 OK
      $response = new Response('Ok', 201);
    } else {
      // Imput Error
      $response = new Response("Error: ".$error, 500);
    }
    // Return Response Code: 201,500
    return $response;
});

$app->run();
