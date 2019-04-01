<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 10:10
 */

class EditCryptoMachineProcessModel extends ModelAbstract
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
        $sql_query_string = SqlQuery::queryUpdateCryptoMachineDetails();
        $sql_query_parameters = array(
            ':cryptoname' => $this->validated_new_machine_details['validated-crypto-machine-name'],
            ':cryptoimagename' => $this->validated_new_machine_details['validated-crypto-image-name'],
            ':cryptovisible' => $this->validated_new_machine_details['validated-crypto-visible'] + 0,
            ':cryptomachineid' => $this->validated_new_machine_details['crypto_machine_id'] + 0,
        );
        $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $rows_updated = $this->database_handle->countRows();

        if ($rows_updated == 1)
        {
            $new_machine_details_stored = true;
        }
        $this->store_new_machine_details_result = $this->validated_new_machine_details;
        $this->store_new_machine_details_result['store-new-machine-details-result'] = $new_machine_details_stored;
    }
}