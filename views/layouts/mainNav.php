<?php
use yii\helpers\Url;
$controllerID = Yii::$app->controller->id;
$actionID = Yii::$app->controller->action->id;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>VE 管理公众平台</title>
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
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1>V  E管理系统</h1>
        </header>
        <div class="profile-photo-container">
          <img src="../style/images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
          <div class="profile-photo-overlay"></div>
        </div>      
        <!-- Search box -->

        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
          <ul>
            <li><a href="<?php echo Url::to(['num/show']);?>" <?php if($controllerID=='num' && $actionID=='show'){ ?> class="active" <?php } ?>><i class="fa fa-bar-chart fa-fw"></i>管理公众号</a></li>
            <li><a href="<?php echo Url::to(['num/insert']);?>" <?php if($controllerID=='num' && $actionID=='insert'){ ?> class="active" <?php } ?>><i class="fa fa-bar-chart fa-fw"></i>添加公众号</a></li>
            <li><a href="<?php echo Url::to(['login/index']);?>"><i class="fa fa-eject fa-fw"></i>退出</a></li>
          </ul>  
        </nav>
      </div>
        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-top-nav-container">
                <div class="row">
                    <nav class="templatemo-top-nav col-lg-12 col-md-12">
                        <ul class="text-uppercase">
                            <li><a href="<?php echo Url::to(['index/index']);?>" class="active">当前公众号</a></li>
                            <li><a href="<?php echo Url::to(['num/show']);?>" class="active">全局设置</a></li>
                        </ul>
                        <!--<a id="q">欢迎<span style="color: red"><?php //echo $_COOKIE['name']?></span>登陆</a>-->
                    </nav>

                </div>
            </div>
            <style>
                #q{
                    float: right;
                }
            </style>
      <!-- Main content --> 
      <?= $content ?>
    </div>

    
    <!-- JS -->
    <script src="../style/js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="../style/js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
  
    <script>
      /* Google Chart 
      -------------------------------------------------------------------*/
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart); 
      
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

          // Create the data table.
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Topping');
          data.addColumn('number', 'Slices');
          data.addRows([
            ['Mushrooms', 3],
            ['Onions', 1],
            ['Olives', 1],
            ['Zucchini', 1],
            ['Pepperoni', 2]
          ]);

          // Set chart options
          var options = {'title':'How Much Pizza I Ate Last Night'};

          // Instantiate and draw our chart, passing in some options.
          var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
          pieChart.draw(data, options);

          var barChart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
          barChart.draw(data, options);
      }

      $(document).ready(function(){
        if($.browser.mozilla) {
          //refresh page on browser resize
          // http://www.sitepoint.com/jquery-refresh-page-browser-resize/
          $(window).bind('resize', function(e)
          {
            if (window.RT) clearTimeout(window.RT);
            window.RT = setTimeout(function()
            {
              this.location.reload(false); /* false to get page from cache */
            }, 200);
          });      
        } else {
          $(window).resize(function(){
            drawChart();
          });  
        }   
      });
      
    </script>
    <script type="text/javascript" src="../style/js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>