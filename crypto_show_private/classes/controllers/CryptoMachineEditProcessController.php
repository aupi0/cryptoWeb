<?php
/** CryptoMachineEditProcessController.php
 *
 * Created by PhpStorm.
 * @author - Sam, Matt, Chris and Roan
 */

class CryptoMachineEditProcessController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $input_error = true;
        $edit_crypto_machine_result = [];

        $validated_input = $this->validate();
        $input_error = $validated_input['input-error'];

        if (!$input_error)
        {
            $edit_crypto_machine_result = $this->editCryptoDevice($validated_input);
        }

        $this->html_output = $this->createView($edit_crypto_machine_result);
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

    private function editCryptoDevice($validated_input)
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('CryptoMachineEditProcessModel');

        $model->setDatabaseHandle($database);
        $model->getEditCryptoMachineDetailsResult();

        $model->setValidatedInput($validated_input);
        $model->editCryptoMachineDetails();
        $edit_crypto_machine_results = $model->getEditCryptoMachineDetailsResult();
        return $edit_crypto_machine_results;
}

    private function createView($edit_crypto_machine_result)
    {
        $view = Factory::buildObject('CryptoMachineEditProcessView');

        $view->getUpdateCryptoMachineDetailsResult($edit_crypto_machine_result);
        $view->createOutputPage();
        $html_output = $view->getHtmlOutput();

        return $html_output;
    }
}