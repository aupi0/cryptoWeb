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
        $view = Factory::buildObject('DisplayView');
        $view->createForm();
        $this->html_output = $view->getHtmlOutput();
    }
}