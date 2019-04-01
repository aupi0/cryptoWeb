<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 10:06
 */

class EditUserMachineProcessController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $input_error = true;
        $add_new_machine_result = [];

        $validated_input = $this->validate();
        $input_error = $validated_input['input-error'];

        if (!$input_error)
        {
            $add_new_machine_result = $this->addNewMachine($validated_input);
        }

        $this->html_output = $this->createView($add_new_machine_result);
    }

    private function validate()
    {
        $validate = Factory::buildObject('Validate');
        $tainted = $_POST;

        $cleaned['validated-crypto-machine-name'] = $validate->validateString('updated_crypto_machine_name', $tainted, 3, 30);
        $cleaned['validated-crypto-image-name'] = $validate->validateString('updated_crypto_image_name', $tainted, 3, 20);
        $cleaned['validated-crypto-visible'] = $validate->validateBinary('updated_crypto_visible', $tainted);
        $cleaned['crypto_machine_id'] = $tainted['crypto_machine_id'];
        $cleaned['input-error'] = $validate->checkForError($cleaned);

        return $cleaned;
    }

    private function addNewMachine($validated_input)
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('EditCryptoMachineProcessModel');

        $model->setDatabaseHandle($database);
        $model->getStoreNewMachineDetailsResult();

        $model->setValidatedInput($validated_input);
        $model->storeNewMachineDetails();
        $add_new_machine_results = $model->getStoreNewMachineDetailsResult();
        return $add_new_machine_results;
    }

    private function createView($add_new_machine_results)
    {
        $view = Factory::buildObject('EditCryptoMachineProcessView');

        $view->setStoreNewMachineDetailsResult($add_new_machine_results);
        $view->createOutputPage();
        $html_output = $view->getHtmlOutput();

        return $html_output;
    }
}