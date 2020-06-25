<?require_once ('include/header.php');?>

<?
// Get all data current user
$id = $_GET['id'];

if(!empty($id) and !empty($_FILES)){
    $res = updateUserInfo($_GET,$_POST,$_FILES);
}



$user = getUserInfo($id);
?>
        <form action="" method="post" enctype="multipart/form-data">
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

                                <div class="form-group">
                                    <img src="<?=$user['avatar']?>" alt="<?=$user['name']?>" class="img-responsive" width="200">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Default file input</label>
                                    <input type="file" name="avatar" id="example-fileinput" class="form-control-file">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<?require_once ('include/footer.php');?>