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
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- status -->
                                        <div class="form-group">
                                            <label class="form-label" for="example-select">Choose Status</label>
                                            <select class="form-control" name="status" id="example-select">
                                                <option <?= ($user['status'] == 'Online') ? 'selected' : '';?>>Online</option>
                                                <option <?= ($user['status'] == 'Away') ? 'selected' : '';?> >Away</option>
                                                <option <?= ($user['status'] == 'Busy') ? 'selected' : '';?>>Busy</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button class="btn btn-warning">Set Status</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
<?require_once ('include/footer.php');?>