<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function upload_img($file_path,$file_name,$folder_name,$old_file)
{
    $CI =& get_instance();
    $CI->load->library('S3_upload');

    if(isset($file_path) && $file_path != ''){
        if($file_path['type'] != "image/jpg" && $file_path['type'] != "image/png" && $file_path['type'] != "image/jpeg" && $file_path['type'] != "image/JPEG" && $file_path['type'] != "image/PNG"){
            $res['file'] = 'Invalid file type. Only JPG, jpeg and PNG types are accepted';
            $res['status'] = FALSE;
        }
        else if(($file_path['size'] > 2097152)){
            $res['file'] = 'File too large. File must be less than 2 MB.';
            $res['status'] = FALSE;
        }else{
            $CI->load->helper('string');
            $fileName = str_replace(' ', '_', $file_name)."_".date("Ymd")."_".date("His")."_".random_string('alnum',8).str_replace('image/','.',$file_path['type']);

            $file =$CI->s3_upload->upload_file($file_path['tmp_name'],$fileName,$folder_name);

            if(isset($old_file) && $old_file != '' && $file['status'] == TRUE){
                $CI->s3_upload->delete_file($folder_name.'/'.$old_file);
                $res['file'] = $file['file'];
                $res['status'] = TRUE;
            }else if($file['status'] == TRUE){
                $res['file'] = $file['file'];
                $res['status'] = TRUE;
            }else {
                $res['file'] = 'Error!! upload file';
                $res['status'] = FALSE;
            }
        }
    }else{
        $res['file'] = 'Please select a file to upload';
        $res['status'] = FALSE;
    }
    return $res;
}

function uploadDispatcherImage($file_path,$id, $folder_name,$name)
{
    $CI =& get_instance();
    $CI->load->library('S3_upload');

    if(isset($file_path) && $file_path != ''){
        if($file_path['type'] != "image/jpg" && $file_path['type'] != "image/png" && $file_path['type'] != "image/jpeg" && $file_path['type'] != "image/JPEG" && $file_path['type'] != "image/PNG"){
            $res['file'] = 'Invalid file type. Only JPG, jpeg and PNG types are accepted';
            $res['status'] = FALSE;
        }
        else if(($file_path['size'] > 2097152)){
            $res['file'] = 'File too large. File must be less than 2 MB.';
            $res['status'] = FALSE;
        }else{
            $fileName = $id.$name;
            $file =$CI->s3_upload->upload_file($file_path['tmp_name'],$fileName,$folder_name);
             if($file['status'] == TRUE){
                $res['file'] = $file['file'];
                $res['status'] = TRUE;
            }else {
                $res['file'] = 'Error!! upload file';
                $res['status'] = FALSE;
            }
        }
    }else{
        $res['file'] = 'Please select a file to upload';
        $res['status'] = FALSE;
    }
    return $res;
}

function upload_img_multiple(array $img_options, $folder)
{
    $CI =& get_instance();
    $CI->load->library('S3_upload');
    
    $res = NULL;
    list($size,$type,$name,$tmp_name) = $img_options;
    
    if($tmp_name){
        $preferred_type = ['image/png','image/jpg','image/jpeg','image/x-png',
            'image/gif','image/pjpeg'];
        
        if(!in_array($type, $preferred_type))
        {
            $res['file'] = 'Invalid file type. Only JPG, jpeg and PNG types are accepted';
            $res['status'] = FALSE;
        }
        else if(($size > 2097152)){
            $res['file'] = 'File too large. File must be less than 2 MB.';
            $res['status'] = FALSE;
        }else{
            $file =$CI->s3_upload->upload_file($tmp_name, $name, $folder);
            
            if(isset($name) && $name != '' && $file['status'] == TRUE){
                $CI->s3_upload->delete_file($folder.'/'.$name);
                $res['file'] = $file['file'];
                $res['status'] = TRUE;
            }else if($file['status'] == TRUE){
                $res['file'] = $file['file'];
                $res['status'] = TRUE;
            }else {
                $res['file'] = 'Error!! upload file';
                $res['status'] = FALSE;
            }
        }
    }else{
        $res['file'] = 'Please select a file to upload';
        $res['status'] = FALSE;
    }

    return $res;
}

function Delete_multi($folderName,$file)
{
    $CI =& get_instance();
    $CI->load->library('S3_upload');
    return $res=$CI->s3_upload->multi_delete($folderName,$file);
}

function getImg($folder,$img){
    error_reporting(0);
    $CI =& get_instance();
    $CI->load->library('S3_upload');
    $res = $CI->s3_upload->getImg($img);

    // var_dump($res); die;
    return (isset($res->body)) ? 'data:image/jpeg;base64,'.base64_encode($res->body).'' : base_url('assets/common_icon/no-img.png');
}

?>