<!DOCTYPE html>
<!-- saved from url=(0046)http://1.wqing7.applinzi.com/wq/menu.php?act=& -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">

<title>微擎 - 微信公众平台自助引擎 -  Powered by WE7.CC</title>
<meta name="keywords" content="微擎,微信,微信公众平台">
<meta name="description" content="微信公众平台自助引擎，简称微擎，微擎是一款免费开源的微信公众平台管理系统。">


<script type="text/javascript" src="../style/menu/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../style/menu/bootstrap.js"></script>
<script type="text/javascript" src="../style/menu/common(2).js"></script>
<script type="text/javascript" src="../style/menu/emotions.js"></script>

<!--[if IE 7]>
<link rel="stylesheet" href="./resource/style/font-awesome-ie7.min.css">
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="./resource/style/bootstrap-ie6.min.css">
<link rel="stylesheet" type="text/css" href="./resource/style/ie.css">
<![endif]-->
</head>
<body>
<script type="text/javascript" src="../style/menu/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript">
alert($)
	$(function(){
		
		/*设置url地址隐藏*/
		$('.close').click(function(){
			alert(123)
			$(".addurl").hide();
		})
		
	});
	function addMenu() {
		if($('.mlist .hover').length >= 3) {
			return;
		}
		var html = '<tr class="hover">'+
						'<td>'+
							'<div>'+
								'<input type="text" class="span4" value=""> &nbsp; &nbsp; '+								
								'<a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作">w</a> &nbsp; '+
								'<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单">×</a> &nbsp; '+
								'<a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign" title="添加菜单">+</a> '+
							'</div>'+
							'<div class="smlist"></div>'+
						'</td>'+
					'</tr>';
		$('tbody.mlist').append(html);
	}
	function addSubMenu(o) {
		if(o.find('div').length >= 5) {
			return;
		}
		var html = '' +
				'<div style="margin-top:20px;padding-left:80px;background:url(\'./resource/image/bg_repno.gif\') no-repeat -245px -545px;">'+
					'<input type="text" class="span3" value=""> &nbsp; &nbsp; '+		
					'<a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="设置此菜单动作">e</a> &nbsp; '+
					'<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单">×</a> '+
				'</div>';
		o.append(html);
	}
	function deleteMenu(o) {
		if($(o).parent().parent().hasClass('smlist')) {
			$(o).parent().remove();
		} else {
			$(o).parent().parent().parent().remove();
		}
	}
	function setMenuAction(o) {
		alert('e')
		
		$(".addurl").show();
		
	}
	function saveMenuAction(e) {
		var o = currentEntity;
		var t = $(':radio:checked').val();
		t = t == 'url' ? 'url' : 'forward';
		if(o == null) return;
		$(o).data('do', t);
		$(o).data('url', $('#ipt-url').val());
		$(o).data('forward', $('#ipt-forward').val());
	}
	
	/*保存菜单*/
	function saveMenu() {
		var ipt_url = $('#ipt-url').val();
		alert(ipt_url)
		
	}
	
	/*刷新*/
	function refresh()
	{
		alert('刷新成功！')
		location.href="index.php?r=menu/index";
	}
</script>
<style type="text/css">
	.table-striped td{padding-top: 10px;padding-bottom: 10px}
	a{font-size:14px;}
	a:hover, a:active{text-decoration:none; color:red;}
	.hover td{padding-left:10px;}
	
	body{
            position: relative;
        }
       
	.addurl{
		position:absolute;
		top: 250px;
        left: 550px;
		width : 500px;
		height: 500px;
		z-index: 1000000;
		display: none;
	}
</style>
<div class="templatemo-content-container">
	<div class="templatemo-content-widget white-bg">
		<h4>菜单设计器 <small>编辑和设置微信公众号码, 必须是服务号才能编辑自定义菜单。</small></h4>
		<table class="tb table-striped">
			<tbody class="mlist ui-sortable">
				<?php if($menu){ ?>
						<tr class="hover" data-do="view" data-url="" data-forward="">
					<td>
						<div>
							<input type="text" class="span4" value="菜单"> &nbsp; &nbsp;							
							<a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作">w</a> &nbsp;
							<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单">×</a> &nbsp;
							<a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign">+</a>
						</div>
						<div class="smlist ui-sortable">
																					<div style="margin-top:20px;padding-left:80px;background:url(&#39;./resource/image/bg_repno.gif&#39;) no-repeat -245px -545px;" data-do="view" data-url="https://www.baidu.com/" data-forward="">
								<input type="text" class="span3" value="搜索"> &nbsp; &nbsp;
								<a href="javascript:;" class="icon-move"></a> &nbsp;
								<a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit">e</a> &nbsp;
								<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign">×</a>
							</div>
														<div style="margin-top:20px;padding-left:80px;background:url(&#39;./resource/image/bg_repno.gif&#39;) no-repeat -245px -545px;" data-do="view" data-url="http://v.qq.com/" data-forward="">
								<input type="text" class="span3" value="视频"> &nbsp; &nbsp;
								<a href="javascript:;" class="icon-move"></a> &nbsp;
								<a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit">e</a> &nbsp;
								<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign">×</a>
							</div>
														
																				</div>
					</td>
				</tr>
						<?php }else{ ?>
									<tr class="hover" data-do="forward" data-url="" data-forward="V1001_TODAY_MUSIC">
					<td>
						<div>
							<input type="text" class="span4" value=""> &nbsp; &nbsp;
							<a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作">w</a> &nbsp;
							<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单">×</a> &nbsp;
							<a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign">+</a>
						</div>
						<div class="smlist ui-sortable">
													</div>
					</td>
				</tr>
						<?php } ?>
				
				
									</tbody>
		</table>
		<div class="well well-small" style="margin-top:20px;">
			<a href="javascript:;" onclick="addMenu();">添加菜单</a>
		</div>

		<h4>操作 <small>设计好菜单后再进行保存操作</small></h4>
		<table class="tb">
			<tbody>
				<tr>
					<td>
						<input type='hidden' id='pub_id' value='<?php echo $pub_id ?>'/>
						<input type="button" value="保存菜单结构" class="templatemo-blue-button" onclick="saveMenu();">
						<span class="help-block">保存当前菜单结构至公众平台, 由于缓存可能需要在24小时内生效</span>
					</td>
				</tr>
				
				<tr>
					<td>
						<input type="button" value="刷新" class="templatemo-blue-button" onclick="refresh()">
						<div class="help-block">重新从公众平台获取菜单信息</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div id="dialog" class="addurl">

	<div class="well">
	<button type="button" class="close">×</button>
	<h3>选择要执行的操作</h3>
		<label class="radio inline">
			<span>链接:</span>
			
		</label>
		<input class="ipt-url" id="ipt-url" type="text" value="http://">
	
	</div>
		
</div>

	
</body></html>