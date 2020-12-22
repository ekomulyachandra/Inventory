<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <div class="login-box">
		<form class="" role="form" action="" method="post">
        <h1>Login</h1>
        <div class="textbox">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" placeholder="Username" name="username" value="">
        </div>

        <div class="textbox">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" placeholder="Password" name="password" value="">
        </div>

        <input class="btn" type="submit" name="submit" value="Sign in">
		</form>
		
		<?php
		$koneksi=mysqli_connect("localhost","root","","db_iventory");
		if (isset($_POST['submit'])){
			$user=$_POST['username'];
			$pass=md5($_POST['password']);
			$login=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$user' AND password='$pass'");
			$cek=mysqli_num_rows($login);
			if ($cek==1){
			$data=mysqli_fetch_array($login);
			session_start();
				$_SESSION['user']=$data['username'];
				$_SESSION['level']=$data['level'];
				header('location:index.php');
			}
		else {
			echo "<script>alert('username dan password incorrect')</script>";
		}
		}
		?>
    </div>

</body>

</html>