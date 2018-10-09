<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Kouhou 2018">
    
    <link rel="stylesheet" href="css/basic-style.css">
    
    
    <title>輝玉祭2018公式サイト｜攻玉社</title>
    
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/icon5.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <span class="text-black-50">Kigyoku.Insiders18</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active mr-auto">
                        <a class="nav-link" href="#">Submit Blog</a>
                    </li>
                    <li class="nav-item mr-auto">
                        <a class="nav-link" href="#">Timetable</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    

    <div class="container" style="margin-top: 100px;">
        

<?php

include_once './php/dbblog.php';
include_once './php/utils.php';
include_once './php/imgresize.php';

function uploadImages($prefix) {
    $filenames = [];
    if (isset($_FILES["images"]) && is_array($_FILES["images"])) {
        $imagefiles = $_FILES["images"];
        foreach ($imagefiles["error"] as $i => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $imagefiles["tmp_name"][$i];

                if (!is_uploaded_file($tmp_name)) {
                    throw new RuntimeException();
                }

                $orig_name = basename($imagefiles["name"][$i]);

                $ext = image_type_to_extension(getimagesize($tmp_name)[2]);
                $name = uniqid("blogimg_") . $ext;
                $path = $prefix . $name;

                $filenames[$orig_name] = $name;

                resizeImageAndSave($tmp_name, $path, 1200, 1200);
            }
        }
    }
    return $filenames;
}

function submitPost($prefix, $filenames) {
    $post = [
        "caption" => $_POST["title"],
        "markdown" => $_POST["article"],
        "author" => $_POST["name"]
    ];

    $blog = new BlogMapper(GyokuwebDB::Instance());
    $blog->submitPost($post, $prefix, $filenames);
}

function process() {

    $prefix = "blog/images/";

    try {
        $filenames = uploadImages($prefix);
        submitPost($prefix, $filenames);
    } catch (Exception $e) {
        return "<h2>" . h($e->getMessage()) . "</h2>";   
    }

    return "<h2>Done!</h2>";
}

?>
<div class="row shadow mb-5 p-3" style="margin-top: 100px;">
    <div class="col-12 mb-5 text-center">
        <?= process() ?>
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
