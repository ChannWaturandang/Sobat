<?php
// Create a class
class App{
    // Global variables
    public $controller = "";
    public $method = "";
    public $parameter = [];

    // PHP Constructor
    public function __construct(){
        session_start();
        // Default controller setup
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            $controller = "home";
            $method = "index";
        } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
            $controller = "user";
            $method = "transaksi_beli";
        } else {
            $controller = "login";
            $method = "index";
        }

        $this->initDefaultController($controller, $method, "");

        // Get URL
        $url = $this->parseURL();

        // Handle controller
        if(!empty($url)){
            if(file_exists('../app/controller/'.$url[0].'.php')){
                // Check if the controller belongs to the same role
                $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';

                // If the role is admin, they can't access user controller, and vice versa
                if (($role === 'admin' && $url[0] === 'user') || ($role === 'user' && $url[0] === 'home')) {
                    // Redirect to the default controller for that role
                    $this->controller = $role === 'admin' ? 'home' : 'user';
                    $this->method = $role === 'admin' ? 'index' : 'transaksi_beli';
                } else {
                    // Set the controller to what was requested
                    $this->controller = $url[0];
                }

                // Delete the first element (controller)
                unset($url[0]);
            }
        }

        // Require class controller
        require_once '../app/controller/'.$this->controller.'.php';
        $this->controller = new $this->controller; // Instantiate the controller

        // Handle Method
        if(isset($url[1])){
            $name_method = $url[1]; // Get the method name
            if(!$this->starts_with($name_method, "_")){
                // Check if the method exists in the controller
                if(method_exists($this->controller, $name_method)){
                    $this->method = $name_method;
                    unset($url[1]);  // Delete element index 1 in array
                }
            } else {
                unset($url[1]);
            }
        }

        // Handle Input Parameters
        if(!empty($url)){
            $this->parameter = array_values($url);
        } else {
            $this->parameter = [];
        }

        // Run controller and method with parameters
        call_user_func_array([$this->controller, $this->method], $this->parameter);
    }

    // Check if a string starts with an underscore
    private function starts_with($str, $prefix){
        return strpos($str, $prefix) === 0;
    }

    // Initialize default global variables
    private function initDefaultController($controller, $method, $param){
        $this->controller = $controller;
        $this->method = $method;
        $this->parameter = $param;
    }

    // Method to parse URL
    public function parseURL(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
