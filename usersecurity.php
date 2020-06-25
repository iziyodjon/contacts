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
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input type="text" name="email"  id="simpleinput" class="form-control" value="<?=$user['email']?>">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Password</label>
                                    <input type="password" name="password" id="simpleinput" class="form-control">
                                </div>

                                <!-- password confirmation-->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Password Confirmation</label>
                                    <input type="password" name="password" id="simpleinput" class="form-control">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>



<?
if(!empty($id) and !empty($_POST)){
    updateUserInfo($_GET,$_POST);
}
?>
<?require_once ('include/footer.php');?>