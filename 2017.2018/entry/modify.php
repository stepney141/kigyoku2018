<!DOCTYPE HTML>
<html lang="ja">
<head> <meta charset="UTF-8"> <title>modify</title> </head>
<body>
    <h1>記事編集ページ</h1>
    <!--<p>注意事項：なんども言います。何度でも言います。タイトル部分に改行は入れないでください。本当に。</p>-->
        <p>注意事項：複数ファイルのアップロードには対応しておりません。ごめんなさい。あと、画像以外をあげるとサーバーエラーが起きます。</p>
        <p>また、画像を記事内に入れる場合は&lt;img class="img-responsive" src="blogimg/〇〇〇.jpg"&gt;としてください。ご迷惑をお掛けしております。</p>
    <a href="index.shtml">メインページ</a>
    <a href="articles.cgi">変更を破棄して戻る</a>
    <br>
    <?php
#        echo "$_SERVER[QUERY_STRING]";
#        $url_hash = parse_url($_SERVER['HTTP_REFERER']);
#        if (array_key_exists('query', $url_hash) and strlen($url_hash['query']>0) {
                #parse_str($url_hash['query'], $query_hash);
                #echo "$query_hash['q']";
#        }
        $id = $_GET['q'];
        if (strlen($id) == 0) {
            echo "エラー：クエリが指定されていません";
        } else {
            echo "article$id.txt";
            $fp = fopen("article$id.txt", 'r');
            $title = 'no title';
            $main = '';
            $title = fgets($fp);
            fgets($fp);
            while ($line = fgets($fp)) {
                $main = $main . $line;
            }
            fclose($fp);

        echo "<form method=\"post\" action=\"upload.cgi\" enctype=\"multipart/form-data\"> 
            <p>
            <input type=\"hidden\" name=\"id\" value=\"$id\"/>
            タイトル：<textarea name=\"title\" rows=\"1\" cols=\"80\">$title</textarea><br>
            本文：<textarea name=\"article\" rows=\"20\" cols=\"80\">$main</textarea> <br>
            <input type=\"file\" name=\"img\"> <br>
            <input type=\"submit\" value=\"投稿\"/>
            </p>
        </form>";
        }
    ?>
</body>
<html>

