<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 25/03/2019
 * Time: 22:47
 */

class UserSearchModel extends ModelAbstract {

    private $validated_query_result;
    private $validated_user_array;

    public function __construct(){
        parent::__construct();
    }

    public function __destruct(){}

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }

    public function setValidatedInput($sanitised_input)
    {
        $this->validated_user_array = $sanitised_input;
    }

    public function getAllUsersFromDatabase(){
        $details_returned = false;

        $sql_query_string = SqlQuery::queryGetAllUserDetails();

        $query_result = $this->database_handle->safeQuery($sql_query_string);
        $query_result = $this->database_handle->safeFetchAllResults();

        if($query_result != null){
            $this->validated_user_array = $query_result;
            $details_returned = true;
        }
        else {
            return 'There has been a database error';
        }

        $this->validated_query_result = $details_returned;

        return $this->validated_user_array;
    }

    public function returnAllUsersResult(){
        return $this->validated_query_result;
    }



}