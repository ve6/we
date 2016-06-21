<!DOCTYPE html>
<!-- saved from url=(0039)http://127.0.0.1/wq/install.php?refresh -->
<html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>安装系统 - 微擎 - 公众平台自助开源引擎</title>
		<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<style>
			html,body{font-size:13px;font-family:"Microsoft YaHei UI", "微软雅黑", "宋体";}
			.pager li.previous a{margin-right:10px;}
			.header a{color:#FFF;}
			.header a:hover{color:#428bca;}
			.footer{padding:10px;}
			.footer a,.footer{color:#eee;font-size:14px;line-height:25px;}
		</style>
		<!--[if lt IE 9]>
		  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body style="background-color:#28b0e4;">
		<div class="container">
			<div class="header" style="margin:15px auto;">
				<ul class="nav nav-pills pull-right" role="tablist">
					<li role="presentation" class="active"><a href="javascript:;">安装微擎系统</a></li>
					<li role="presentation"><a href="http://www.we7.cc/">微擎官网</a></li>
					<li role="presentation"><a href="http://bbs.we7.cc/">访问论坛</a></li>
				</ul>
				<img src="../style/install/install.php">
			</div>
			<div class="row well" style="margin:auto 0;">
				<div class="col-xs-3">
					<div class="progress" title="安装进度">
						<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
							75%
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							安装步骤
						</div>
						<ul class="list-group">
							<a href="javascript:;" class="list-group-item list-group-item-success"><span class="glyphicon glyphicon-copyright-mark"></span> &nbsp; 许可协议</a>
							<a href="javascript:;" class="list-group-item list-group-item-success"><span class="glyphicon glyphicon-eye-open"></span> &nbsp; 环境监测</a>
							<a href="javascript:;" class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-cog"></span> &nbsp; 参数配置</a>
							<a href="javascript:;" class="list-group-item"><span class="glyphicon glyphicon-ok"></span> &nbsp; 成功</a>
						</ul>
					</div>
				</div>
				<div class="col-xs-9">
						
	<form class="form-horizontal" method="post" role="form">

		<div class="panel panel-default">
			<div class="panel-heading">数据库选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库主机</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[server]" value="127.0.0.1">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库用户</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[username]" value="root">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[password]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库端口</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[port]" value='3306'>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库名称</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[name]" value="we6">
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">管理选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">管理员账号</label>
					<div class="col-sm-4">
						<input class="form-control" type="username" name="user[username]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">管理员密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="password" name="user[password]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">确认密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="password" "="">
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="do" id="do">
		<ul class="pager">
			<li class="previous"><a href="javascript:;" onclick="$(&#39;#do&#39;).val(&#39;back&#39;);$(&#39;form&#39;)[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
			<li class="previous"><a href="javascript:;" onclick="if(check(this)){jQuery('#do').val('continue');$(this).attr('href','index.php?r=install/four')}">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
		</ul>
	</form>
	<script>
		var lock = false;
		function check(obj) {
			if(lock) {
				return;
			}
			$('.form-control').parent().parent().removeClass('has-error');
			var error = false;
			$('.form-control').each(function(){
				if($(this).val() == '') {
					$(this).parent().parent().addClass('has-error');
					this.focus();
					error = true;
				}
			});
			if(error) {
				alert('请检查未填项');
				return false;
			}
			if($(':password').eq(0).val() != $(':password').eq(1).val()) {
				$(':password').parent().parent().addClass('has-error');
				alert('确认密码不正确.');
				return false;
			}
			$.post('index.php?r=install/check',{
				'db_server':$('input[name="db[server]"]').val(),
				'db_username':$('input[name="db[username]"]').val(),
				'db_password':$('input[name="db[password]"]').val(),
				'db_port':$('input[name="db[port]"]').val(),
				'db_name':$('input[name="db[name]"]').val(),
				'user_username':$('input[name="user[username]"]').val(),
				'user_password':$('input[name="user[password]"]').val()
			},function(data){
				if(data==123){
					location.href='index.php?r=login/index';
				}else{
					alert('链接不到数据库');
					lock = false;
				}
			})
			return lock;
			
			
			
		}
	</script>
				</div>
			</div>
			<div class="footer" style="margin:15px auto;">
				<div class="text-center">
					<a href="http://www.we7.cc/">关于微擎</a> &nbsp; &nbsp; <a href="http://bbs.we7.cc/">微擎帮助</a> &nbsp; &nbsp; <a href="http://www.we7.cc/">购买授权</a>
				</div>
				<div class="text-center">
					Powered by <a href="http://www.we7.cc/"><b>微擎</b></a> v0.7 ? 2014 <a href="http://www.we7.cc/">www.we7.cc</a>
				</div>
			</div>
		</div>
		<script src="../style/install/jquery.min.js"></script>
		<script src="../style/install/bootstrap.min.js"></script>
	
</body></html>