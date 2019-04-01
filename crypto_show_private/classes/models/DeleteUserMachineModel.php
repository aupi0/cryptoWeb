<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 11:05
 */

class DeleteUserMachineModel extends ModelAbstract
{
    private $delete_machine_details_result;
    private $validated_machine_details;

    public function __construct()
    {
        parent::__construct();
        $this->delete_machine_details_result = [];
        $this->validated_machine_details = '';
    }

    public function __destruct(){}

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }

    public function setValidatedInput($validated_input)
    {
        $this->validated_machine_details = $validated_input;
    }

    public function getDeleteMachineDetailsResult()
    {
        return $this->delete_machine_details_result;
    }

    public function deleteMachineDetails()
    {
        //might want to make sure only machines with user id of current user can be deleted
        $delete_machine_details = false;
        $sql_query_string = SqlQuery::queryDeleteCryptoMachineDetails();
        $sql_query_parameters = array(
            ':cryptomachineid' => $this->validated_machine_details['crypto_machine_id'],
        );
        $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $rows_updated = $this->database_handle->countRows();

        if ($rows_updated == 1)
        {
            $delete_machine_details = true;
        }
        $this->delete_machine_details_result = $this->validated_machine_details;
        $this->delete_machine_details_result['delete-machine-details-result'] = $delete_machine_details;
    }
}