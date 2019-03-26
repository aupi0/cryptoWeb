<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 26/03/19
 * Time: 04:49
 */

class DisplayCryptoDetailsController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $crypto_machine_details = [];

        $validated_crypto_machine = $this->validate();

        if ($validated_crypto_machine !== false)
        {
            $crypto_machine_details = $this->retrieveCryptoDetails($validated_crypto_machine);
        }

        $this->html_output = $this->createView($crypto_machine_details);
    }

    private function validate()
    {
        $validate = Factory::buildObject('Validate');
        $tainted = $_POST;

        $validated_crypto_machine = $validate->validateString('crypto-machine', $tainted, 3, 25);

        return $validated_crypto_machine;
    }

    private function retrieveCryptoDetails($validated_crypto_machine)
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('DisplayCryptoDetailsModel');

        $model->setDatabaseHandle($database);
        $model->getDatabaseConnectionResult();

        $model->setCryptoMachine($validated_crypto_machine);
        $model->retrieveCryptoDetails();
        $crypto_details = $model->getCryptoDetails();
        return $crypto_details;
    }

    private function createView($crypto_details)
    {
        $view = Factory::buildObject('DisplayView');
        $view->setCryptoDetails($crypto_details);
        $view->createOutputPage();
        $html_output = $view->getHtmlOutput();

        return $html_output;
    }
}