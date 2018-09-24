<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
$event = array();
//$timestamp = strtotime("2016-09-18 11:00:31");
$timestamp = strtotime("now");
//$timestamp = strtotime("2017-09-17 11:00:31");
$timehi = date("Hi", $timestamp);
if(date("Ymd", $timestamp) == 20170917) {
    if($timehi< 900) {
        $event[0] = '[開場までお待ちください]';
        $event[2] = '[開場までお待ちください]';
        $event[4] = '[開場までお待ちください]';
        $event[6] = '[開場までお待ちください]';
        $event[8] = '[開場までお待ちください]';
        $event[10] = '[開場までお待ちください]';
        $event[1] = '';
        $event[3] = '';
        $event[5] = '';
        $event[7] = '';
        $event[9] = '';
        $event[11] = '';
    } elseif($timehi> 1630) {
        $event[0] = '[本日は終了しました]';
        $event[2] = '[本日は終了しました]';
        $event[4] = '[本日は終了しました]';
        $event[6] = '[本日は終了しました]';
        $event[8] = '[本日は終了しました]';
        $event[10] = '[本日は終了しました]';
        $event[1] = '';
        $event[3] = '';
        $event[5] = '';
        $event[7] = '';
        $event[9] = '';
        $event[11] = '';
    } else {
        /*if($timehi>= 900 and $timehi< 930) {
            $event[0] = '[開始までお待ちください]';
            $event[1] = '';
        } elseif($timehi< 1000) {
            $event[0] = 'だんすのじかん';
            $event[1] = '9:30～10:00';
        } elseif($timehi< 1030) {
            $event[0] = '箱の中身はなんだろな？';
            $event[1] = '10:00～10:30';
        } elseif($timehi< 1140) {
            $event[0] = '玉コレ！';
            $event[1] = '11:00～11:40';
        } elseif($timehi< 1230) {
            $event[0] = 'だんすのじかん';
            $event[1] = '11:50～12:30';
        }
        elseif($timehi< 1310) {
            $event[0] = '世界記録に挑戦';
            $event[1] = '11:50～13:10';
        } elseif($timehi< 1350) {
            $event[0] = 'フィーリングカップル';
            $event[1] = '13:20～13:50';
        } elseif($timehi< 1430) {
            $event[0] = '玉マッチョ';
            $event[1] = '14:00～14:30';
        } else {
            $event[0] = '[本日は終了しました]';
            $event[1] = '';
        }*/
        $event[0]='終日中止';
        $event[1]='';

        if($timehi>= 900 and $timehi< 1100) {
            $event[2] = 'バスケ部招待試合';
            $event[3] = '9:00～11:00';
        } elseif($timehi< 1300) {
            $event[2] = '[開始までお待ちください]';
            $event[3] = '';
        } elseif($timehi< 1400) {
            $event[2] = '吹奏楽部コンサート';
            $event[3] = '13:00～14:00';
        } elseif($timehi< 1500) {
            $event[2] = '[開始までお待ちください]';
            $event[3] = '';
        } elseif($timehi< 1630) {
            $event[2] = '中夜祭';
            $event[3] = '15:00～16:30';
        } else {
            $event[2] = '[本日は終了しました]';
            $event[3] = '';
        }
        $event[2] = '[本日は終了しました]';
        $event[3] = '';

        if($timehi>= 900 and $timehi< 950) {
            $event[4] = '[開始までお待ちください]';
            $event[5] = '';
        } elseif($timehi< 1030) {
            $event[4] = 'Mr.question';
            $event[5] = '9:50～10:30';
        } elseif($timehi< 1045) {
            $event[4] = '[開始までお待ちください]';
            $event[5] = '';
        } elseif($timehi< 1120) {
            $event[4] = 'L@st Virgin';
            $event[5] = '10:45～11:20';
        } elseif($timehi< 1250) {
            $event[4] = '[開始までお待ちください]';
            $event[5] = '';
        } elseif($timehi< 1220) {
            $event[4] = '玉ニャンズ';
            $event[5] = '11:35～12:10';
        } elseif($timehi< 1225) {
            $event[4] = '[開始までお待ちください]';
            $event[5] = '';
        } elseif($timehi< 1255) {
            $event[4] = '絶対的Neutralism';
            $event[5] = '12:25～12:55';
        } elseif($timehi< 1315) {
            $event[4] = '[開始までお待ちください]';
            $event[5] = '';
        } elseif($timehi< 1350) {
            $event[4] = 'だるま';
            $event[5] = '13:15～13:50';
        } else {
            $event[4] = '[本日は終了しました]';
            $event[5] = '';
        }

        if($timehi>= 900 and $timehi< 1400) {
            $event[6] = '剣道大会';
            $event[7] = '9:00～14:00';
        } else {
            $event[6] = '[本日は終了しました]';
            $event[7] = '';
        }

        if($timehi>= 900 and $timehi< 1430) {
            $event[8] = '[開始までお待ちください]';
            $event[9] = '';
        } elseif($timehi< 1500) {
            $event[8] = 'PTAコーラス';
            $event[9] = '14:00～15:00';
        } else {
            $event[8] = '[本日は終了しました]';
            $event[9] = '';
        }

        if($timehi>= 900 and $timehi< 1000) {
            $event[10] = '[開始までお待ちください]';
            $event[11] = '';
        } elseif($timehi< 1030) {
            $event[10] = '12人の怒れる男たち';
            $event[11] = '10:00～10:30';
        } elseif($timehi< 1120) {
            $event[10] = '美女と野獣';
            $event[11] = '10:50～11:20';
        } elseif($timehi< 1210) {
            $event[10] = 'Modern Peach Boy';
            $event[11] = '11:40～12:10';
        } elseif($timehi< 1300) {
            $event[10] = '12人の怒れる男たち';
            $event[11] = '12:30～13:00';
        } elseif($timehi< 1350) {
            $event[10] = '美女と野獣';
            $event[11] = '13:20～13:50';
        } elseif($timehi< 1440) {
            $event[10] = 'Modern Peach Boy';
            $event[11] = '14:10～14:40';
        } else {
            $event[10] = '[本日は終了しました]';
            $event[11] = '';
        }
    }
} elseif(date("Ymd", $timestamp) == 20170918) { // day 2
    if($timehi< 1000) {
        $event[0] = '[開場までお待ちください]';
        $event[2] = '[開場までお待ちください]';
        $event[4] = '[開場までお待ちください]';
        $event[6] = '[開場までお待ちください]';
        $event[8] = '[開場までお待ちください]';
        $event[10] = '[開場までお待ちください]';
        $event[1] = '';
        $event[3] = '';
        $event[5] = '';
        $event[7] = '';
        $event[9] = '';
        $event[11] = '';
    } elseif($timehi> 1700) {
        $event[0] = '[今年の輝玉祭は終了しました]';
        $event[2] = '[今年の輝玉祭は終了しました]';
        $event[4] = '[今年の輝玉祭は終了しました]';
        $event[6] = '[今年の輝玉祭は終了しました]';
        $event[8] = '[今年の輝玉祭は終了しました]';
        $event[10] = '[今年の輝玉祭は終了しました]';
        $event[1] = '';
        $event[3] = '';
        $event[5] = '';
        $event[7] = '';
        $event[9] = '';
        $event[11] = '';
    } else {
        if($timehi>= 1000 and $timehi< 1030) {
            $event[0] = '[開始までお待ちください]';
            $event[1] = '';
        } elseif($timehi< 1050) {
            $event[0] = 'だんすのじかん';
            $event[1] = '10:30～10:50';
        } elseif($timehi< 1130) {
            $event[0] = 'クイズ';
            $event[1] = '11:00~ 11:30';
        } elseif($timehi< 1200) {
            $event[0] = '箱の中身はなんだろな？';
            $event[1] = '11:40～12:00';
        } elseif($timehi< 1240) {
            $event[0] = '玉コレ！';
            $event[1] = '12:10～12:40';
        } elseif($timehi< 1330) {
            $event[0] = 'だんすのじかん';
            $event[1] = '12:50～13:30';
        } elseif($timehi< 1410) {
            $event[0] = '玉マッチョ';
            $event[1] = '13:40～14:10';
        } elseif($timehi< 1450) {
            $event[0] = '世界記録に挑戦';
            $event[1] = '14:20～14:50';
        } elseif($timehi< 1530) {
            $event[0] = 'フィーリングカップル';
            $event[1] = '15:00～15:30';
        } else {
            $event[0] = '[本日は終了しました]';
            $event[1] = '';
        }

        if($timehi>= 1000 and $timehi< 1300) {
            $event[2] = '[開始までお待ちください]';
            $event[3] = '';
        } elseif($timehi< 1400) {
            $event[2] = '吹奏楽部コンサート';
            $event[3] = '13:00～14:00';
        } elseif($timehi< 1500) {
            $event[2] = '[開始までお待ちください]';
            $event[3] = '';
        } elseif($timehi< 1700) {
            $event[2] = '後夜祭';
            $event[3] = '15:00～17:00';
        } else {
            $event[2] = '[本日は終了しました]';
            $event[3] = '';
        }

        if($timehi>= 1000 and $timehi< 1010) {
            $event[4] = '[開始までお待ちください]';
            $event[5] = '';
        } elseif($timehi< 1050) {
            $event[4] = '鶴の湯';
            $event[5] = '10:10～10:50';
        } elseif($timehi< 1105) {
            $event[4] = '[開始までお待ちください]';
            $event[5] = '';
        } elseif($timehi< 1145) {
            $event[4] = 'Anywhere Door';
            $event[5] = '11:05～11:45';
        } elseif($timehi< 1200) {
            $event[4] = '[開始までお待ちください]';
            $event[5] = '';
        } elseif($timehi< 1230) {
            $event[4] = 'tameable alarm';
            $event[5] = '12:00～12:30';
        } else {
            $event[4] = '[本日は終了しました]';
            $event[5] = '';
        }

        if($timehi >= 1000 and $timehi < 1500) {
            $event[6] = '柔道大会';
            $event[7] = '10:00～15:00';
        } else {
            $event[6] = '[本日は終了しました]';
            $event[7] = '';
        }

        if($timehi>= 1000 and $timehi< 1200) {
            $event[8] = 'Presto';
            $event[9] = '10:00～12:00';
        } else {
            $event[8] = '[本日は終了しました]';
            $event[9] = '';
        }

        if($timehi>= 1000 and $timehi< 1030) {
            $event[10] = '12人の怒れる男たち';
            $event[11] = '10:00～10:30';
        } elseif($timehi< 1120) {
            $event[10] = '美女と野獣';
            $event[11] = '10:50～11:20';
        } elseif($timehi< 1210) {
            $event[10] = 'Modern Peach Boy';
            $event[11] = '11:40～12:10';
        } elseif($timehi< 1300) {
            $event[10] = '12人の怒れる男たち';
            $event[11] = '12:30～13:00';
        } elseif($timehi< 1350) {
            $event[10] = '美女と野獣';
            $event[11] = '13:20～13:50';
        } elseif($timehi< 1440) {
            $event[10] = 'Modern Peach Boy';
            $event[11] = '14:10～14:40';
        } else {
            $event[10] = '[本日は終了しました]';
            $event[11] = '';
        }

    }
} else {
    $event[0] = '[開催期間中のみ表示されます]';
    $event[2] = '[開催期間中のみ表示されます]';
    $event[4] = '[開催期間中のみ表示されます]';
    $event[6] = '[開催期間中のみ表示されます]';
    $event[8] = '[開催期間中のみ表示されます]';
    $event[10] = '[開催期間中のみ表示されます]';
    $event[1] = '';
    $event[3] = '';
    $event[5] = '';
    $event[7] = '';
    $event[9] = '';
    $event[11] = '';

}


//$echo_text = '';
for($i = 0; $i < count($event); $i++) {
    echo $event[$i] . ',';
    /*$echo_text = $echo_text.$event[$i].',';*/
}
//echo $echo_text;
?>
