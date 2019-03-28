<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 25/03/2019
 * Time: 22:47
 */

class UserSearchView extends WebPageTemplateView {

    private $get_user_results;
    private $output_content;

    public function  __construct() {
        parent::__construct();
        $this->get_user_results = '';
        $this->output_content = '';
    }

    public function __destruct(){}

    public function createOutputPage(){
        parent::__construct();
        $this->setPageTitle();
        $this->createAppropriateOutputMessage();
        $this->createPageBody();
        $this->createWebPage();
    }

    public function getHtmlOutput(){
        return $this->html_page_output;
    }

    private function getUserResults(){
        return $this->get_user_results;
    }

    public function setGetUserResults($get_user_results){
        var_dump($get_user_results);
        $this->get_user_results = $get_user_results;
    }

    private function setPageTitle(){
        $this->page_title = APP_NAME . ' Get All Users';
    }

    private function createAppropriateOutputMessage(){
        $output_content = '';

       // if(isset($this->get_user_results['output-error'])){
//            if($this->get_user_results['output-error']){
//                $output_content .= $this->createErrorMessage();
//            }
//            else{
//                $output_content .= $this->createSuccessMessage();
//            }
//        }
//
//        else{
//            $output_content .= 'Ooops - something appears to have gone wrong.  Please try again later.';
//        }

        $output_content .= $this->createSuccessMessage();

        $this->output_content = $output_content;
    }

    private function createPageBody(){
        $page_heading = 'All Users';

        $this->html_page_content = <<< HTMLFORM
<h2>$page_heading</h2>
$this->output_content
HTMLFORM;
    }

    private function createErrorMessage(){
        $path_to_image = MEDIA_PATH . 'sad_face.jpg';

        $page_content = <<< HTMLOUTPUT
<p> Oopsie woopsie, something appears to have done the wrong thing. It must be Matt's bad coding!! Have a great day!! </p>
<p><button name="feature" value="index" /><img src="$path_to_image" alt="Sad face" /><br/></p>
HTMLOUTPUT;

        return $page_content;

    }

    private function createSuccessMessage(){
        $path_to_image = MEDIA_PATH . 'happy_face.jpg';

        $results = $this->getUserResults();

        unset($results["user_id"]);
        unset($results["user_nickname"]);
        unset($results["user_name"]);
        unset($results["user_email"]);
        unset($results["user_machine_count"]);
        var_dump(array_values($results)); //debugging purposes

        $table = "<table border=\"1\">";
        $table .= '<tr><th>User ID</th><th>Username</th><th>User Nickname</th><th>Email address</th><th>Number of Machines</th></tr>';
        foreach($results as $user) {
            $table .= "<tr>";
            foreach($user as $attributes) {
                    $table .= "<td>$attributes</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";

        $page_content = $table;

        //$page_content = '<tr><th>Movies</th><th>Genre</th><th>Director</th></tr>';

        //array_values($results);

        return $page_content;

    }
}