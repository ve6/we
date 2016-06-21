
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visual Admin - Login</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href='http://fonts.useso.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../style/css/font-awesome.min.css" rel="stylesheet">
    <link href="../style/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/css/templatemo-style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="light-gray-bg">
<div class="templatemo-content-widget templatemo-login-widget white-bg">
    <header class="text-center">
        <div class="square"></div>
        <h1>注册</h1>
    </header>
    <form action="index.php?r=login/add" method="post" class="templatemo-login-form" onsubmit="return k_fun();">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</div>
                <input type="text" class="form-control" id="u_name"  name="u_name" onblur="k_name();">

            </div> <span id="a_name"></span>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">&nbsp;手机号&nbsp;</div>
                <input type="text" class="form-control" id="u_phone" name="u_phone" onblur="k_phone();">
            </div>  <span id="a_phone"></span>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</div>
                <input type="text" class="form-control" id="u_email" name="u_email" onblur="k_email();">
            </div>  <span id="a_email"></span>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</div>
                <input type="password" class="form-control" id="u_pwd" name="u_pwd" onblur="k_pwd();">
            </div>	<span id="a_pwd"></span>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">确认密码</div>
                <input type="password" class="form-control" id="u_upwd" name="u_upwd" onblur="k_upwd();">
            </div>  <span id="a_upwd"></span>
        </div>
        <div class="form-group">
            <input type="submit" class="templatemo-blue-button width-100" value="注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;册"/><br/><br/>
            <a href="index.php?r=login/index"><font color="#fb0006">已有账号？点击登陆</font></a>
        </div>
    </form>
</div>
<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
    <p><strong><a href='javascript:;'>Never give up!</a></strong></p>
</div>
</body>
</html>
<script src="../public/jquery-2.1.4.min.js"></script>
<script type="text/javascript">

    function k_name(){
        name=$("#u_name").val();
        if(name=="")
        {
            $("#a_name").html("<font color='red'>名称不能为空</font>");
            return false;
        }else{
            $("#a_name").html("<font color='red'>√</font>");
            return true;
        }
    }
    function k_phone(){
        phone=$("#u_phone").val();
        if(phone=="")
        {
            $("#a_phone").html("<font color='red'>手机号不能为空</font>");
            return false;
        }else{
            $("#a_phone").html("<font color='red'>√</font>");
            return true;
        }
    }
    function k_email(){
        email=$("#u_email").val();
        if(email=="")
        {
            $("#a_email").html("<font color='red'>邮箱不能为空</font>");
            return false;
        }else{
            $("#a_email").html("<font color='red'>√</font>");
            return true;
        }
    }

    function k_pwd(){
        pwd=$("#u_pwd").val();
        if(pwd=="")
        {
            $("#a_pwd").html("<font color='red'>密码不能为空</font>");
            return false;
        }else
        {
            $("#a_pwd").html("<font color='red'>√</font>");
            return true;
        }
    }
    function k_upwd(){
        upwd=$("#u_upwd").val();
        pwd=$("#u_pwd").val();
        if(upwd=="")
        {
            $("#a_upwd").html("<font color='red'>确认密码不能为空</font>");
            return false;

        }else{

            if(upwd!=pwd)
            {
                $("#a_upwd").html("<font color='red'>确认密码不一致</font>");
                return false;
            }else
            {
                $("#a_upwd").html("<font color='red'>√</font>");
                return true;
            }
        }

    }
    function k_fun()
    {
        if(k_name() & k_phone() & k_email() & k_pwd() & k_upwd())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>












