<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Main content -->

    <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class="table table-striped table-bordered templatemo-user-table"  style='text-align:center'>
                    <thead>
                    <tr>
                        <td><a href="" class="white-text templatemo-sort-by">公众号名称<span class="caret"></span></a></td>
                        <td><a href="" class="white-text templatemo-sort-by">appid<span class="caret"></span></a></td>
                        <td><a href="" class="white-text templatemo-sort-by">appsecret<span class="caret"></span></a></td>
                        <td><a href="" class="white-text templatemo-sort-by">微信号<span class="caret"></span></a></td>
                        <td colspan='4'>Operation</td>
                    </tr>
                    </thead>
                    <tbody>
					<?php if($models){
					 foreach ($models as $model) { ?>
						<tr>
							<td><?= $model['pub_name'] ?></td>
							<td><?= $model['pub_appid'] ?></td>
							<td><?= $model['pub_appsecret'] ?></td>
							<td><?= $model['pub_num'] ?></td>
							<td><a href="<?php echo Url::to(['num/edit']);?>&id=<?= $model['pub_id'] ?>" class="templatemo-edit-btn">Edit</a></td>
							<td><a href="<?php echo Url::to(['num/delete']);?>&id=<?= $model['pub_id'] ?>" class="templatemo-edit-btn">Delete</a></td>
							<td>
                                <?php 
                                    if(isset($_SESSION['id']) && $_SESSION['id']==$model['pub_id']){
                                        echo "<span>当前</span>";
                                    }else{
                                ?>
                                        <a href="<?php echo Url::to(['num/cut'])?>&id=<?= $model['pub_id'] ?>" class="templatemo-link">Switch</a>
                                <?php }?>
                            </td>
						</tr>
					<?php 
						} 
					}else{
					?>
						<tr>
							<td colspan='6' style='height:250px;line-height:250px;font-size:24px;text-align:center'><b>目前还没有公众号，请前往<a href='<?php echo Url::to(['num/insert']);?>' style='cursor:pointer'>添加</a>。</b></td>
							
						</tr>
					<?php
					}
					?>
                    
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="text-right">
            <p>Copyright &copy; 2084 Company Name
                | More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></p>
        </footer>
    </div>
</div>
</div>