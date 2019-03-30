<?php
/**
 * Router.php
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package crypto-show
 */

class Router
{
    private $feature_in;
    private $feature;
    private $html_output;
    private $output;
    public function __construct()
    {
        $this->feature_in = '';
        $this->feature = '';
        $this->output = '';
        $this->html_output = '';
    }
    public function __destruct(){}
    public function routing()
    {
        $this->setFeatureName();
        $this->mapFeatureName();
        $this->selectController();
        $this->processOutput();
    }
    public function getHtmlOutput()
    {
        return $this->html_output;
    }
    private function setFeatureName()
    {
        if (isset($_POST['feature']))
        {
            $feature_in = $_POST['feature'];
        }
        else
        {
            $feature_in = 'index';
        }
        $this->feature_in = $feature_in;
    }
    private function mapFeatureName()
    {
        $feature_exists = false;
        // map the passed module name to an internal application feature name
        //added display crypto detials to array
        $features = array(
            'index' => 'landing-page',
            'user_register' => 'user-register-form',
            'process_new_user_details' => 'user-register-process',
            'user_login' => 'user-login-form',
            'process_login' => 'user-login-process',
            'user_logout' => 'user-logout-process',
            'display_crypto_list' => 'display-crypto-list',
            'display_crypto_details' => 'display-crypto-details',
            'crypto_machine_create' => 'crypto-machine-create',
            'crypto_machine_edit' => 'crypto-machine-edit',
            'crypto_machine_create_process' => 'crypto-machine-create-process',
            'crypto_machine_edit_process' => 'crypto-machine-edit-process'
        );
        if (array_key_exists($this->feature_in, $features))
        {
            $this->feature = $features[$this->feature_in];
            $feature_exists =  true;
        }
        else
        {
            $this->feature = 'feature-error';
        }
        return $feature_exists;
    }
    public function selectController()
    {
        switch ($this->feature)
        {
            case 'user-register-form':
                $controller = Factory::buildObject('UserRegisterFormController');
                break;
            case 'user-register-process':
                $controller = Factory::buildObject('UserRegisterProcessController');
                break;
            case 'user-login-form':
                $controller = Factory::buildObject('UserLoginFormController');
                break;
            case 'user-login-process':
                $controller = Factory::buildObject('UserLoginProcessController');
                break;
            case 'user-logout-process':
                $controller = Factory::buildObject('UserLogoutProcessController');
                break;
            case 'crypto-machine-create':
                $controller = Factory::buildObject('CryptoMachineCreateFormController');
                break;
            case 'crypto-machine-edit':
                $controller = Factory::buildObject('CryptoMachineEditFormController');
                break;
            case 'crypto-machine-create-process':
                $controller = Factory::buildObject('CryptoMachineCreateProcessController');
                break;
            case 'crypto-machine-edit-process':
                $controller = Factory::buildObject('CryptoMachineEditProcessController');
                break;
            case 'display-crypto-list':
                //added this case
                $controller = Factory::buildObject('DisplayCryptoListController');
                break;
            case 'display-crypto-details':
                //Added this case
                $controller = Factory::buildObject('DisplayCryptoDetailsController');
                break;
            case 'feature-error':
                $controller = Factory::buildObject('ErrorController');
                $controller->setErrorType('feature-not-found-error');
                break;
            case 'landing-page':
            default:
                $controller = Factory::buildObject('IndexController');
                break;
        }
        $controller->createHtmlOutput();
        $this->output = $controller->getHtmlOutput();
    }
    private function processOutput()
    {
        $process_output = Factory::buildObject('ProcessOutput');
        $this->html_output = $compressed_output = $process_output->assembleOutput($this->output);
    }
}
