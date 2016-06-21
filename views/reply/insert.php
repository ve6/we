<div class="templatemo-content-container">
    <div class="templatemo-content-widget white-bg">
        <h2 class="margin-bottom-10">修改自动回复规则</h2>
        <p>Here goes another form and form controls.</p>
        <form action="index.php?r=reply/upd" class="templatemo-login-form" method="post" enctype="multipart/form-data">
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">
                    <label for="inputFirstName">规则名称</label>
                    <input type="text" name='p_title' class="form-control" id="inputFirstName" value="<?php echo $ar['p_title'];?>">
                </div>

            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">
                    <label for="inputUsername">关键字</label>
                    <input type="text" name='p_keysword' class="form-control" id="inputUsername" value="<?php echo $ar['p_keysword'];?>">
                </div>

            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">
                    <label for="inputNewPassword">回复内容</label>
                    <textarea class="form-control" id="inputNewPassword"  name="p_content"><?php echo $ar["p_content"]?></textarea>
                </div>

            </div>
            <div>
                <input type="hidden" name="id" value="<?php echo $ar['p_id'];?>"/>
                <button type="submit" class="templatemo-blue-button">Summit</button>
                <button type="reset" class="templatemo-white-button">Reset</button>
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
