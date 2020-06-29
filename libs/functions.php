<?php
require_once ('Db.php');


// debug array
function dd($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function adUser($email,$password){
    $pdo = new PDO('mysql:host=localhost;dbname=adress_book', 'root', '');

    $sql = "INSERT INTO users (email,password) VALUES (:email,:password)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'password' => $password]);

    $lastID =  $pdo->lastInsertId();
    return $lastID;
}



// Add user
function addUser($post,$files)
{

    // Подключение
    $link = Db();

    // Данные из формы
    $username = $post['username'];
    $job_title = $post['job_title'];
    $phone_number = $post['phone_number'];
    $address = $post['address'];
    $email = $post['email'];
    $password = md5($post['password']);
    $status = $post['status'];
    $avatar = avatarUser($files);
    $soc_vk = $post['soc_vk'];
    $soc_tg = $post['soc_tg'];
    $soc_inst = $post['soc_inst'];

    if(!empty($username) and !empty($email))
    {
        $query ="INSERT INTO `users` (username,job_title,phone_number,address,email,password,status,avatar,soc_vk,soc_tg,soc_inst) 
        VALUES ('$username','$job_title','$phone_number','$address','$email','$password','$status','$avatar','$soc_vk','$soc_tg','$soc_inst')";

        if (!empty($avatar)) {
            $link->query($query);
            $res = TRUE;
        } else {
            $res = FALSE;
        }
    }
        return $res;
}

// User avatar
function avatarUser($files=null)
{
    $name = $files['name'];
    $type = $files['type'];
    $tmp_name = $files['tmp_name'];
    $size = $files['size'];

    if($type == 'image/jpeg' and $size <= 1024 * 1024)
    {
        $dist ='uploads/'.$name;
        move_uploaded_file($tmp_name,$dist);
    }
    return $dist;
}

// Get all users
function getAllUsers()
{
    // Подключение
    $link = Db();

    $query = 'SELECT * from `users` ';

    $users = $link->query($query);

    return $users->fetch_all(MYSQLI_ASSOC);
}

// Update current user info
function updateUserInfo($get,$post = null,$files = null)
{
    // Подключение
    $link = Db();

    // Данные из гет запроса
    $id = $get['id'];
    $requestType = $get['user'];


    // Данные из пост запроса

    $username = $post['username'];
    $job_title = $post['job_title'];
    $phone_number = $post['phone_number'];
    $address = $post['address'];
    $email = $post['email'];
    $password = md5($post['password']);
    $status = $post['status'];
    $avatar = avatarUser($files['avatar']);
    $soc_vk = $post['soc_vk'];
    $soc_tg = $post['soc_tg'];
    $soc_inst = $post['soc_inst'];

    switch($requestType){
        case 'edit':
            $query = "UPDATE users SET username='$username',job_title='$job_title', phone_number='$phone_number',address='$address' WHERE id=".$id;
        break;
        case 'secure':
            $query = "UPDATE users SET email='$email',password='$password' WHERE id=".$id;
        break;
        case 'status':
            $query = "UPDATE users SET status='$status' WHERE id=".$id;
        break;
        case 'avatar':
            $oldlink = getAvatarLink($id);
            if(file_exists($oldlink['avatar'])){
                unlink($oldlink['avatar']);
            }
            $query = "UPDATE users SET avatar='$avatar' WHERE id=".$id;
        break;
        case 'del':
            delUser($id);
        break;
    }

    if($query){
        $res = $link->query($query);
    }


    return $res;
}

// Получаем ссылку на аватара
function getAvatarLink($id)
{
    // Подключение
    $link = Db();

    // Выборка
    $query ='SELECT avatar FROM `users` WHERE `id`='.$id;

    // Запрос
    $res = $link->query($query);

    return $res->fetch_assoc();
}

// Получить все данные через id
function getUserInfo($id)
{
    // Подключение
    $link = Db();

    // Выборка
    $query ='SELECT * FROM `users` WHERE `id`='.$id;

    // Запрос
    $res = $link->query($query);

    return $res->fetch_assoc();
}

// Get User status
function getUserStatus($status)
{
    switch($status){
        case 'Online':
            $stat = 'status-success';
        break;
        case 'Busy':
            $stat = 'status-warning';
        break;
        case 'Away':
            $stat = 'status-danger';
        break;
    }

    return $stat;
}

// Delete one user
function delUser($id)
{
    $oldlink = getAvatarLink($id);
    if(file_exists($oldlink['avatar'])){
        unlink($oldlink['avatar']);
    }

    // Подключение
    $link = Db();

    $query = "DELETE FROM users WHERE id=".$id;

    $res = $link->query($query);
}