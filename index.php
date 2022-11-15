<?php
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == "student") {
		header("location: ./student/");
		exit();
	} else if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == "teacher") {
		header("location: ./teacher");
		exit();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div class="logo">
        <img src="./files/images/project-logo.png" alt="Logo">
    </div>

    <div class="heading">
        <div class="h1">Manage your assignments with</div>
        <div class="h2">SNS</div>
        <div class="h3">Assignment Management System</div>
    </div>

    <div class="login">
        <div class='login-btn'>Login</div>

        <div class="ask">
            <div class='opt teacher'><a href='./teacher/login/'>Teacher</a></div>
            <div class='opt student'><a href='./student/login/'>Student</a></div>
        </div>
    </div>
</body>

</html>








<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-image: url('./files/images/bg5.jpg');
    background-size: cover;
    min-width: 100vh;
    overflow-x: hidden;
}

.logo {
    position: absolute;
    width: 230px;
    height: 230px;
    top: 200px;
    left: 250px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: inset  0 0 100px 50px rgba(225, 225, 225, 0.7), 0 0 10px 3px #000;
}

.logo img {
    width: 200px;
    height: 200px;
}

.heading {
    position: absolute;
    top: 25%;
    left: 25%;
    font-size: 30px;
    color: #fff;
    width: 50vw;
    margin: auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-top: 50px;
}

.heading div {
    width: 100%;
    text-align: center;
    font-weight: bold;
}

.h2 {
    font-family: 'Brush Script MT', cursive;
    font-size: 50px;
    margin: 20px 0 0 0;
    letter-spacing: 10px;
}

.h1, .h3 {
    font-family: 'Courier New', monospace;
}

.h3 {
    text-decoration: underline;
}

.login {
    width: 100px;
    margin-left: 100%;
    transform: translateX(-160px);
    margin-top: 20px;
}

.login-btn {
    background-color: #777;
    color: #000;
    font-size: 20px;
    font-weight: bold;
    display: flex;
    width: 100px;
    height: 40px;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.login-btn:hover {
    background-color: #555;
    color: #FFF;
}

.ask {
    width: 150px;
    font-size: 24px;
    display: none;
}

.ask div {
    padding: 10px;
    cursor: pointer;
}

.ask div:hover a {
    color: #FFF;
}

.opt {
    width: 100%;
    background-color: #777;
}

.opt a {
    color: #000;
    text-decoration: none;
    font-weight: bold;
}

.opt:hover {
    background-color: #555;
}

a:hover {
    color: #FFF;
}

</style>





<script>

document.querySelector('.login').addEventListener('mouseover', () => {
    document.querySelector('.ask').style.display = 'block';
    document.querySelector('.login-btn').style.backgroundColor = '#444';
    document.querySelector('.login-btn').style.color = '#FFF';
});

document.querySelector('.login').addEventListener('mouseout', () => {
    document.querySelector('.ask').style.display = 'none';
    document.querySelector('.login-btn').style.backgroundColor = '#777';
    document.querySelector('.login-btn').style.color = '#000';
});



</script>