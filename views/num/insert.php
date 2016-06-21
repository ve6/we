    <div class="templatemo-content-container">
        <div class="templatemo-content-widget white-bg">
            <h2 class="margin-bottom-10">
			<?php if($model){
				echo '修改';
			}else{
				echo '添加';
			} ?>公众号</h2>
            <p>Here goes another form and form controls.</p>
            <form action="index.php?r=num/<?= $model?'update':'add'?>" class="templatemo-login-form" method="post" enctype="multipart/form-data">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 form-group">
                        <label for="inputFirstName">公众号名称</label>
                        <input type="text" name='pub_name' class="form-control" id="inputFirstName" value='<?= isset($model['pub_name'])?$model['pub_name']:''; ?>'>
                    </div>
                </div>
				<?php if($model){ ?>
				<div class="row form-group">
                    <div class="col-lg-6 col-md-6 form-group">
                        <label for="inputNewPassword">接口路径</label>
                        <input type="text" class="form-control" id="inputNewPassword" value='http://1.wqing7.applinzi.com/we/ve.php?code=<?= $model['pub_code'] ?>' disabled='true'>
						<input type='hidden' value='<?= $model['pub_id'] ?>' name='pub_id'/>
                    </div>

                </div> 
				<div class="row form-group">
                    <div class="col-lg-6 col-md-6 form-group">
                        <label for="inputNewPassword">token</label>
                        <input type="text" class="form-control" id="inputNewPassword" value='<?= $model['pub_token']; ?>' disabled='true'>
                    </div>

                </div>
				<?php } ?>
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 form-group">
                        <label for="inputUsername">appID</label>
                        <input type="text" name='pub_appid' class="form-control" id="inputUsername" value='<?= isset($model['pub_appid'])?$model['pub_appid']:''; ?>'>
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 form-group">
                        <label for="inputNewPassword">AppSecret</label>
                        <input type="text" name='pub_appsecret' class="form-control" id="inputNewPassword" value='<?= isset($model['pub_appsecret'])?$model['pub_appsecret']:''; ?>'>
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 form-group">
                        <label for="inputNewPassword">微信号</label>
                        <input type="text" name='pub_num' class="form-control" id="inputNewPassword" value='<?= isset($model['pub_num'])?$model['pub_num']:''; ?>'>
                    </div>
                </div>
                <div>
                    <button type="submit" class="templatemo-blue-button">Summit</button>
                </div>




            </form>
        </div>
        <footer class="text-right">
            <p>Copyright &copy; 2084 Company Name
                | More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></p>
        </footer>
    </div>
</div>
</div>
