<!DOCTYPE html>
<html lang="en">

<head>
     <!--  Title -->
     <title> <?=ucwords(strtolower(($title) ? ' - '.$title : ""))?></title>
     <!--  Required Meta Tag -->
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <meta name="handheldfriendly" content="true" />
     <meta name="MobileOptimized" content="width" />
     <meta name="description" content="Government of Cross River State appointee's verification portal" />
     <meta name="author" content="Cross River State" />
     <meta name="keywords" content="<?=$app_seo_keywords?>" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <!--  Favicon -->
     <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/uploads/<?=$app_favicon?>" />
     <!-- App css -->
     <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="<?=base_url()?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>