<!DOCTYPE html>

<html> 
<head>
    <meta name="viewport" content="width=device-width" />
    <title>Sign Up</title>
    <link href="assets/stylesheets/lib/bootstrap.css" rel="stylesheet" />
    <link href="assets/stylesheets/lib/jquery-ui.css" rel="stylesheet" />
    <link href="assets/stylesheets/common.css" rel="stylesheet" />
    <link href="assets/stylesheets/signup_styles.css" rel="stylesheet" />
</head>
<body>
    <div>
        <?php if(!empty($status)) echo $status; ?>
    </div>
    <div id="label-welcome">
        <h2>Welcome to GlobalChat!</h2>
        <!-- <h4>Chào mừng các bạn đến với hệ thống hỏi đáp về HUST ELITECH</h4> -->
    </div>
    <div class="container right-panel-active" id="container">
        <div class="form-container sign-up-container">
            <form id="formSignUp" method="post" action="index.php?controller=users&action=signup">
                <h1>Create Account</h1>
                <input id="fullName" type="text" placeholder="Full name" name="full_name"/>
                <input id="userName" type="text" placeholder="Username" name="user_name"/>
                <input id="userPw" type="password" placeholder="Password" name="user_pw"/>
                <button id="btnSignUp" name="btn_signup">Sign Up</button>
            </form>
        </div>
        <!-- <div class="form-container sign-in-container">
            <form id="formLogin" method="post" action="index.php?controller=users&action=login">
                <h1>Sign in</h1>
                <input id="userNameLgin" type="text" placeholder="Username" name="user_name_lgin"/>
                <input id="userPwLgin" type="password" placeholder="Password" name="user_pw_lgin"/>
                <button id="btnLogin" name="btn_login">Sign In</button>
            </form>
        </div> -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/javascripts/lib/jquery-3.4.1.js"></script>
    <script src="assets/javascripts/lib/jquery-ui.js"></script>
    <script src="assets/javascripts/common/common.js"></script>
    <script src="assets/javascripts/signup_scripts.js"></script>
</body>
</html>