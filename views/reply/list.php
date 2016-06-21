<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Main content -->

<div class="templatemo-content-container">
    <div class="templatemo-content-widget no-padding">
        <div class="panel panel-default table-responsive">
            <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                <tr>
                    <td><a href="" class="white-text templatemo-sort-by">#id <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">   规则名称<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">   关键字<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">   回复内容<span class="caret"></span></a></td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach($arr as $k=>$v){?>
                    <tr>
                        <td><?php echo $v['p_id'];?></td>
                        <td><?php echo $v["p_title"];?></td>
                        <td><?php echo $v["p_keysword"];?></td>
                        <td><?php echo $v["p_content"];?></td>

                        <td><a href="<?php echo Url::to(['reply/save'])?>&id=<?php echo $v['p_id'];?>" class="templatemo-edit-btn">Edit</a></td>

                        <td><a href="<?php echo Url::to(['reply/del'])?>&id=<?php echo $v['p_id'];?>" class="templatemo-link">Delete</a></td>
                    </tr>
                <?php }?>
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