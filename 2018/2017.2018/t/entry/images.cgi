#!/usr/bin/perl

use strict;
use warnings;
use CGI ;
use File::Basename;

my $q = CGI->new;

my @files = glob "../blogimg/*";

print "Content-Type: text/html; charset=UTF-8;\n\n";
print "<!DOCTYPE HTML>";
print "<html lang='ja'>";
print "<head> <meta charset=\"UTF-8\"> <title>aaa</title> </head>";
print "<body>";
print $q->h1("輝玉祭実行委員用画像管理ページ");
print $q->p("このページも作りかけです☆");
print $q->a({href=>'index.shtml'}, "メインページへ");
print "<br>";
print "<table> <caption>ファイル一覧</caption> <thead> <tr> <th>ID</th> <th>filename</th> <th>title</th> </tr> </thead>";
print "<tbody>";
foreach(@files) {
    my $filename = basename($_);
    print "<tr><th>0</th> <td><a href=\"../blogimg/$_\">$filename</a></td> <td>0</td></tr>";
}
#                <tr><th>1</th><td>article1.txt</td></tr>
print "</tbody> </table> ";
print "<br> <h2>画像アップロードフォーム</h2>";
print "<p>画像は一枚ずつアップロードしてください。また、画像以外のデータをアップしないでください。</p> <br>";
print " <form method=\"post\" action=\"imgupload.cgi\" enctype=\"multipart/form-data\"><input type=\"file\" name=\"img\"> <input type=\"submit\" value=\"アップロード\"> </form>";
print "</body>";
print "</html>";
