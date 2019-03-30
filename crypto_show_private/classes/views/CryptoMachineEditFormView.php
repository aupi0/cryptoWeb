<?php
/** CryptoMachineEditFormView.php
 *
 * Created by PhpStorm.
 * @author - Sam, Matt, Chris and Roan
 */

class CryptoMachineEditFormView extends WebPageTemplateView
{

    public function createEditForm()
    {
        $this->setPageTitle();
        $this->createPageBody();
        $this->createWebPage();
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function setPageTitle()
    {
        $this->page_title = APP_NAME . ' Edit crypto details';
    }

    private function createPageBody()
    {
        $page_heading = 'Edit the details of your Crypto device';
        $form_method = 'post';
        $form_action = APP_ROOT_PATH;
        $fieldset_legend_text = 'Enter new crypto device details ...';
        $input_field_maximum_size = 100;
        $input_field_maximum_characters = 100;

        $this->html_page_content = <<< HTMLFORM
<h2>$page_heading</h2>
<form method="$form_method" action="$form_action">
<fieldset><legend>$fieldset_legend_text</legend>
<p>Crypto Machine Name: <input type="text" name="crypto_machine_name" value="" size="50" maxlength="50" placeholder="Enter crypto machine name (3 - 50 characters)" required="required" /></p>
<p>Model: <input type="text" name="crypto_machine_model" value="" size="30" maxlength="30" placeholder="Enter the model of your crypto device (5 - 30 characters)" required="required" /></p>
<p>Country of Origin: <input type="text" name="crypto_machine_country_of_origin" value="" size="30" maxlength="30" placeholder="Enter the country from where you device originates from" required="required" /></p>
<p>Description: <input type="text" name="crypto_machine_description" value="" size="$input_field_maximum_characters" maxlength="$input_field_maximum_characters" placeholder="Enter a description about your Crypto Machine" required="required" /></p>
<p>Image name: <input type="text" name="crypto_machine_image_name" value="" size="20" maxlength="20" placeholder="Password (8 to 50 characters)" required="required" /></p>
<p>Record Visibility: <input input type="text" name="crypto_machine_record_visible" value="" size="20" maxlength="20" placeholder=" Enter 0 (not visible to others) or 1(visible to others)?" required="required"/></p>
<p><button name="feature" value="crypto_machine_edit_process">Edit Crypto Details</button></p>
</fieldset>
</form>
HTMLFORM;
    }
}