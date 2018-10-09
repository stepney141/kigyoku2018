<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Kouhou 2018">
    

    <link rel="stylesheet" href="css/basic-style.css">
    
<link rel="stylesheet" href="css/blogpost.css">

    
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
                        <a class="nav-link" href="blog.php">Blog</a>
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
        
    <?php
    include_once './php/dbblog.php';
    $blog = new BlogMapper(GyokuwebDB::Instance());

    $entry = $blog->acquirePostById($_GET["page"]);
    ?>
    <div class="row shadow mb-5" style="padding: 0 30px 30px;">
        <div class="col-12">
            <div class="article-title">
                <h1 class="h1">
                    <?php echo $entry["caption"] ?>
                </h1>
            </div>
            <div class="article-body">
                <?php echo $entry["html"] ?>
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
    

</body>

</html>