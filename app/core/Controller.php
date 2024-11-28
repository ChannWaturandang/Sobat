<?php
class Controller
{
    public function __construct()
    {
    }

    function start_session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function display($view, $data = [])
    {
        $this->start_session();
        if (!isset($_SESSION['user_id'])) {
            if ($view == 'login/register') {
                $view = 'login/register';
            } else {
                $view = 'login/index';
            }
            require_once "../app/view/".$view.".php";
        } 
        else {
            // $view = 'home/index';
            require_once '../app/view/' . $view . '.php';
        }
    }

    public function logic($model)
    {
        require_once "../app/model/" . $model . ".php";
        $obj_model = new $model;
        return $obj_model;
    }
}
