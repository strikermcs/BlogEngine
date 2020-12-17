<?php

    function action_index(){
      if(is_auth()){
        echo 'Index page';
      }else{
        echo "Hello guest";
      }
      
     
    }

    function action_registration(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $formData = [
          'login' => getSaveData(htmlspecialchars(trim($_POST['login']))),
          'password' => getSaveData(trim($_POST['password'])),
          'email' => getSaveData(trim($_POST['email']))
        ];
      
       $rules = [
          'login' => ['required', 'login'],
          'password' => ['required','password'],
          'email' => ['required', 'email']
       ];

       $errors = validateForm($rules, $formData);
       if(empty($errors)){
         $formData['password'] = md5($formData['password']).SECRET_KEY;
         $sql = "INSERT INTO `user`(`id`, `login`, `password`, `email`, `role`) 
                                VALUES ('{$formData['login']}', '{$formData['password']}', '{$formData['email']}')";
         $sql1 = "SELECT id FROM user WHERE login='{$formData['login']}' or email = '{$formData['email']}'";  
         
         $res = selectData($sql1);
           if($res->num_rows === 0 ){
             if(insertUpdateDelete($sql)){
               header("Location: /main/successReg");
             } 
            } else{
              echo "Логин или email уже занят";
            }                
       }
      
      }
      renderView('registration', $errors);
    }

    function action_successReg(){
      echo "Успех. Пользователь зарегистрированый";
    }

    function action_login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $formData = [
            'login' => getSaveData(htmlspecialchars(trim($_POST['login']))),
            'password' => getSaveData(trim($_POST['password']))
            ];
            $formData['password'] = md5($formData['password']).SECRET_KEY;

            $sql = "SELECT id FROM user WHERE login='{$formData['login']}' and password = '{$formData['password']}'"; 
            $res = selectData($sql);

            if($res->num_rows === 0 ){
              echo 'Incorrect login or password';
             } else{
               $_SESSION['user'] = mysqli_fetch_assoc($res);
               header('Location: /');
             }       

        }
      renderView('login', []);
    }

    function action_logout(){
      session_unset();
      session_destroy();
      header('Location: /');
    }