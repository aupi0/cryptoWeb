<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 10:06
 */

class DeleteMachineController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $input_error = true;
        $delete_machine_result = [];

        $validated_input = $this->validate();
        $input_error = $validated_input['input-error'];

        if (!$input_error)
        {
            $delete_machine_result = $this->deleteMachine($validated_input);
        }

        $this->html_output = $this->createView($delete_machine_result);
    }

    private function validate()
    {
        $validate = Factory::buildObject('Validate');
        $tainted = $_POST;

        $cleaned['validated-crypto-machine-name'] = $validate->validateString('updated_crypto_machine_name', $tainted, 3, 30);
        $cleaned['crypto_machine_id'] = $tainted['crypto_machine_id'];
        $cleaned['input-error'] = $validate->checkForError($cleaned);

        return $cleaned;
    }

    private function DeleteMachine($validated_input)
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('DeleteUserMachineModel');

        $model->setDatabaseHandle($database);
        $model->getDeleteMachineDetailsResult();

        $model->setValidatedInput($validated_input);
        $model->deleteMachineDetails();
        $delete_machine_results = $model->getDeleteMachineDetailsResult();
        return $delete_machine_results;
    }

    private function createView($delete_machine_results)
    {
        $view = Factory::buildObject('DeleteUserMachineView');

        $view->setDeleteMachineDetailsResult($delete_machine_results);
        $view->createOutputPage();
        $html_output = $view->getHtmlOutput();

        return $html_output;
    }
}