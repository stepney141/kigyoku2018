<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="photo/icon5.png" type="image/png">

    <link rel="stylesheet" href="css/basic-style.css">
    <title>実行委員ブログ投稿ページ</title>
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
    <?php
    include("php/Parsedown.php");

    function br2nl($string)
    {
        return preg_replace('/<br[[:space:]]*\/?[[:space:]]*>/i', "\r\n", $string);
    }

    if (isset($_POST['view_preview']) && isset($_POST['name']) && isset($_POST['article']) && isset($_POST["title"])) {
        $filenames = [];
        foreach ($_FILES["images"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["images"]["tmp_name"][$key];
                $name = basename($_FILES["images"]["name"][$key]);
                $path = "blog/tmp_images/$name";
                
                if (file_exists($path)) {
                    chmod($path, 0755);
                    unlink($path);
                }
                move_uploaded_file($tmp_name, $path);
                array_push($filenames, $name);
            }
        }
        $parsedown = new Parsedown();
        $converted = preg_replace('/<img src="([^"]+)"/', '<img src="blog/tmp_images/$1"', $parsedown->text($_POST["article"])); ?>
        <div class="container" style="margin-top: 100px">
            <div class="row shadow my-5 p-4" style="margin: 0px 100px">
                <div class="col-12 m-3">
                    <h2>Preview</h2>
                    <form method="post">
                        <input type="hidden" name="submit">
                        <input type="hidden" name="files" value="<?php echo htmlspecialchars(json_encode($filenames, JSON_UNESCAPED_UNICODE)); ?>">
                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST["name"]); ?>">
                        <input type="hidden" name="article" value="<?php echo htmlspecialchars(nl2br($_POST["article"])); ?>">
                        <input type="hidden" name="converted" value="<?php echo htmlspecialchars($converted); ?>">
                        <input type="hidden" name="title" value="<?php echo htmlspecialchars($_POST["title"]); ?>">
                        <button type="submit" class="btn btn-primary">この内容で投稿する</button>
                    </form>
                </div>
            </div>
            <div class="row shadow" style="margin: 100px; margin-top: 10px; padding: 30px;">
                <div class="article-body">
                    <?php
                    echo $converted; ?>
                </div>
            </div>
        </div>

        <?php
    } elseif (isset($_POST["submit"])
           && isset($_POST["name"])
           && isset($_POST["title"])
           && isset($_POST["converted"])
           && isset($_POST["files"])) {
        $jsonstr = file_get_contents("data/posts.json");
                        
        $json = json_decode($jsonstr, true);
        $entries = $json["entries"];


        $parsedown = new Parsedown();
        
        $converted = preg_replace('/<img src="blog\\/tmp_images\\/([^"]+)"/', '<img src="blog/images/$1"', htmlspecialchars_decode($_POST["converted"]));
        

        $tagexp = "/<[^>]*>/";
        $plaintext = preg_replace($tagexp, "", $converted);

        $data = [
            "title" => htmlspecialchars_decode($_POST["title"]),
            "date" => date("Y/n/d"),
            "author" => htmlspecialchars_decode($_POST["name"]),
            "content" => [
                "plaintext" => $plaintext,
                "markdown" => br2nl(htmlspecialchars_decode($_POST["article"])),
                "html" => $converted
            ]
        ];

        array_push($entries, $data);

        $json = [
            "entries" => $entries
        ];

        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        file_put_contents("data/posts.json", $json);
        
        $filenames = json_decode(htmlspecialchars_decode($_POST["files"]));

        foreach ($filenames as $filename) {
            rename("blog/tmp_images/$filename", "blog/images/$filename");
        } ?>
            <div class="container" style="margin-top: 100px">
                <div class="row shadow my-5 p-4" style="margin: 0px 100px">
                    <h1>Done!</h1>
                </div>
            </div>
            <?php
    } else {
        ?>
                <div class="container">
                    <div class="row shadow mb-5 p-3" style="margin-top: 100px;">
                        <div class="col-12 mb-5 text-center">
                            <div class="mx-auto text-left mt-3">
                                <div style="border: 1px solid gray; margin: 15px; padding: 5px;">
                                    ArticleにはMarkdownにて記事を書いてください。
                                    <br>
                                    画像は<strong>Imagesにて画像ファイルを選択した後</strong>、<br>
                                    <br>
                                    <span style="font-family: monospace;">![画像が読み込まれなかったときの代替テキスト（省略可）](ファイル名)</span><br>
                                    <br>
                                    の形式で記述してください。
                                    <br>
                                    <br>
                                    例:<br>
                                    <br>
                                    <span style="font-family: monospace;">
									この**テキストを強調**しています  <br>
                                    今日は集合写真を取りました↓  <br>![集合写真](shashin.jpg)  <br>
                                    これからもよろしくおねがいします。  </span>
                                    <br>
                                    <br>
                                    Markdownの書き方:
                                <ul>
                                <li> <a href="https://www.asobou.co.jp/blog/bussiness/markdown">https://www.asobou.co.jp/blog/bussiness/markdown</a></li>
                                <li> <a href="https://qiita.com/tbpgr/items/989c6badefff69377da7">https://qiita.com/tbpgr/items/989c6badefff69377da7</a></li>
                                </ul>
                                <br>
                                <strong>Markdownでは単なる改行は無視されます。</strong>
                                <strong>改行するには、行末に2つ以上のスペースを入れてください。</strong>
                                <br>
                                <strong>空行をいれると、段落になります。</strong>
                                    <br>
                                </div>
                                <div class="my-5"></div>

                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="view_preview">
                                    <div class="form-group">
                                        <label for="name ">Name </label>
                                        <input type="text" class="form-control " id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title </label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                    <div class="form-group">
                                        <label for="images">Images</label>
                                        <input type="file" class="form-control-file" id="images" name="images[]" accept="image/png, image/jpeg" multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="article">Article</label>
                                        <textarea class="form-control" id="article" name="article" rows="20 "></textarea>
                                    </div>
                                    <button type="submit " class="btn btn-primary ">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
    }
    ?>
</body>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</html>
