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

			//read from database
			$query = "select * from hospitalsignup where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.html");
						die;
					}
				}
			}
			
			echo '<h1 style="font-weight: bold ; text-align: center; position: fixed; top: 0; left: 50%; transform: translateX(-50%); background-color: black; color: white; padding: 15px; margin-top:10px;border-radius:5px;">Invalid Username or Password. Please try again.</h1>';
		}else
		{
			echo '<h1 style="font-weight: bold; text-align: center; position: fixed; top: 0; left: 50%; transform: translateX(-50%); background-color: #f44336; color: white; padding: 10px;">Invalid Username or Password. Please try again.</h1>';
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basit Health Hub-Login</title>
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
<body><div class="signup_form">
        <form method="post">
			<div class="top-heading">Login</div>
			<label for="user_name" style="margin-top: 30px;">Name/mail</label>
			<input id="text" type="text" name="user_name"><br>
			<label for="user_name">Password</label>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<div class="login_btn">
                <p>Don't have an Account?</p>
                <a href="signup.php">Sign up</a>
                
            </div>
		</form>
		</div>
</body>
</html>