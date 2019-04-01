<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 07:14
 */

class AddMachineFormView extends WebPageTemplateView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct(){}

    public function createMachineForm()
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
        $this->page_title = APP_NAME . ' Add a new Crypto Machine';
    }

    private function createPageBody()
    {
        $page_heading = 'Add a New Crypto Machine';
        $form_method = 'post';
        $form_action = APP_ROOT_PATH;
        $fieldset_legend_text = 'Enter new Crypto Machine details ...';
        $input_field_maximum_size = 50;
        $input_field_maximum_characters = 50;

        $this->html_page_content = <<< HTMLFORM
<h2>$page_heading</h2>
<form method="$form_method" action="$form_action">
<fieldset><legend>$fieldset_legend_text</legend>
<p>Crypto Machine Name: <input type="text" name="new_crypto_machine_name" value="" size="$input_field_maximum_characters" maxlength="30" placeholder="Enter Crypto Machine Name (3 - 20 characters)" required="required" /></p>
<p>Crypto Machine Image Name: <input type="text" name="new_crypto_image_name" value="" size="$input_field_maximum_characters" maxlength="20" placeholder="Enter Crypto Image Name (4 - 50 characters)" required="required" /></p>
<p>Crypto Machine Private or Public: <input type="text" name="new_crypto_visible" value="" size="$input_field_maximum_characters" maxlength="1" placeholder="Enter crypto visibility, 0 for private 1 for public" required="required" /></p>
<p><button name="feature" value="process_new_machine_details">Store new Crypto Machine details</button></p>
</fieldset>
</form>
HTMLFORM;
    }
}