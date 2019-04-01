<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 09:48
 */

class EditCryptoDetailsFormView extends WebPageTemplateView
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
        $page_heading = 'Edit Crypto Machine';
        $form_method = 'post';
        $form_action = APP_ROOT_PATH;
        $fieldset_legend_text = 'Update Crypto Machine details ...';
        $input_field_maximum_size = 50;
        $input_field_maximum_characters = 50;
        $crypto_name = $this->crypto_details['sanitised-crypto-machine'];
        $crypto_details = $this->crypto_details['crypto-details'];
        $crypto_id = $crypto_details['crypto_machine_id'];
        $crypto_image_name = $crypto_details['crypto_machine_image_name'];
        $crypto_visible = $crypto_details['crypto_machine_record_visible'];

        $this->html_page_content = <<< HTMLFORM
<h2>$page_heading</h2>
<form method="$form_method" action="$form_action">
<fieldset><legend>$fieldset_legend_text</legend>
<p>Crypto Machine Name: <input type="text" name="updated_crypto_machine_name" value="$crypto_name" size="$input_field_maximum_characters" maxlength="30" placeholder="Enter Crypto Machine Name (3 - 20 characters)" required="required" /></p>
<p>Crypto Machine Image Name: <input type="text" name="updated_crypto_image_name" value="$crypto_image_name" size="$input_field_maximum_characters" maxlength="20" placeholder="Enter Crypto Image Name (4 - 50 characters)" required="required" /></p>
<p>Crypto Machine Private or Public: <input type="text" name="updated_crypto_visible" value="$crypto_visible" size="$input_field_maximum_characters" maxlength="1" placeholder="Enter crypto visibility, 0 for private 1 for public" required="required" /></p>
<input type="hidden" name="crypto_machine_id" value="$crypto_id" />
<p><button name="feature" value="process_updated_machine_details">Update Crypto Machine details</button><button name="feature" value="delete_machine_details">Delete Crypto Machine</button></p>
</fieldset>
</form>
HTMLFORM;
    }
}