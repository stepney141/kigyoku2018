<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../assets/images/icon5.png" type="image/png">

    <link rel="stylesheet" href="css/bootstrap-custom.css">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/style.css">
    <title>実行委員ブログ投稿ページ</title>
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/icon5.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <span class="text-black-50">Kigyokusai 2018</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item mr-auto">
                        <a class="nav-link active" href="blog.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="groups.html">Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="timetable.html">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="foodmenu.html">Foods</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="movies.html">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="access.html">Access</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php

    $jsonstr = file_get_contents("data/posts.json");
                            
    $json = json_decode($jsonstr, true);
    $entries = array_reverse($json["entries"]);
    $entry = $entries[$_GET["q"]];
    ?>
        <div class="container">
            <div class="row shadow" style="margin-top: 100px; padding: 30px;">
                <div class="col-12">
                    <div class="article-title">
                        <h1 class="h1">
                            <?php echo $entry["title"] ?>
                        </h1>
                    </div>
                    <div class="article-body">
                        <?php echo $entry["content"]["html"] ?>
                    </div>
                </div>
            </div>
        </div>
</body>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</html>
