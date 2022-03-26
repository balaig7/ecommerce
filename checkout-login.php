<?php
require_once "config.php";
$action = $_POST["action"];
if ($action == "register")
{
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $userName = mysqli_real_escape_string($conn, $_POST["user_name"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $checkLoginExists = dbQuery("SELECT * FROM `login` where user_name='" . $userName . "'"); //check if already exists
    if (empty($checkLoginExists))
    {
        $mobileOrPhone = filter_var($userName, FILTER_VALIDATE_EMAIL) ? "email" : "phone"; //find email or phone
        $createUser = mysqli_query($conn, "INSERT INTO `users`(name," . $mobileOrPhone . ",created_at)values('" . $name . "','" . $userName . "','" . date("Y-m-d h:i:s") . "')"); //create user
        if ($createUser)
        {
            $profileId = mysqli_insert_id($conn); //last inserted id
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //hash password
            $createLoginUser = mysqli_query($conn, "INSERT INTO `login`(profile_id,user_name,password,display_name,created_at)values('" . $profileId . "','" . $userName . "','" . $hashedPassword . "','" . $name . "','" . date("Y-m-d h:i:s") . "')");
            if ($createLoginUser)
            {
                $query = "SELECT id,display_name,profile_id,user_name,role,password FROM `login` where user_name='" . $userName . "'";
                $result = mysqli_query($conn, $query);
                $userData = mysqli_fetch_assoc($result);
                $billingDetails = mysqli_query($conn, 'SELECT address,city,country from `users` where id="' . $userData['profile_id'] . '" LIMIT 1');
                $billingDetailsData = mysqli_fetch_assoc($billingDetails);
                $_SESSION['active'] = true;
                $_SESSION['current_user'] = array_merge($userData, $billingDetailsData);

                sendResponse("success", "Account Registred Successfully");
            }
        }
    }
    else
    {
        sendResponse("warning", "User already Exists");
    }
}
elseif ($action = "login")
{
    $userName = mysqli_real_escape_string($conn, $_POST["user_name"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $query = "SELECT id,display_name,profile_id,user_name,role,password,status FROM `login` where user_name='" . $userName . "'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0)
    {
        $userData = mysqli_fetch_assoc($result);
        if (password_verify($password, $userData["password"]))
        {
            //check if user is active
            if ($userData['status'] == '1')
            {
                unset($userData["password"]);
                $billingDetails = mysqli_query($conn, 'SELECT address,city,country from `users` where id="' . $userData["profile_id"] . '" LIMIT 1');
                $billingDetailsData = mysqli_fetch_assoc($billingDetails);
                $_SESSION["current_user"] = array_merge($userData, $billingDetailsData);
                if ($_SESSION["current_user"]["role"] == "user")
                {
                    $_SESSION["active"] = true;
                    sendResponse("success", "Login success");
                }
                else
                {
                    session_destroy();
                }
            }
            else
            {
                sendResponse("error", "Sorry! your account has been temporarily blocked");

            }
        }
        else
        {
            sendResponse("error", "Incorrect Password");
        }
    }
    else
    {
        sendResponse("error", "Incorrect Username");
    }
}
?>
