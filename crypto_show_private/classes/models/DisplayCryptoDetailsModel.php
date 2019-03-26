<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 26/03/19
 * Time: 06:29
 */

class DisplayCryptoDetailsModel
{
    private $database_handle;
    private $database_connection_messages;
    private $crypto_details;
    private $sanitised_crypto_machine;

    public function __construct()
    {
        $this->database_handle = null;
        $this->database_connection_messages = [];
        $this->crypto_details = [];
        $this->sanitised_crypto_machine = '';
    }

    public function __destruct(){}

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }

    public function getCryptoDetails()
    {
        return $this->crypto_details;
    }

    public function getDatabaseConnectionResult()
    {
        $this->database_connection_messages = $this->database_handle->getConnectionMessages();
    }

    public function setCryptoMachine(string $crypto_machine)
    {
        $this->sanitised_crypto_machine = $crypto_machine;
    }

    public function retrieveCryptoDetails()
    {
        $sanitised_crypto_machine = $this->sanitised_crypto_machine;
        $sql_query_string = SqlQuery::queryGetCryptoMachineDetails();
        $sql_query_parameters = array(':Cryptoname' => $sanitised_crypto_machine);
        $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $crypto_count = $this->database_handle->countRows();
        if ($crypto_count == 0)
        {
            $sanitised_crypto_machine = false;
        }
        else
        {
            $crypto_details = $this->database_handle->safeFetchArray();
            $this->crypto_details['sanitised-crypto-machine'] = $sanitised_crypto_machine;
            $this->crypto_details['crypto-details'] = $crypto_details;
        }
    }
}