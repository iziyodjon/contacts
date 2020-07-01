<?
// Подключаю все функции
require_once ('libs/functions.php');

// Get all data current user
$id = $_GET['id'];
$status = $_POST['status'];

if(!empty($id) and !empty($status)){
    $res = setStatus($status,$id);
}

$user = getStatus($id);
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

</main>

<script src="js/vendors.bundle.js"></script>
<script src="js/app.bundle.js"></script>
<script>

    function delUser(id,url) {
        $.ajax({
            type: "POST",
            data: {id: id,avatar: url},
            url: "ajax/del_user.php"
        }).done(function(){
            alert("Вы уверены что хотите удалить ?");
            location.reload();
        });
    }

    $(document).ready(function()
    {


        $('input[type=radio][name=contactview]').change(function()
        {
            if (this.value == 'grid')
            {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                $('#js-contacts .js-expand-btn').addClass('d-none');
                $('#js-contacts .card-body + .card-body').addClass('show');

            }
            else if (this.value == 'table')
            {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                $('#js-contacts .js-expand-btn').removeClass('d-none');
                $('#js-contacts .card-body + .card-body').removeClass('show');
            }

        });

        //initialize filter
        initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));





    });

</script>
</body>
</html>