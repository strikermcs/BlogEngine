<?php
    session_start();

    require_once 'core/configs/main.php';
    require_once 'core/library/main.php';
    require_once 'core/library/validator.php';
    require_once 'core/library/db.php';
    require_once 'core/models/category.php';


    $chtrName = (!is_null(getUrlSegment(0))) ? 'main' : getUrlSegment(0);
    $actionName = (!is_null(getUrlSegment(1))) ? 'action_index' : 'action_'.getUrlSegment(1);
            echo $actionName;

    if(file_exists('core/controllers/'. $chtrName.'.php')){
        require_once 'core/controllers/'. $chtrName.'.php';

        if(function_exists($actionName)){
            $actionName();
        }else{
            show404page();
        }
    }else{
        show404page();
    }


?>



