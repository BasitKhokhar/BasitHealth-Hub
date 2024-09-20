<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<style>
        html{
    font-size: 62.5%;
    scroll-behavior: smooth;
}
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;  
}
        body{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family:'Source Sans 3', sans-serif;
}
        .signup_form{
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* background-image: url("img/19373.jpg"); */
            background-color:#051b28;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
		form{
			
            display: flex;
            flex-direction: column;
            border: .1rem solid #00b2c2;
            border-radius: 1rem;
            background-color: #072c41;
            width: 25%;
            box-shadow: 0rem 0 1rem .5rem #00b2c2;
		}
        .top-heading{
            font-size: 5rem;
            color:white;
            text-align: center;
            border-radius: 1rem 1rem 0 0;
            font-weight: bold;
            padding: 1rem 3rem;
            border-bottom: .1rem solid white;
        }
        .signup_form label{
            font-size: 2rem;
            margin: .5rem 2rem;
            color:white;
        }
        .signup_form input[type=text]{
            font-size: 1.5rem;
            margin: .5rem 2rem;
            padding: .5rem;
        }
        .signup_form input[type=password]{
            font-size: 1.5rem;
            margin: .5rem 2rem;
            padding: .5rem;
        }
        #button{
            
            background-color: #00b2c2;
            /* background-image: linear-gradient(#00b2c2,#051b28); */
            width: 90%;
            margin: auto;
            font-size: 2rem;
            font-weight: 600;
            color: white;
            padding: 1rem 2rem;
            border-radius: .5rem;
            transition: .5s;
            border: none;
            opacity: 1;
			margin: 2rem auto;
        }
        #button:hover{
            opacity: .7;
        }
        .login_btn{
            display: flex;
            flex-direction:row;
            gap:.5rem;
            /* justify-content: space-between; */
            margin: 1rem 2rem;
            margin-bottom: 2rem;
            
            padding:0;
        }
        .login_btn > p{
            font-size:1.5rem;
            color:white;
            margin-top:.3rem;
        }
        
        a{
         color: #00b2c2;
         text-decoration: none; 
         font-weight: bold;
         font-size:2rem;   
        }
        a:hover{
            color:white;
        }
       
	</style>
</head>
<body>
<div class="signup_form">
        <form action="#" method="post" onsubmit="return validation()" id="register1">
			<div class="top-heading">Signup</div>
            <label for="user_name" style="margin-top: 30px;">Name/mail</label>
			<input id="text" type="text" name="user_name"><br>
            <span id="errormessagefullname" style="color:red"></span><br>
            <label for="user_name">Password</label>
			<input id="text" type="password" name="password"><br>
            <span id="password-strength-msg" style="color: red;"></span><br><br>

			<input id="button" type="submit" value="Signup"><br><br>
            <div class="login_btn">
                <p>Already have an Account?</p>
                <a href="login.php">Login</a>  
            </div>
		</form>
    </div>

</body>
</html>

<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];


		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
             // Check for password length
            if (strlen($password) < 8) {
                echo '<h1 style="font-weight: bold ; text-align: center; position: fixed; top: 0; left: 50%; transform: translateX(-50%); background-color: black; color: white; padding: 15px; margin-top:10px;border-radius:5px;">Password must contain atleast 8 characters</h1>';
                exit; // Exit script if validation fails
            }
              // Check for uppercase letters
            if (!preg_match('/[A-Z]/', $password)) {
                echo '<h1 style="font-weight: bold ; text-align: center; position: fixed; top: 0%; left: 50%; transform: translateX(-50%); background-color: black; color: white; padding: 15px; margin-top:10px;border-radius:5px;">Password must contain atleast one uppercase</h1>';
                exit;
            }

    // Check for lowercase letters
            if (!preg_match('/[a-z]/', $password)) {
                echo '<h1 style="font-weight: bold ; text-align: center; position: fixed; top: 0%; left: 50%; transform: translateX(-50%); background-color: black; color: white; padding: 15px; margin-top:10px;border-radius:5px;">Password must contain atleast one lowercase</h1>';
                exit;
            }

    // Check for numbers
            if (!preg_match('/[0-9]/', $password)) {
                echo '<h1 style="font-weight: bold ; text-align: center; position: fixed; top: 0; left: 50%; transform: translateX(-50%); background-color: black; color: white; padding: 15px; margin-top:10px;border-radius:5px;">Password must contain atleast one number</h1>';
                exit;
            }

    // Check for special characters
            if (!preg_match('/[\W_]/', $password)) {
                echo '<h1 style="font-weight: bold ; text-align: center; position: fixed; top: 0; left: 50%; transform: translateX(-50%); background-color: black; color: white; padding: 15px; margin-top:10px;border-radius:5px;">Password must contain atleast one special characters</h1>';
                exit;
            }

			//save to database
			$user_id = random_num(20);
			$query = "insert into hospitalsignup (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>

