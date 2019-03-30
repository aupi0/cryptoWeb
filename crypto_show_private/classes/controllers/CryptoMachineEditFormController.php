<?php
/** CryptoMachineEditFormController.php
 *
 * Created by PhpStorm.
 * @author - Sam, Matt, Chris and Roan
 */

class CryptoMachineEditFormController extends ControllerAbstract
{

    public function createHtmlOutput()
    {
        $view = Factory::buildObject('CryptoMachineEditFormView');
        $view->createEditForm();
        $this->html_output = $view->getHtmlOutput();
    }
}