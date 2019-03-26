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
        $view = Factory::buildObject('DisplayListView');
        $view->createForm();
        $this->html_output = $view->getHtmlOutput();
    }
}