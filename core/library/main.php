<?php

    function show404page(){
        header("HTTP/1.1 404 Not Found");
        // TODO: Заменить на view 
        echo '404 page not found!';
    }

    function renderView($viewName, array $data = []){
        include 'core/views/'.$viewName.'.php';
    }

    function is_auth(){
        if(isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])){
            return true;
        }
        return false;
    }

    function is_admin(){
        if($_SESSION['user']['role'] == 'admin'){
            return true;
        }
        return false;
    }

    function getUrlSegment($num){
        $url = strtolower($_GET['url']);
        $urlSegments = explode('/', $url);
            return $urlSegments[$num];
    }