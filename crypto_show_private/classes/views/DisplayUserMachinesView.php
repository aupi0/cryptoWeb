<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 09:33
 */

class DisplayUserMachinesView extends WebPageTemplateView
{
    private $crypto_machine_list;

    public function __construct()
    {
        $this->crypto_machine_list = array();
    }

    public function __destruct() {}

    public function createForm()
    {
        $this->setPageTitle();
        $this->selectCryptoForm();
        $this->createWebPage();
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    public function setCryptoMachine(array $crypto_machine_list)
    {
        $this->crypto_machine_list = $crypto_machine_list;
    }

    private function setPageTitle()
    {
        $this->page_title = 'List Machine names';
    }

    private function selectCryptoForm()
    {
        $address = APP_ROOT_PATH;
        $crypto_machine_option_list = $this->createCryptoMachineOptionList();
        $this->html_page_content = <<< HTMLFORM
<div id="lg-form-container">
<h2>Select One of Your Crypto Machines</h2>
<h3>Please select a Cryptographic Machine from the list to edit</h3>
<form method="post" action="$address">
<select name="crypto-machine">
$crypto_machine_option_list
</select>
<p class="text_right">
<button name="feature" value="edit_crypto_details">Edit Crypto Machine Details</button>
</p>
</form>
</div>
HTMLFORM;
    }

    private function createCryptoMachineOptionList()
    {
        $crypto_machine_option_list = '';
        $crypto_machine_option_list .= '<option value="0"><-- please select --></option>';
        foreach ($this->crypto_machine_list as $crypto_machine_option => $crypto_machine)
        {
            $crypto_machine_option_list .= '<option value="' . $crypto_machine_option . '">' . $crypto_machine . '</option>';
        }
        return $crypto_machine_option_list;
    }
}