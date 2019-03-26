<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 26/03/19
 * Time: 06:03
 */

class DisplayCryptoListController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('DisplayCryptoListModel');
        $view = Factory::buildObject('DisplayListView');

        $model->setDatabaseHandle($database);
        $model->createCryptoList();
        $crypto_machine = $model->getCryptoMachines();

        $view->setCryptoMachine($crypto_machine);
        $view->createForm();
        $this->html_output = $view->getHtmlOutput();
    }
}