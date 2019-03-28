<?php
    require 'database.php';

    $emailError = $passwordError = $email = $password = "";
        
    if (!empty($_POST))
    {
        $email = checkInput($_POST['email']);
        $password = checkInput($_POST['password']);
        $isSuccess  = true;
         
        if (!IsEmail($email))
        {
            $emailError = "T'essaies de me rouler ? C'est pas un email ça";
            $isSuccess = false;
        }
        if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.\W).{8,}$#', $password))
        {
            //echo 'Mot de passe conforme';
        }
        else
        {
            //echo 'Mot de passe non coforme';
        }
        if($isSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare("SELECT * FROM `connexion` WHERE email=? AND password=?  ");
            $statement->execute(array($email,$password));
            header("Location: index.html");
            // if($connect=$statement->fetch())
            //  {
            //      die('connect');
            //      echo '$email';
            //      echo '$password';
            //  }
            //  else
            //  {
            //      die('mot de passe incorrect');
            //  }
            Database::disconnect();
        }
        
        echo json_encode($array);
    }

    function IsEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
    
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>eco-TRANSACTION</title>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <style>
            body
            {
                height: 250px;
                border: 1px solid beige;
                border-radius: 2px;
                margin: 80px;
                padding: 50px;
            }
            #create
            {
                float: left;
                border: 1px solid black;
            }
            #create h1
            {
                text-transform: uppercase;
            }
            #connect
            {
                float: right;
                /* text-align: center; */
                border: 1px solid black;
            }
            .button3
            {
                width: 40%;
                border: 1px solid #ddd;
                background: #ffa500;
                color: white;
                font-weight: bold;
                text-transform: uppercase;
                padding: 10px;
                border-radius: 2px;
                transition: all 0.3s ease-in 0s;
            }
        </style>
    </head>
    <body>
        <form id="create">
            <h1>Créer votre compte</h1>
            <input type="email" placeholder="email"><br><br>
            <button class="button3" type="submit">CONNEXION</button>
        </form>
        <form id="connect" action="connexion.php" method="post">
            <h1>CONNECTEZ-VOUS</h1>
            <label for="email"> Votre email</label>
            <input type="email" name="email" id="email"><br>
            <label for="login">Votre password</label>
            <input type="password" id="login" name="password" pattern=".{3,}" required title="8 caracteres minimum"><br><br>
            <button class="button3" type="submit">CONNEXION</button>
        </form>
    </body>
</html>