<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Kouhou 2018">
    
<link rel="stylesheet" href="css/blog.css">

    
    <title>輝玉祭2018公式サイト｜攻玉社</title>
    
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white">
            <a class="navbar-brand" href="/">
                <img src="assets/images/icon5.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <span class="text-black-50">Kigyokusai 2018</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                    <li class="nav-item">
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
                include_once './php/dbblog.php';
                include_once "./php/ptok.php";
                $blog = new BlogMapper(GyokuwebDB::Instance());

                $entries = $blog->acquirePostsAll();

                foreach ($entries as $i => $entry):
                ?>

                <div class="blog-post-card">
                    <h3 class="blog-post-heading">
                        <a href="blogpage.php?page=<?= $entry["id"] ?>" class="headingtext">
                            <?= $entry["caption"]; ?>
                        </a>
                    </h3>
                    <div class="blog-post-body">
                        <a href="blogpage.php?page=<?= $entry["id"] ?>" class="shorttext">
                            <?= textFromHTML($entry["html"], ['img', 'p', 'strong'], 90) ?>
                        </a>
                    </div>
                    <div class="blog-post-footer">
                        <?= $entry["time"]->format("Y/m/d") . "  by " . $entry["author"]; ?>
                    </div>
                </div>

                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>


    </div>



    

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    
<script>
    $(() => {
        if ($('.blog-post-card').length % 2 != 0) {
            $('.blog-post-card:last').after(
                '<div class="blog-post-card" style="visibility: hidden;"></div>'
            );
        }
    });
</script>


</body>

</html>