<?php
/** CryptoMachineCreateProcessView.php
 *
 * Created by PhpStorm.
 * @author - Sam, Matt, Chris and Roan
 */

class CryptoMachineCreateProcessView extends WebPageTemplateView
{
private $store_new_crypto_machine_details_results;
    private $output_content;

    public function __construct()
    {
        parent::__construct();
        $this->store_new_crypto_machine_details_results = [];
        $this->output_content = '';
    }

    public function __destruct(){}

    public function createOutputPage()
    {
        parent::__construct();
        $this->setPageTitle();
        $this->createAppropriateOutputMessage();
        $this->createPageBody();
        $this->createWebPage();
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    public function setStoreNewCryptoMachineDetailsResult($store_new_crypto_machine_details_results)
    {
        $this->store_new_crypto_machine_details_results = $store_new_crypto_machine_details_results;
    }

    private function setPageTitle()
    {
        $this->page_title = APP_NAME . ' Add the details of your Crypto device';
    }

    private function createAppropriateOutputMessage()
    {
        $output_content = '';
        if (isset($this->store_new_crypto_machine_details_results['input-error']))
        {
            if ($this->store_new_crypto_machine_details_results['input-error'])
            {
                $output_content .= $this->createErrorMessage();
            }
            else
            {
                $output_content .= $this->create_success_message();
            }
        }
        else
        {
            $output_content .= 'Ooops - something appears to have gone wrong.  Please try again later.';
        }
        $this->output_content = $output_content;
    }

    private function createPageBody()
    {
        $page_heading = 'Add the details of your Crypto device';

        $this->html_page_content = <<< HTMLFORM
<h2>$page_heading</h2>
$this->output_content
HTMLFORM;
    }

    private function createErrorMessage()
    {
        $path_to_image = MEDIA_PATH . 'sad_face.jpg';
        $form_method = 'post';
        $form_action = APP_ROOT_PATH;

        $page_content = <<< HTMLOUTPUT
<p>Ooops - there appears to have been an error - please check that you correctly entered all the required values.</p>
<form method="$form_method" action="$form_action">
<p><button name="feature" value="crypto_machine_create" /><img src="$path_to_image" alt="Sad face" /><br />Try again</button></p>
</form>
HTMLOUTPUT;
        return $page_content;
    }

    private function create_success_message()
    {
        $path_to_image = MEDIA_PATH . 'happy_face.jpg';
        $page_content = <<< HTMLOUTPUT
<p>You have been successfully created a record on your crypto machine!.</p>
<p><button name="feature" value="crypto_machine_create" /><img src="$path_to_image" alt="Happy face" /></button></p>
HTMLOUTPUT;
        return $page_content;
    }
}