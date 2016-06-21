
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
        <h1>[VE]</h1>
    </header>
    <form action="index.php?r=login/login" method="post" class="templatemo-login-form" onsubmit="return k_fun();">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                <input type="text" class="form-control" placeholder="用户名/邮箱/手机号" id="u_name"  name="u_name" onblur="k_name();">

            </div> <span id="a_name"></span>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
                <input type="password" class="form-control" placeholder="密码" id="u_pwd" name="u_pwd" onblur="k_pwd();">
            </div>	<span id="a_pwd"></span>
        </div>

        <div class="form-group">
            <div class="input-group">

                七天免登陆：<input type="checkbox" value="1" class="form-control"   name="qt" >
            </div>	<span id="a_pwd"></span>
        </div>

        <div class="form-group">

            <input type="submit" class="templatemo-blue-button width-100" value="登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;陆"/>
            <a href="index.php?r=login/register"><font color="#fb0006">没有账号？点击注册</font></a>

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
            $("#a_name").html("<font color='red'>账号不能为空</font>");
            return false;
        }else{
            $("#a_name").html("<font color='red'>√</font>");
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
    function k_fun()
    {
        if(k_name() & k_pwd())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>












