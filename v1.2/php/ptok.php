<?php

include_once 'utils.php';

function mb_strmistr($text, $needles, $offset = 0)
{
    $shortest = false;

    foreach ($needles as $needle)
    {
        $pos = mb_stripos($text, $needle, $offset);
        if ($pos === false)
        {
            continue;
        }

        if ($pos < $shortest || $shortest === false)
        {
            $shortest = $pos;
        }
    }
    return $shortest;
}

/*

Trims text from HTML which is inside tags specified.
Truncates into $max and append $ellipsis if text doesn't fit in.

BUG!!: length of returned string not exactly $max.

INCOMPLETE IMPL.:
    FAILS ON CASES LIKE:
    <p>allowed text<b>not allowed<p>This here doesn't go through</p></b></p>

*/

function textFromHTML($html, $textTags, $max = INF, $ellipsis = "…")
{
    $sep = "";
    $sep_len = mb_strlen($sep);

    $ellipsis_len = mb_strlen($ellipsis);

    $needles = [];
    foreach ($textTags as $tag)
    {
        array_push($needles, "<$tag", "</$tag");
    }

    $text = "";
    $pos = 0;
    $len = 0;

    while (($pos = mb_strmistr($html, $needles, $pos)) !== false)
    {
        $start = mb_strpos($html, '>', $pos + 1) + 1;  // start of text (immediate after closing '>')

        $nextTag = mb_strpos($html, '<', $start);

        // if no tags found...
        if ($nextTag === FALSE)
        {
            break;
        }
        else
        {
            $last = $nextTag - 1;
        }

        $plen = $last - $start + 1;

        $in = mb_substr($html, $start, $plen);

        if (($len + $sep_len + $plen) > $max)
        {
            $fplen = $max - $len - $sep_len - $ellipsis_len;
            $text .= $sep . mb_substr($in, 0, $fplen) . $ellipsis;
            $len = $max;
            break;
        }

        $text .= $sep . $in;
        $len += $sep_len + $plen;

        if ($sep_len === 0)
        {
            $sep = " ";
            $sep_len = mb_strlen($sep);
        }

        $pos = $last + 1;
    }

    return $text;
}

/*
$html = <<<'EOT'
<p>はじめまして！今回、副実行委員</p><p>をやらしていただく与那原です！去年まで輝玉祭に携わっていないけど大丈夫っしょ！なんて思ってからもう半年以上の日時が経ちます。正直、僕は今まで経験がないので進んであれこれ作業することはできませんでした。むしろ、迷惑しかかけてなかったかも…。</p>
<p>でも、なんだかんだで残りあと約2週間！僕は、自分が後悔しないように、みんなに迷惑をかけないように頑張っていきます！そして、約2週間後の輝玉祭に是非来てください！待ってます！</p>
<p>さあ、僕は今から高校生あるあるの夏休みの宿題をやるぞぉ…</p>
EOT;

echo textFromHTML($html, ['img', 'p', 'strong'], 50);
*/