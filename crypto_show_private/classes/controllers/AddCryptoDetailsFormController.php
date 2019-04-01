<?php
/**
 * Created by PhpStorm.
 * User: d1da
 * Date: 28/03/19
 * Time: 07:11
 */

class AddCryptoDetailsFormController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $view = Factory::buildObject('AddMachineFormView');
        $view->createMachineForm();
        $this->html_output = $view->getHtmlOutput();
    }
}