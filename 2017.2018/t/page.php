<!DOCTYPE html>
<html lang="ja">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Kouhou 2017">
	<link rel="icon" href="photo/icon3.jpg" type="img/jpg">
	<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/blogstyle.css">
	
	<title>実行委員ブログ- 輝玉祭2017公式サイト｜攻玉社</title>

<!-- twitter card -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@kigyokusai"/>
        <meta property="og:url" content="http://kigyoku.com/blog.php"/>
        <meta property="og:title" content="実行委員ブログ- 輝玉祭2017公式サイト｜攻玉社"/>
        <meta property="og:description" content="13人の実行委員たちが輝玉祭の最新情報を発信します！"/>
        <meta property="og:image" content="http://kigyoku.com/photo/pamphlet-image01.jpg"/>
        <meta property="fb:app_id" content="2006551362943735">

</head>
<body>
	
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header nav-font">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">輝玉祭2017</a>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav nav-font">
                    <script type="text/javascript" src="js/menu.js"></script>
                </ul>
            </div>
        </div>	        
    </nav>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-12 mpuls-1m-medium">
                <div class="page-header">
                <h1>実行委員ブログ</h1>
                </div>
                <p>輝玉祭実行委員が綴るブログです。随時更新していきます！</p>
                <br>
                <div id='main'>
                    <?php
                        $id = $_GET['q'];
                        if (strlen($id) == 0) {
                            echo "ファイルを指定してください";
                        } else {
                            $fp = fopen("entry/article$id.txt", 'r');
                            $title= fgets($fp);
                            fgets($fp);
                            while ($line = fgets($fp)) {
                                $main = $main . '<br>' .  $line;
                            }
                            fclose($fp);
                            echo "$count";
                            echo "<div id='module-title'>";
                            echo "<h2>$title</h2>";
                            echo "</div>";
                            echo "<div id='module-body'>";
                            echo "$main";
                            echo "<br>";
                            echo "</div>";
                        }
                    ?>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <hr class="footer_hr">
	<!-- Footer -->
        <div class="text-center">
	<footer class="footer-margin">
	<script type="text/javascript" src="js/footer.js"></script></footer></div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
