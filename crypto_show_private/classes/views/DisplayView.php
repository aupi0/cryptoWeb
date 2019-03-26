<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 26/03/19
 * Time: 04:41
 */

class DisplayView extends WebPageTemplateView
{

    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct(){}

    public function createForm()
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
        $this->page_title = 'PetShow Index Page';
    }

    private function createPageBody()
    {
        //added Address
        $address = APP_ROOT_PATH;
        $year = date('Y');
        $info_text = '';
        $info_text .= 'Please select a Cryptographic Machine from the list ';
        $info_text .= '<br />';
        $page_heading = APP_NAME . ' demonstration';

        //Added Form
        $this->html_page_content = <<< HTMLFORM
<h2>$page_heading</h2>
<p>$info_text</p>
<form action="$address" method="post">
<p class="curr_page"></p>
<fieldset>
<legend>Select option</legend>
<br />
<button name="feature" value="show_crypto_machines">Show Crypto Machines</button>
<br />
<br />
<button name="feature" value="display_machine_details">Display Machine Details</button>
</fieldset>
</form>
HTMLFORM;
    }
}