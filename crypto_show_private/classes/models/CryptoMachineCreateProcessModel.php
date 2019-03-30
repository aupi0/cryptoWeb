<?php
/** CryptoMachineCreateProcessModel.php
 *
 * @author - Sam, Matt, Chris and Roan
 */

class CryptoMachineCreateProcessModel extends ModelAbstract
{

    private $store_new_crypto_machine_details_result;
private $validated_new_crypto_machine_details;


    public function __construct()
    {
        parent::__construct();
        $this->store_new_crypto_machine_details_result = [];
        $this->validated_new_crypto_machine_details = '';
    }

    public function __destruct(){}

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }

    public function setValidatedInput($validated_input)
    {
        $this->validated_new_crypto_machine_details = $validated_input;
    }

    public function getStoreNewCryptoMachineDetailsResult()
    {
        return  $this->store_new_crypto_machine_details_result;
    }

    public function storeNewCryptoMachineDetails()
    {
        $new_crypto_machine_details_stored = false;
        //Obtains the id of the user currently logged in
        $user_id = $_SESSION['user-id'];
        $crypto_image_name = $_POST['crypto_machine_image_name'];
        $crypto_visible = $_POST['crypto_machine_record_visible'];

        //Creates a new crypto record using the SQL query
        $sql_query_string = SqlQuery::queryNewCryptoMachineDetails();
        $sql_query_parameters = array(
            ':userid' => $user_id,
            ':cryptoname' => $this->validated_new_crypto_machine_details['validated-crypto-machine-name'],
            ':cryptomodel' => $this->validated_new_crypto_machine_details['validated-crypto-machine-model'],
            ':cryptocountry' => $this->validated_new_crypto_machine_details['validated-crypto-machine-country-of-origin'],
            ':cryptodesc' => $this->validated_new_crypto_machine_details['validated-crypto-machine-description'],
            ':cryptoimageName' => $crypto_image_name,
            ':cryptovisible' => $crypto_visible,
        );

        $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);

        $rows_inserted = $this->database_handle->countRows();

        if ($rows_inserted == 1)
        {
            $new_crypto_machine_details_stored = true;
        }
        $this->store_new_crypto_machine_details_result = $this->validated_new_crypto_machine_details;
        $this->store_new_crypto_machine_details_result['store-new-crypto-machine-details-result'] = $new_crypto_machine_details_stored;
    }
}