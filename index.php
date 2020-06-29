<?require_once (dirname(__FILE__).'/include/header.php');?>

<?
// Get all data current user
$id = $_GET['id'];
$del = $_GET['user'];

if(!empty($id) and !empty($del)){
    $res = updateUserInfo($_GET,$_POST,$_FILES);
}

// Получаем всех пользователей
$users = getAllUsers();

/*$email = 'test@mail.ru';
$password = '12345';

$adUser = adUser($email,$password);

dd($adUser);

exit;*/

?>
        <div class="row">
            <div class="col-xl-12">
                <a class="btn btn-success" href="useradd.php">Add User</a>

                <div class="border-faded bg-faded p-3 mb-g d-flex mt-3">
                    <input type="text" id="js-filter-contacts" name="filter-contacts" class="form-control shadow-inset-2 form-control-lg" placeholder="Filter contacts">
                    <div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3" data-toggle="buttons">
                        <label class="btn btn-default active">
                            <input type="radio" name="contactview" id="grid" checked="" value="grid"><i class="fas fa-table"></i>
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="contactview" id="table" value="table"><i class="fas fa-th-list"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="js-contacts">
            <?foreach($users as $user):?>
            <div class="col-xl-4">
                <div id="c_1" class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="<?=strtolower($user['username']);?>">
                    <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                        <div class="d-flex flex-row align-items-center">
                            <span class="status <?=getUserStatus($user['status']);?> mr-3">
                                <span class="rounded-circle profile-image d-block " style="background-image:url('<?=$user['avatar']?>'); background-size: cover;"></span>
                            </span>
                            <div class="info-card-text flex-1">
                                <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                                    <?=$user['username'];?>
                                    <i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
                                    <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="useredit.php?user=edit&id=<?=$user['id']?>">
                                        <i class="fa fa-edit"></i>
                                    Edit Information</a>
                                    <a class="dropdown-item" href="usersecurity.php?user=secure&id=<?=$user['id']?>"">
                                        <i class="fa fa-lock"></i>
                                    Security</a>
                                    <a class="dropdown-item" href="userstatus.php?user=status&id=<?=$user['id']?>"">
                                        <i class="fa fa-sun"></i>
                                    Set Status</a>
                                    <a class="dropdown-item" href="useravatar.php?user=avatar&id=<?=$user['id']?>"">
                                        <i class="fa fa-camera"></i>
                                        Change Media
                                    </a>
                                    <a href="/?user=del&id=<?=$user['id']?>" class="dropdown-item deluser">
                                        <i class="fa fa-window-close"></i>
                                        Delete User
                                    </a>
                                </div>
                                <span class="text-truncate text-truncate-xl"><?=$user['job_title']?></span>
                            </div>
                            <button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_1 > .card-body + .card-body" aria-expanded="false">
                                <span class="collapsed-hidden">+</span>
                                <span class="collapsed-reveal">-</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0 collapse show">
                        <div class="p-3">
                            <a href="tel:+13174562564" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mobile-alt text-muted mr-2"></i> <?=$user['phone_number']?></a>
                            <a href="mailto:<?=$user['email']?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mouse-pointer text-muted mr-2"></i> <?=$user['email']?></a>
                            <address class="fs-sm fw-400 mt-4 text-muted">
                                <i class="fas fa-map-pin mr-2"></i> <?=$user['address']?></address>
                            <div class="d-flex flex-row">
                                <?if(!empty($user['soc_vk'])):?>
                                <a href="<?=$user['soc_vk']?>" class="mr-2 fs-xxl" style="color:#4680C2">
                                    <i class="fab fa-vk"></i>
                                </a>
                                <?endif;?>
                                <?if(!empty($user['soc_tg'])):?>
                                    <a href="<?=$user['soc_tg']?>" class="mr-2 fs-xxl" style="color:#38A1F3">
                                        <i class="fab fa-telegram"></i>
                                    </a>
                                <?endif;?>
                                <?if(!empty($user['soc_inst'])):?>
                                    <a href="<?=$user['soc_inst']?>" class="mr-2 fs-xxl" style="color:#E1306C">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?endforeach;?>

        </div><! #js-contacts-->
<?require_once ('include/footer.php');?>