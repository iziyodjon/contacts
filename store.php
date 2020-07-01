<?
// Подключаю все функции
require_once ('libs/functions.php');


// Собираем все данные из поста
if(!empty($_POST['username']) and !empty($_POST['email']))
{
    $username = $_POST['username'];
    $job_title = $_POST['job_title'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    $soc_vk = $_POST['soc_vk'];
    $soc_tg = $_POST['soc_tg'];
    $soc_inst = $_POST['soc_inst'];
    $avatar = $_FILES['avatar'];


    // Добавить нового контакта
    $user_id = addUser($email,$password);

    // Редактировать профайл контакта
    changeProfile($username,$job_title,$phone_number,$address,$status,$user_id);

    // Редактировать соц сайты контакта
    changeSocials($soc_vk, $soc_tg, $soc_inst, $user_id);

    // Редактировать аватар контакта
    changeAvatar($avatar,$user_id);

    header('Location: /');
    exit;
}

?>