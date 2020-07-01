<?php
require_once ('Db.php');


// debug array
function dd($data)
{
    if(!empty($data) or isset($data))
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

// Добавить новый контакт
function addUser($email,$password){

    // Подключения к БД
    $pdo = PDO();

    // Если email and password то уже работаем
    if(!empty($email) and !empty($password))
    {
        $email = htmlspecialchars($email);
        $password = password_hash($password,PASSWORD_DEFAULT);

        $data = [
            'email' => $email,
            'password' => $password
        ];

        $sql = "INSERT INTO users (email,password) VALUES (:email,:password)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $user_id =  $pdo->lastInsertId();

    }

    return $user_id;
}

// Изменить профайл контакта
function changeProfile($username, $job_title, $phone_number, $address, $status, $user_id)
{
    // Подключения к БД
    $pdo = PDO();

    // Если user_id то уже работаем
    if(!empty($user_id))
    {

        $username = htmlspecialchars($username);
        $job_title = htmlspecialchars($job_title);
        $phone_number = htmlspecialchars($phone_number);
        $address = htmlspecialchars($address);
        $status = htmlspecialchars($status);

        $data = [
            'username' => $username,
            'job_title' => $job_title,
            'phone_number' => $phone_number,
            'address' => $address,
            'status' => $status,
            'user_id' => $user_id,
        ];

        $sql = "INSERT INTO profile (user_id) VALUES (:user_id);";
        $sql .= "UPDATE profile SET 
                            username =:username, 
                            job_title =:job_title, 
                            phone_number =:phone_number, 
                            address =:address, 
                            status =:status 
                            WHERE user_id =:user_id;"
        ;

        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }
}

// Изменить соц сайты
function changeSocials($soc_vk,$soc_tg,$soc_inst,$user_id)
{
    // Подключения к БД
    $pdo = PDO();

    // Если user_id то уже работаем
    if(!empty($user_id))
    {
        $soc_vk = htmlspecialchars($soc_vk);
        $soc_tg = htmlspecialchars($soc_tg);
        $soc_inst = htmlspecialchars($soc_inst);

        $data = [
            'soc_vk' => $soc_vk,
            'soc_tg' => $soc_tg,
            'soc_inst' => $soc_inst,
            'user_id' => $user_id,
        ];

        $sql = "INSERT INTO socials (user_id) VALUES (:user_id);";
        $sql .= "UPDATE socials SET soc_vk =:soc_vk,soc_tg =:soc_tg,soc_inst =:soc_inst WHERE user_id =:user_id;";

        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }
}

// Изменить аватар контакта
function changeAvatar($files,$user_id)
{
    // Подключения к БД
    $pdo = PDO();

    // Если user_id то уже работаем
    if(!empty($user_id))
    {



        $orig_name = $files['name'];
        $tmp_name = $files['tmp_name'];
        $type = $files['type'];
        $size = $files['size'];


        if($type == 'image/jpeg' and $size <= 1024 * 1024)
        {
            $split = explode('.',strtolower($orig_name));
            $name = $split[0];
            $ext = $split[1];
            $changed_name = $name . uniqid() . '.'. $ext;
            $dist = 'uploads/'. $changed_name;

            $data = [
                'dist' => $dist,
                'user_id' => $user_id,
            ];

            $sql = "INSERT INTO avatars (user_id) VALUES (:user_id);";
            $sql .= "UPDATE avatars SET avatar =:dist WHERE user_id =:user_id;";

            $stmt= $pdo->prepare($sql);
            $stmt->execute($data);

            move_uploaded_file($tmp_name,$dist);
        }


    }
}


// Get all users
function getAllUsers()
{
    // Подключения к БД
    $pdo = PDO();


    $sql = "SELECT 
              users.id,
              users.email,
              profile.user_id,
              profile.username,
              profile.job_title,
              profile.phone_number,
              profile.address,
              profile.status,
              avatars.user_id,
              avatars.avatar,
              socials.user_id,
              socials.soc_vk,
              socials.soc_tg,
              socials.soc_inst 
            FROM 
              users,
              profile,
              avatars,
              socials 
            WHERE 
              profile.user_id = users.id 
            AND 
              avatars.user_id = users.id 
            AND 
              socials.user_id = users.id;
    ";

    $stmt= $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Получить все данные через id
function getUserProfile($id)
{
    // Подключения к БД
    $pdo = PDO();

    // Выборка
    $sql ='SELECT * FROM `profile` WHERE `id`='.$id;

    $stmt= $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



// Изменить все данные через id
function setUserProfile($username, $job_title, $phone_number, $address, $user_id)
{
    // Подключения к БД
    $pdo = PDO();

    // Если user_id то уже работаем
    if(!empty($user_id))
    {

        $username = htmlspecialchars($username);
        $job_title = htmlspecialchars($job_title);
        $phone_number = htmlspecialchars($phone_number);
        $address = htmlspecialchars($address);
        $user_id = htmlspecialchars($user_id);

        $data = [
            'username' => $username,
            'job_title' => $job_title,
            'phone_number' => $phone_number,
            'address' => $address,
            'user_id' => $user_id
        ];

        $sql = "UPDATE profile SET 
                            username =:username, 
                            job_title =:job_title, 
                            phone_number =:phone_number, 
                            address =:address
                            WHERE user_id =:user_id;"
        ;

        $stmt= $pdo->prepare($sql);
        header('Location: /');
        return $stmt->execute($data);

    }

}

function getSecure($id)
{
    // Подключения к БД
    $pdo = PDO();

    // Выборка
    $sql ='SELECT id,email,password FROM `users` WHERE `id`='.$id;

    $stmt= $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function setSecure($email,$password,$id)
{
    // Подключения к БД
    $pdo = PDO();

    // Выборка
    //$sql ='SELECT id,email,password FROM `users` WHERE `id`='.$id;
    $sql ="UPDATE users SET email='$email',password='$password' WHERE id=".$id;

    $stmt= $pdo->prepare($sql);
    header('Location: /');
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getStatus($id)
{
    // Подключения к БД
    $pdo = PDO();

    // Выборка
    $sql ='SELECT status FROM `profile` WHERE `user_id`='.$id;

    $stmt= $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function setStatus($status,$id)
{
    // Подключения к БД
    $pdo = PDO();

    // Выборка
    $sql ="UPDATE profile SET status='$status' WHERE user_id=".$id;

    $stmt= $pdo->prepare($sql);
    header('Location: /');
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
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

function getAvatar($id)
{
    // Подключения к БД
    $pdo = PDO();

    // Выборка
    $sql ='SELECT * FROM `avatars` WHERE `user_id`='.$id;

    $stmt= $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function setAvatar($files,$id)
{
    // Подключения к БД
    $pdo = PDO();

    $oldlink =getAvatarLink($id);
    $oldlink =$oldlink['avatar'];
    $orig_name = $files['name'];
    $tmp_name = $files['tmp_name'];
    $size = $files['size'];

    $split = explode('.',strtolower($orig_name));
    $name = $split[0];
    $ext = $split[1];
    $changed_name = $name . uniqid() . '.'. $ext;
    $dist = 'uploads/'. $changed_name;

    if(file_exists($oldlink)){
        unlink($oldlink);
        move_uploaded_file($tmp_name, $dist);
        // Выборка
        $sql ="UPDATE avatars SET avatar='$dist' WHERE user_id=".$id;

        $stmt= $pdo->prepare($sql);
        header('Location: /');
        $stmt->execute();
    }

}



// Получаем ссылку на аватара
function getAvatarLink($id)
{
    // Подключения к БД
    $pdo = PDO();

    $sql ='SELECT avatar FROM `avatars` WHERE `user_id`='.$id;

    $stmt= $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// Delete one user
function delUser($id)
{
    // Подключения к БД
    $pdo = PDO();

    $oldlink = getAvatarLink($id);
    if(file_exists($oldlink['avatar']) or !empty($id)){

        unlink($oldlink['avatar']);

        $sql = "DELETE FROM users WHERE id = ".$id .";";
        $sql .= "DELETE FROM socials WHERE user_id =".$id .";";
        $sql .= "DELETE FROM profile WHERE user_id = ".$id .";";
        $sql .= "DELETE FROM avatars WHERE user_id = ".$id .";";

        $stmt= $pdo->prepare($sql);
        header('Location: /');
        $stmt->execute();
    }




}