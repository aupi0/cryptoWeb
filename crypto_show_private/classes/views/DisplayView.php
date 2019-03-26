<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 26/03/19
 * Time: 04:41
 */

class DisplayView extends WebPageTemplateView
{
    private $crypto_details;

    public function __construct()
    {
        $this->crypto_details = array();
    }

    public function __destruct() {}

    public function createOutputPage()
    {
        $this->setPageTitle();
        $this->createRelevantOutput();
        $this->createWebPage();
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    public function setCryptoDetails(array $crypto_details)
    {
        $this->crypto_details = $crypto_details;
    }

    private function setPageTitle()
    {
        $this->page_title = 'Display Crypto Machine details';
    }

    private function createRelevantOutput()
    {
        if (isset($this->crypto_details['sanitised-crypto-machine']))
        {
            if (!$this->crypto_details['sanitised-crypto-machine'])
            {
                $this->createErrorMessage();
            }
            else
            {
                $this->displayCryptoDetails();
            }
        }
    }

    private function createErrorMessage()
    {
        $this->html_page_content = <<< NAMEERRORPAGE
<div id="lg-form-container">
<p class="error">Ooops - there was a problem with the Crypto Machine name you selected/entered</p>
</div>
NAMEERRORPAGE;
    }

    private function displayCryptoDetails()
    {
        $stock_values = '';
        $address = APP_ROOT_PATH;
        $crypto_name = $this->crypto_details['sanitised-crypto-machine'];
        $crypto_details = $this->crypto_details['crypto-details'];
        $crypto_machine_id = $crypto_details['crypto_machine_id'];
        $user_id = $crypto_details['fk_user_id'];
        $crypto_image_name = $crypto_details['crypto_machine_image_name'];
        $this->html_page_content = <<< VIEWCRYPTODETAILS
<div id="lg-form-container">
<h2>Crypto Machine details for $crypto_name</h2>
<table border="1">
<tr><td>Crypto Machine ID :</td><td>$crypto_machine_id</td></tr>
<tr><td>Crypto Machine Name :</td><td>$crypto_name</td></tr>
<tr><td>User ID :</td><td>$user_id</td></tr>
<tr><td>Picture Name :</td><td>$crypto_image_name</td></tr>
</td>
</tr>
</table>
</div>
VIEWCRYPTODETAILS;
    }
}