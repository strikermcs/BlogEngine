<?php

    function action_index(){

    }

    function action_category(){
        $categoryName = getUrlSegment(2);
        if(is_null($categoryName)){
            show404page();
        }
        $result = findCategoryById($categoryName);

        if($result->num_rows == 0){
            show404page();
        }
        $categoryData = mysqli_fetch_assoc($result);
      
        $allPosts = getAllPostInCategory($categoryData['id']);
        
        renderView('category', ['posts' => $allPosts, 'categoryData' => $categoryData]);
    }