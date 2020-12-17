<?php

    function connectToDb(){
        $config = require 'core/configs/db_config.php';

       $link = @mysqli_connect($config['host'], $config['user'], $config['password'], $config['db_name']);
            if(!$link){
                echo "DataBase connect error";
                die();
            }

            return $link;
       
    }


    function selectData($sql){
        $link = connectToDb();
        $res = mysqli_query($link, $sql);

        if(!$res){
            die(mysqli_error($link));
        }

        return $res;

    }

    function insertUpdateDelete($sql){
        $link = connectToDb();
        $res = mysqli_query($link, $sql);

        if(!$res){
            die(mysqli_error($link));
        }

        return $res;
    }

    function getSaveData($str){
        $link = connectToDb();
        return mysqli_real_escape_string($link, $str);
    }