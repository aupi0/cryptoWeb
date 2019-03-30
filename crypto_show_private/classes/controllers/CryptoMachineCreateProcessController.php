<?php
/**  CryptoMachineCreateProcessController.php
 *
 * Created by PhpStorm.
 * @author - Sam, Matt, Chris and Roan
 */

class CryptoMachineCreateProcessController extends ControllerAbstract
{
   public function createHtmlOutput()
    {
        $input_error = true;
        $register_new_crypto_machine_result = [];

        $validated_input = $this->validate();
        $input_error = $validated_input['input-error'];
        var_dump($validated_input);
        if (!$input_error)
        {
            $register_new_crypto_machine_result = $this->registerNewCryptoDevice($validated_input);
        }

        $this->html_output = $this->createView($register_new_crypto_machine_result);
    }

    private function validate()
    {
        $validate = Factory::buildObject('Validate');
        $tainted = $_POST;

        $cleaned['validated-crypto-machine-name'] = $validate->validateString('crypto_machine_name', $tainted, 3, 50);
        $cleaned['validated-crypto-machine-model'] = $validate->validateString('crypto_machine_model', $tainted, 3, 30);
        $cleaned['validated-crypto-machine-country-of-origin'] = $validate->validateString('crypto_machine_country_of_origin', $tainted, 3, 30);
        $cleaned['validated-crypto-machine-description'] = $validate->validateString('crypto_machine_description', $tainted, 3, 100);
        $cleaned['input-error'] = $validate->checkForError($cleaned);

        return $cleaned;
    }

    private function registerNewCryptoDevice($validated_input)
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('CryptoMachineCreateProcessModel');

        $model->setDatabaseHandle($database);
        $model-> getStoreNewCryptoMachineDetailsResult();

        $model->setValidatedInput($validated_input);
        $model->storeNewCryptoMachineDetails();
        $register_new_crypto_machine_results = $model->getStoreNewCryptoMachineDetailsResult();
        return $register_new_crypto_machine_results;
}

    private function createView($register_new_crypto_machine_result)
    {
        $view = Factory::buildObject('CryptoMachineCreateProcessView');

        $view->setStoreNewCryptoMachineDetailsResult($register_new_crypto_machine_result);
        $view->createOutputPage();
        $html_output = $view->getHtmlOutput();

        return $html_output;
    }
}