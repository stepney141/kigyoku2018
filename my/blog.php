<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="輝玉祭2018 公式サイトへようこそ。 こちらは 攻玉社中学校・高等学校の文化祭、 「輝玉祭」 のホームページです。 ... 開催日：2018年9月16日(日)・17日(月・祝) 16日(日) 展示 9:00～15:00 中夜祭 15:00～16:30 17日(月・祝)">
    <meta name="author" content="Kouhou 2018">
    <link rel="icon" href="assets/images/icon5.png" type="image/png">

    <link rel="stylesheet" href="css/bootstrap-custom.css">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/style.css">
    <title>輝玉祭2018公式サイト｜攻玉社</title>
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

    <div class="container" style="margin-top: 100px;">
        <div class="row shadow mb-5 p-3">
            <div class="col-12 mb-5 text-center">
                <div>
                    <h2 class="heading">実行委員ブログ</h2>
                    <div class="blog-posts-container">
                        <?php
                        $jsonstr = file_get_contents("data/posts.json");
                        
                        $json = json_decode($jsonstr, true);
                        $entries = array_reverse($json["entries"]);
                    ?>
                            <?php
                    foreach ($entries as $i => $entry) {
                        ?>


                                <div class="blog-post-card">
                                    <h3 class="blog-post-heading">
                                        <?php echo $entry["title"]; ?>
                                    </h3>
                                    <div class="blog-post-body">
                                        <?php echo mb_substr($entry["content"]["plaintext"], 0, 100) . " ... "
                                                    . '<a href="blogpage.php?q=' . $i . '" class="text-primary">Read More</a>'; ?>
                                    </div>
                                    <div class="blog-post-footer">
                                        <?php echo $entry["date"] . "  by " . $entry["author"]; ?>
                                    </div>
                                </div>

                                <?php
                    }
                    ?>
                                    <script>
                                        $(() => {
                                            if ($('.blog-post-card').length % 2 != 0) {
                                                $('.blog-post-card:last').after(
                                                    '<div class="blog-post-card" style="visibility: hidden;"></div>'
                                                );
                                            }
                                        });
                                    </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
