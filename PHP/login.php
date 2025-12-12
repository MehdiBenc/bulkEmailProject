<?php
require 'connexion.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email invalide.";
    } else {
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            echo "Connexion réussie !";
            header("Location: main.php");
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
}
?>








<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

*{
    font-family: 'Poppins', sans-serif;
}
.wrapper{
    background: #ececec;
    padding: 0 20px 0 20px;
}
.main{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.side-image{
    background-image: url("../Images/Image_fx1.png");
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    border-radius: 10px 0 0 10px;
    position: relative;
}
.row{
    width:  900px;
    height:550px;
    border-radius: 10px;
    background: #fff;
    padding: 0px;
    box-shadow: 5px 5px 10px 1px rgba(0,0,0,0.2);
}
.right{
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}
.input-box{
    width: 330px;
    box-sizing: border-box;
}
img{
    width: 35px;
    position: absolute;
    top: 30px;
    left: 30px;
}
.input-box header{
    font-weight: 700;
    text-align: center;
    margin-bottom: 45px;
}
.input-field{
    display: flex;
    flex-direction: column;
    position: relative;
    padding: 0 10px 0 10px;
}
.input{
    height: 45px;
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    outline: none;
    margin-bottom: 20px;
    color: #40414a;
}
.input-box .input-field label{
    position: absolute;
    top: 10px;
    left: 10px;
    pointer-events: none;
    transition: .5s;
}
.input-field input:focus ~ label{
    top: -10px;
    font-size: 13px;
}
.input-field input:valid ~ label{
    top: -10px;
    font-size: 13px;
    color: #5d5076;
}
.input-field .input:focus, .input-field .input:valid{
    border-bottom: 1px solid #2a5892;
}
.submit{
    border: none;
    outline: none;
    height: 45px;
    background: #ececec;
    border-radius: 5px;
    transition: .4s;
}
.submit:hover{
    background: rgba(37, 95, 156, 0.937);
    color: #fff;
}
.signin{
    text-align: center;
    font-size: small;
    margin-top: 25px;
}
span a{
    text-decoration: none;
    font-weight: 700;
    color: #000;
    transition: .5s;
}
span a:hover{
    text-decoration: underline;
    color: #000;
}

@media only screen and (max-width: 768px){
    .side-image{
        border-radius: 10px 10px 0 0;
    }
    img{
        width: 35px;
        position: absolute;
        top: 20px;
        left: 47%;
    }
    .row{
        max-width:420px;
        width: 100%;
    }
}
.error-message {
    border: 1px solid red;
    background-color: #fdd;
    color: red;
    padding: 8px;
    margin-bottom: 10px;
    border-radius: 4px;
}

    </style>
    <title>Login</title>
</head>
<body>
<div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                
                <a href="../index.php"><img src="../Images/mail2.png"></a>
                
            </div>

            <div class="col-md-6 right">
                
                <div class="input-box">
                <header>Access your account</header>
                <form action="" method="post">
                <div class="input-field">
                        <input type="text" class="input" name="email" id="email" required="" autocomplete="off">
                        <label for="email">Email</label> 
                    </div> 
                <div class="input-field">
                        <input type="password" class="input" name="password" id="pass" required="">
                        <label for="pass">Password</label>
                    </div> 
                    <?php if (!empty($error)): ?>
                        <div class="error-message"><?php echo $error; ?></div>
                    <?php endif; ?>
                <div class="input-field">
                        
                        <input type="submit" class="submit" value="Log In">
                </div> 
                </form>
                <div class="signin">
                    <span>Don't have an account? <a href="signup.php">Sign up here</a></span>
                </div>
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>