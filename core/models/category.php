<?php

   function findCategoryById($id){
       $sql = "SELECT * FROM category WHERE id = $id";

       return selectData($sql);
   } 