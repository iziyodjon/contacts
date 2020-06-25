<?require_once ('include/header.php');?>

<?


    // Get all data current user
    $id = $_GET['id'];

    if(!empty($id) and !empty($_POST)){
        $res = updateUserInfo($_GET,$_POST);
    }

    $user = getUserInfo($id);

?>
        <form action="" method="post">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>General</h2>
                            </div>
                            <div class="panel-content">
                                <?if($res):?>
                                <div class="panel-tag">
                                    Information successfully updated.
                                </div>
                                <?endif;?>
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Username</label>
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