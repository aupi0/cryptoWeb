<?php
/** CryptoMachineCreateFormController.php
 *
 * Created by PhpStorm.
 * @author - Sam, Matt, Chris and Roan
 */

class CryptoMachineCreateFormController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $view = Factory::buildObject('CryptoMachineCreateFormView');
        $view->createRegisterForm();
        $this->html_output = $view->getHtmlOutput();
    }
}