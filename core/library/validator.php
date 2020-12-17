<?php
    function required($data){
      
            return empty($data);
        
    }

    function email($data){
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

        if (!preg_match ($pattern, $data) ){  
            
            return false;  
        } else {  
           true; 
        }  
    }

    function password($data){
        $length = strlen($data);
        if($length < 6){
            return false;
           
        } else{
            return true;
        }
    }


    function validateForm($dataWithRules, $data){
        $errorForm = [];
        $fields = array_keys($dataWithRules);

        foreach($fields as $fieldName){
            $fieldData = $data[$fieldName];
            $rules = $dataWithRules[$fieldName];
                foreach($rules as $ruleName){
                   if(!$ruleName($fieldData)){
                      $errorForm[$fieldName][] = $ruleName;  
                   }
                }
        }
        return $errorForm;
    }

