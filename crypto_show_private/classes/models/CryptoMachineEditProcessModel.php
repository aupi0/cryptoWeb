<?php
/** CryptoMachineEditProcessModel.php
 *
 * @author - Sam, Matt, Chris and Roan
 */


class CryptoMachineEditProcessModel extends ModelAbstract
{
    private $edit_crypto_machine_details_result;
    private $validated_edit_crypto_machine_details;

    public function __construct()
    {
        parent::__construct();
        $this->edit_crypto_machine_details_result = [];
        $this->validated_edit_crypto_machine_details = '';
    }

    public function __destruct(){}

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }

    public function setValidatedInput($validated_input)
    {
        $this->validated_edit_crypto_machine_details = $validated_input;
    }

    public function getEditCryptoMachineDetailsResult()
    {
        return $this->edit_crypto_machine_details_result;
    }

    public function editCryptoMachineDetails()
    {
        // Obtains the name of image and visibility from form
        $edit_crypto_machine_details_stored = false;
        $crypto_image_name = $_POST['crypto_machine_image_name'];
        $crypto_visible = $_POST['crypto_machine_record_visible'];

        //Uses SQL query to fetch the machine_id of current crypto machine and storing result from the id column into a variable
        $sql_query_string = SqlQuery::queryFetchMachineId();
        $sql_query_parameters = [
            ':cryptoname' => $this->validated_edit_crypto_machine_details['validated-crypto-machine-name'],
        ];
        $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);

        $machine_recordset = $this->database_handle->safeFetchRow();
        $machineid = $machine_recordset[0];

//Uses SQL query to update the records, the result of query is saved onto the database
        $sql_query_string = SqlQuery::queryUpdateCryptoMachineDetails();
        $sql_query_parameters = array(
            ':cryptomachineid' => $machineid,
            ':cryptoname' => $this->validated_edit_crypto_machine_details['validated-crypto-machine-name'],
            ':cryptomodel' => $this->validated_edit_crypto_machine_details['validated-crypto-machine-model'],
            ':cryptocountry' => $this->validated_edit_crypto_machine_details['validated-crypto-machine-country-of-origin'],
            ':cryptodesc' => $this->validated_edit_crypto_machine_details['validated-crypto-machine-description'],
            ':cryptoimageName' => $crypto_image_name,
            ':cryptovisible' => $crypto_visible,

        );

        $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);

        $rows_inserted = $this->database_handle->countRows();

        if ($rows_inserted == 1)
        {
            $edit_crypto_machine_details_stored = true;
        }
        $this->edit_crypto_machine_details_result = $this->validated_edit_crypto_machine_details;
        $this->edit_crypto_machine_details_result['edit-crypto-machine-details-result'] = $edit_crypto_machine_details_stored;
    }
}