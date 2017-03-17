<?php
//------------------------------------------------------------------------------
// Aux Functions
//------------------------------------------------------------------------------

/**
 *	@Title: Exist User Func;
 *  @Description: Verify that the user exists;
 *	@Author: Gustavo Zanoni;
 *	@param: User Id;
 *  @return: Bool;
 */
function exist_user($id = 0) {

  global $dbh;

  // Create a Query
  $query  = " SELECT *";
  $query .= " FROM tb_user ";
  $query .= " WHERE us_id = ".$id;
  // Apply Query
  $sth = $dbh->prepare($query);
  $sth->execute([ $id ]);
  $user = $sth->fetchAll(PDO::FETCH_ASSOC);

  if( !empty($user) )
    return true;
  else
    return false;
}

/**
 *	@Title: Validate Post Func;
 *  @Description: Checks whether the reported parameters are correct;
 *	@Author: Gustavo Zanoni;
 *	@param: Json Param Values;
 *  @return: error;
 */
function validate_post($values = []) {

  $error = '';

  if( empty($values) )
    $error = 'Parameter error';
  else if( empty($values['user']) )
    $error = 'Parameter error: user';
  else if( !is_numeric($values['user']) )
    $error = 'Parameter type error: user';
  else if( !exist_user($values['user']) )
    $error = 'Invalid User';
  else if( empty($values['post']) )
    $error = 'Parameter error: post';

  return $error;
}

?>
