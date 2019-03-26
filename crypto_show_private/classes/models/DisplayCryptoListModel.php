<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 26/03/19
 * Time: 06:34
 */

class DisplayCryptoListModel
{
    private $crypto_machines;
    private $database_handle;

    public function __construct()
    {
        $this->crypto_machines = [];
        $this->database_handle = null;
    }

    public function __destruct(){}

    public function setDatabaseHandle($obj_database_handle)
    {
        $this->database_handle = $obj_database_handle;
    }

    public function getCryptoMachines()
    {
        return $this->crypto_machines;
    }

    public function createCryptoList()
    {
        $crypto_machines_list = array();
        $sql_query_string = SqlQuery::queryGetCryptoMachineNames();
        $sql_query_parameters = array();
        $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);
        $number_of_machines = $this->database_handle->countRows();

        if ($number_of_machines > 0)
        {
            while ($row = $this->database_handle->safeFetchArray())
            {
                $crypto_machine_name = $row['crypto_machine_name'];
                $crypto_machines_list[$crypto_machine_name] = $crypto_machine_name;
            }
        }
        $this->crypto_machines = $crypto_machines_list;
    }
}