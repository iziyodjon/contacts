<?
// Подключаю все функции
require_once ('libs/functions.php');

if(!empty($_GET['id']) and !empty($_POST['user_id'])){

    $res = setUserProfile($_POST['username'], $_POST['job_title'], $_POST['phone_number'], $_POST['address'], $_POST['user_id']);
}

$user = getUserProfile($_GET['id']);
?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Contacts</title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">

    </head>
<body>
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-plus-circle'></i> Contacts
            <small>
                A simple contact page
            </small>
        </h1>

    </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>General</h2>
                            </div>
                            <div class="panel-content">
                                <div class="panel-tag">
                                    Information successfully updated.
                                </div>
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Username</label>
                                    <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                                    <input type="text" name="username" id="simpleinput" class="form-control" value="<?=$user['username']?>">
                                </div>

                                <!-- Job_title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Job Title</label>
                                    <input type="text" name="job_title" id="simpleinput" class="form-control" value="<?=$user['job_title']?>">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Phone Number</label>
                                    <input type="text" name="phone_number" id="simpleinput" class="form-control" value="<?=$user['phone_number']?>">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Address</label>
                                    <input type="text" name="address" id="simpleinput" class="form-control" value="<?=$user['address']?>">
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>



<?require_once ('include/footer.php');?>