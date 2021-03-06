<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OSS</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0-1/css/all.css' integrity='sha512-mTC7iR2ieVWg5BvRtvEIBMk7T4rlhZHIItwOQWrvnR2eDDhavS/6TAP5ANsjnOQK4iZJVjR1XhcLFtgZuhQ1Jg==' crossorigin='anonymous'/>
    <style>
        
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
	box-sizing: border-box;
}

body {
	background: #f6f5f7;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
	height: 100vh;
	margin: -20px 0 50px;
}

h1 {
	font-weight: bold;
	margin: 0 ;
}

h2 {
	text-align: center;
}

p {
	font-size: 14px;
	font-weight: 100;
	line-height: 20px;
	letter-spacing: 0.5px;
	margin: 20px 0 30px;
}

span {
	font-size: 12px;
	margin-bottom: 1rem;
}

a {
	color: #333;
	font-size: 14px;
	text-decoration: none;
	margin: 15px 0;
}

button {
	border-radius: 20px;
	border: 1px solid #7cdefc;
	background-color: #1be4ff;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
	cursor: pointer;
}

button:active {
	transform: scale(0.95);
}

button:focus {
	outline: none;
}

button.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}

form {
	background-color: #FFFFFF;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 50px;
	height: 100%;
	text-align: center;
}

input {
	background-color: #eee;
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
}

.container {
	background-color: #fff;
	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	overflow: hidden;
	width: 768px;
	max-width: 100%;
	min-height: 480px;
}

.form-container {
	position: absolute;
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
}

.sign-in-container {
	left: 0;
	width: 50%;
	z-index: 2;
}

.container.right-panel-active .sign-in-container {
	transform: translateX(100%);
}

.sign-up-container {
	left: 0;
	width: 50%;
	opacity: 0;
	z-index: 1;
}

.container.right-panel-active .sign-up-container {
	transform: translateX(100%);
	opacity: 1;
	z-index: 5;
	animation: show 0.6s;
}

@keyframes show {
	0%, 49.99% {
		opacity: 0;
		z-index: 1;
	}
	
	50%, 100% {
		opacity: 1;
		z-index: 5;
	}
}

.overlay-container {
	position: absolute;
	top: 0;
	left: 50%;
	width: 50%;
	height: 100%;
	overflow: hidden;
	transition: transform 0.6s ease-in-out;
	z-index: 100;
}

.container.right-panel-active .overlay-container{
	transform: translateX(-100%);
}

.overlay {
	background-color: #8EC5FC;
	background-image: linear-gradient(62deg, #0682ff 0%, #774ca0 100%);
	background-repeat: no-repeat;
	background-size: cover;
	background-position: 0 0;
	color: #FFFFFF;
	position: relative;
	left: -100%;
	height: 100%;
	width: 200%;
  	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
  	transform: translateX(50%);
}

.overlay-panel {
	position: absolute;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 40px;
	text-align: center;
	top: 0;
	height: 100%;
	width: 50%;
	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.overlay-left {
	transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
	transform: translateX(0);
}

.overlay-right {
	right: 0;
	transform: translateX(0);
}

.container.right-panel-active .overlay-right {
	transform: translateX(20%);
}

.social-container {
	margin: 20px 0;
}

.social-container a {
	border: 1px solid #DDDDDD;
	border-radius: 50%;
	display: inline-flex;
	justify-content: center;
	align-items: center;
	margin: 0 5px;
	height: 40px;
	width: 40px;
}

.text-danger{
	color: red;
}

footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
}

footer i {
    color: red;
}

footer a {
    color: #3c97bf;
    text-decoration: none;
}
.alert {
  width: 100%;
  margin: 20px auto;
  padding: 15px;
  position: relative;
  border-radius: 5px;
  box-shadow: 0 0 15px 5px #ccc;
  font-size: 13px;
}

.close {
  position: absolute;
  width: 30px;
  height: 30px;
  opacity: 0.5;
  border-width: 1px;
  border-style: solid;
  border-radius: 50%;
  right: 15px;
  top: 25px;
  text-align: center;
  font-size: 1.6em;
  cursor: pointer;
}

.simple-alert {
  background-color: #ebebeb;
  border-left: 5px solid #6c6c6c;
}
.simple-alert .close {
  border-color: #6c6c6c;
  color: #6c6c6c;
}

.success-alert {
  background-color: #a8f0c6;
  border-left: 5px solid #178344;
}
.success-alert .close {
  border-color: #178344;
  color: #178344;
}

.danger-alert {
  background-color: #f7a7a3;
  border-left: 5px solid #8f130c;
}
.danger-alert .close {
  border-color: #8f130c;
  color: #8f130c;
}

.warning-alert {
  background-color: #ffd48a;
  border-left: 5px solid #8a5700;
}
.warning-alert .close {
  border-color: #8a5700;
  color: #8a5700;
}
    </style>
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
			<h1>Daftar Akun</h1>
			{{-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> --}}
			<span>Masukan data diri anda</span>
			<input type="text" name="nip" placeholder="NIP" required onkeypress='validate(event)'/>
			@if ($errors->has('nip'))
				<span class="text-danger">{{ $errors->first('nip') }}</span>
			@endif
			<input type="text" name="nama" placeholder="Nama" required/>
			@if ($errors->has('nama'))
				<span class="text-danger">{{ $errors->first('nama') }}</span>
			@endif
			<input type="email" name="email" placeholder="Email" required/>
			@if ($errors->has('email'))
				<span class="text-danger">{{ $errors->first('email') }}</span>
			@endif
			<input type="password" name="password" placeholder="Password" required/>
			@if ($errors->has('password'))
				<span class="text-danger">{{ $errors->first('password') }}</span>
			@endif
			<button type="submit">Daftar</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
				@if (\Session::has('error'))
					<div class="alert danger-alert" role="alert">
						{!! \Session::get('error') !!}
					</div>
				@endif
            @csrf
			<h1>Login</h1>
			{{-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> --}}
			<span>Masukan NIP dan Password anda</span>
			<input type="text" name="nip" placeholder="NIP" onkeypress='validate(event)' required/>
			<input type="password" name="password" placeholder="Password" required/>
			<button type="submit">Login</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Sign Up</h1>
				<p>Daftarkan Akun anda, untuk login</p>
				<button class="ghost" id="signIn">Login</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Login</h1>
				<p>Silahkan login untuk masuk ke dashboard</p>
				<button class="ghost" id="signUp">Daftar</button>
			</div>
		</div>
	</div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==' crossorigin='anonymous'></script>
<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }

	$(document).ready(function () {
        setTimeout(function () {
            $(".alert").fadeOut(1500);
        }, 3000);
    });
</script>

</body>
</html>