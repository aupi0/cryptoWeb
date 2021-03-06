<?php
 /**
  * SqlQuery.php
  *
  * @author CF Ingrams - cfi@dmu.ac.uk
  * @copyright De Montfort University
  *
  * @package crypto-show
  */

 class SqlQuery
 {

  public function __construct(){}

  public function __destruct(){}

  //updated statement to be correct and added user id and visible for UC15
  public static function queryGetCryptoMachineNames()
  {
   $sql_query_string  = 'SELECT crypto_machine_name, fk_user_id, crypto_machine_record_visible';
   $sql_query_string .= ' FROM crypto_machine';
   return $sql_query_string;
  }

  public static function queryGetRegisteredUserNames()
  {
   $sql_query_string  = 'SELECT user_name';
   $sql_query_string .= ' FROM registered_user';
   return $sql_query_string;
  }

  public static function queryStoreNewUserDetails()
  {
   $sql_query_string  = 'INSERT INTO registered_user';
   $sql_query_string .= ' SET';
   $sql_query_string .= ' user_nickname = :usernickname,';
   $sql_query_string .= ' user_name = :username,';
   $sql_query_string .= ' user_email = :useremail,';
   $sql_query_string .= ' user_hashed_password = :userhashedpassword,';
   $sql_query_string .= ' user_machine_count = :usermachinecount,';
   $sql_query_string .= ' user_registered_timestamp = :userregisteredtimestamp';
   return $sql_query_string;
  }

  public static function queryAuthenticateUser()
  {
   $sql_query_string  = 'SELECT user_hashed_password';
   $sql_query_string .= ' FROM registered_user';
   $sql_query_string .= ' WHERE user_nickname = :usernickname';
   $sql_query_string .= ' LIMIT 1';
   return $sql_query_string;
  }

  public static function queryFetchUserId()
  {
   $sql_query_string  = 'SELECT user_id';
   $sql_query_string .= ' FROM registered_user';
   $sql_query_string .= ' WHERE user_nickname = :usernickname';
   $sql_query_string .= ' LIMIT 1';
   return $sql_query_string;
  }

  public static function queryFetchUserDetails()
  {
   $sql_query_string  = 'SELECT user_id, user_name, user_email, user_machine_count, user_registered_timestamp';
   $sql_query_string .= ' FROM registered_user';
   $sql_query_string .= ' WHERE user_nickname = :usernickname';
   $sql_query_string .= ' LIMIT 1';
   return $sql_query_string;
  }

  //Fixed Statement
  public static function queryGetCryptoMachineDetails()
  {
   $sql_query_string  = 'SELECT crypto_machine.crypto_machine_id, crypto_machine_name, fk_user_id, crypto_machine_image_name, crypto_machine_record_visible';
   $sql_query_string .= ' FROM crypto_machine';
   $sql_query_string .= ' WHERE crypto_machine_name = :Cryptoname';
   $sql_query_string .= ' LIMIT 1';
   return $sql_query_string;
      //insert into crypto_machine set crypto_machine_id = 1, fk_user_id = 2, crypto_machine_name = 'mad machine', crypto_machine_image_name = 'image.jpg', crypto_machine_record_visible = 1;
  }

  //Added update query for UC13
  public static function queryUpdateCryptoMachineDetails()
  {
   $sql_query_string  = 'UPDATE crypto_machine';
   $sql_query_string .= ' SET';
   $sql_query_string .= ' crypto_machine_name = :cryptoname';
   $sql_query_string .= ' crypto_machine_image_name = :cryptoimageName';
   $sql_query_string .= ' crypto_machine_record_visible = :cryptovisible';
   $sql_query_string .= ' WHERE crypto_machine_id = :cryptomachineid';
   return $sql_query_string;
  }

  //Added delete query fro UC13
  public static function queryDeleteCryptoMachineDetails()
  {
   $sql_query_string  = 'DELETE FROM crypto_machine';
   $sql_query_string .= ' WHERE crypto_machine_id = :cryptomachineid';
   return $sql_query_string;
  }


  public static function queryLogErrorMessage()
  {
   $sql_query_string  = 'INSERT INTO cryptoshow_error_log';
   $sql_query_string .= ' SET log_message = :logmessage';
   return $sql_query_string;
  }
 }

