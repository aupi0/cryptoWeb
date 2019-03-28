<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 25/03/2019
 * Time: 22:47
 */

class UserSearchController extends ControllerAbstract {

    public function createHtmlOutput(){

        $this->html_output = $this->createView();
    }

    private function getAllUsers(){
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('UserSearchModel');

        $model->setDatabaseHandle($database);
        $model->returnAllUsersResult();
        $model->getAllUsersFromDatabase();

        $user_details = $model->getAllUsersFromDatabase();

        return $user_details;
    }

    private function createView(){
        $view = Factory::buildObject('UserSearchView');

        $view->setGetUserResults($this->getAllUsers());
        $view->createOutputPage();
        $html_output = $view->getHtmlOutput();

        return $html_output;
    }

}