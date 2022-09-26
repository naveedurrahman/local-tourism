<?php
    include("get_data.php");
    include('like.php');
    $ajax_obj = new get_data(); 
    $likeobj = new like();

    $op = $_POST['op'];

    if($op == 'add_comment'){
        $resp = $ajax_obj->addComment();
        echo $resp;
    }else if($op == 'getComments'){
        $resp = $ajax_obj->getComments($_POST['post_id']);
        echo json_encode($resp);
    }else if($op == 'likePost'){
        $resp = $likeobj->likePost();
        echo $resp;
    }else if($op == 'unlikePost'){

        $resp = $likeobj->unlikePost();
        echo $resp;
    }else if($op == 'getSinglePostLikes'){
        $resp = $likeobj->getSinglePostLikes($_POST['post_id']);
        echo $resp;
    }else if($op == 'reportPost'){
        $resp = $ajax_obj->reportPost();
        echo $resp;
    }
