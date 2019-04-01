<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 07:39
 */

class AddCryptoMachineProcessModel extends ModelAbstract
{
    private $store_new_machine_details_result;
    private $validated_new_machine_details;

    public function __construct()
    {
        parent::__construct();
        $this->store_new_machine_details_result = [];
        $this->validated_new_machine_details = '';
    }

    public function __destruct(){}

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }

    public function setValidatedInput($validated_input)
    {
        $this->validated_new_machine_details = $validated_input;
    }

    public function getStoreNewMachineDetailsResult()
    {
        return $this->store_new_machine_details_result;
    }

    public function storeNewMachineDetails()
    {
        $new_machine_details_stored = false;
        $new_user_machine_count_stored = false;
        $user_id = $_SESSION['user-id'];
        $sql_query_string = SqlQuery::queryFetchUserMachineCount();
        $sql_query_parameters = array(
            ':userid' => $user_id,
        );
        $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $user_count = $this->database_handle->countRows();
        if (!$user_count == 0)
        {
            $user_details = $this->database_handle->safeFetchArray();
            if ( $user_details['user_machine_count'] < 10)
            {
                $sql_query_string = SqlQuery::queryStoreNewMachineDetails();
                $sql_query_parameters = array(
                    ':cryptoname' => $this->validated_new_machine_details['validated-crypto-machine-name'],
                    ':cryptoimagename' => $this->validated_new_machine_details['validated-crypto-image-name'],
                    ':cryptovisible' => $this->validated_new_machine_details['validated-crypto-visible'] + 0,
                    ':cryptouserid' => $user_id + 0,
                );
                $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
                $rows_inserted = $this->database_handle->countRows();

                if ($rows_inserted == 1)
                {
                    $new_machine_details_stored = true;
                    $user_machine_count = $user_details['user_machine_count'] + 1;
                    $sql_query_string = SqlQuery::queryUpdateUserMachineCount();
                    $sql_query_parameters = array(
                        ':usermachinecount' => $user_machine_count,
                        ':userid' => $user_id,
                    );
                    $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
                    $rows_updated = $this->database_handle->countRows();
                    if ($rows_updated == 1)
                    {
                        $new_user_machine_count_stored = true;
                    }
                }
            }
        }
        $this->store_new_machine_details_result = $this->validated_new_machine_details;
        $this->store_new_machine_details_result['store-new-machine-details-result'] = $new_machine_details_stored;
        $this->store_new_machine_details_result['store-new-user-machine-count-result'] = $new_user_machine_count_stored;
    }
}