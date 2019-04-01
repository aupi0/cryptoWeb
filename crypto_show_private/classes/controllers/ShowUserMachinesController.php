<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 09:31
 */

class ShowUserMachinesController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('DisplayUserMachinesModel');
        $view = Factory::buildObject('DisplayUserMachinesView');

        $model->setDatabaseHandle($database);
        $model->createCryptoList();
        $crypto_machine = $model->getCryptoMachines();

        $view->setCryptoMachine($crypto_machine);
        $view->createForm();
        $this->html_output = $view->getHtmlOutput();
    }
}