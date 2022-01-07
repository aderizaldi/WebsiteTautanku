<?php 
    session_start();
    require "fungsi.php";
    //cek session
    if(isset($_SESSION["login"])){
        $identified = $_SESSION["username"];
        header("Location: profile.php?user=$identified");
        exit();
    }

    //login
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($db, "SELECT * FROM user WHERE email = '$email'");

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])){
                $_SESSION["login"] = true;
                $_SESSION["username"] = $row["username"];
                $identified = $row["username"];

                header("Location: profile.php?user=$identified");
                exit;
            }
        }

        $error = true;
    }

    //register
    if (isset($_POST["signup"])) {
        if(registrasi($_POST)){
            echo "<script> alert('User baru berhasil ditambahkan!'); </script>";
            header("Location: login.php");
            exit();
        }
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon270501.ico">
	<title>TAUTANKU - Login</title>
	<style>
		*{
            padding: 0;
            margin: 0;
        }
        body{
            font-family: 'Quicksand',sans-serif;
            width: 100%;
            height: 100%;
            background-image: url('img/pattern270501.png');            
        }
        .container{
            color: white;
        	background-color: #063A5B;
        	height: 450px;
        	width: 40%;
        	margin: auto;
        	margin-top: 100px;
            border-radius: 20px;
            user-select: none;
        }
        .container h5{
            text-align: center;
            padding: 20px;
            font-size: 32px;
        }
        .register, .login {
            width: 60%;
            margin: auto;
        }
        .register ul li, .login ul li{
            list-style: none;
        }
        .register input, .login input{
            border-radius: 5px;
            border: 1px solid #063A5B;
            outline: 0px;
            height: 25px;
            width: 100%;
            padding: 5px;
        }
        .register button, .login button{
            background-color: #FF7A8B;
            border-radius: 8px;
            border-style: none;
            color: #FFFFFF;
            cursor: pointer;
            height: 40px;
            width: 100%;
            margin: 5px;
            margin-top: 20px;
            margin-bottom: 10px;
            outline: none;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: color 100ms;
            vertical-align: baseline;
            user-select: none;
            padding: 10px;
        }
        .register button:hover,
        .register button:focus {
            background-color: #F082AC;
        }
        .container p{
            text-align: center;
        }
        .container p a{
            color: #FF7A8B;
        }
        .back{
            width: 100px;
            position: absolute;
            top: 25px;
            right: 50px;
        }
        .back button{
            background-color: #063A5B;
            border-radius: 8px;
            border-style: none;
            color: #FFFFFF;
            cursor: pointer;
            height: 40px;
            width: 100px;
            outline: none;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: color 100ms;
            vertical-align: baseline;
            user-select: none;
            padding: 10px;
        }
	</style>
</head>
<body>
    <div class="pattern">
    <div class="back"><button type="button" onclick="window.location='index.php';">Back</button></div>
    <?php if(isset($_GET["signup"])){ ?>
    <div class="container">      
        <h5>SIGN UP</h5>
        <div class="register">
        <form action="" method="post">
            <ul>
                <li>
                    <label for="email">Email :</label><br>
                    <input type="email" name="email" id="email" placeholder="abcd@example.com" required>
                </li>
                <li>
                    <label for="username">Username :</label><br>
                    <input type="text" name="username" id="username" required>
                </li>
                <li>
                    <label for="password">Password : </label><br>
                    <input type="password" name="password" id="password" required>
                </li>
                <li>
                    <label for="password2">Confirm Password : </label><br>
                    <input type="password" name="password2" id="password2">
                </li>
            </ul>
            <button type="submit" name="register">Register</button>
        </form> 
        </div>
        <p>Already have account? <a href="login.php">Login</a></p>
    </div>
    <?php }else{ ?>
	<div class="container">    
        <h5>LOGIN</h5>
        <?php if(isset($error)){
           echo "<script> alert('Password atau email salah!'); </script>";
        } ?>
        <div class="login">
            <form action="" method="post">
            <ul>
                <li>
                    <label for="email">Email :</label><br>
                    <input type="email" name="email" id="email" placeholder="abcd@example.com" required>
                </li>
                <li>
                    <label for="password">Password : </label><br>
                    <input type="password" name="password" id="password" required>
                </li>
            </ul>
             <button type="submit" name="login">Login</button> 
            </form>
        </div>
        <p>Dont have an account? <a href="login.php?signup">Sign Up</a></p>
    </div>
    <?php } ?>
    </div>
</body>
</html>