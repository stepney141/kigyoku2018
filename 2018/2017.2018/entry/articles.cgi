#!/usr/bin/perl

use strict;
use warnings;
use CGI ;

my $q = CGI->new;
my @file = glob "*";
open(FILE, "count.dat");
my $count = <FILE>;
close(FILE);

print "Content-Type: text/html; charset=UTF-8;\n\n";
print "<!DOCTYPE HTML>";
print "<html lang='ja'>";
print "<head> <meta charset=\"UTF-8\"> <title>aaa</title> </head>";
print "<body>";
print $q->h1("輝玉祭実行委員用記事一覧ページ");
print $q->p("このページも作りかけです☆");
print $q->a({href=>'index.shtml'}, "メインページへ");
print "<br>";
print "<table> <caption>記事一覧</caption> <thead> <tr> <th>ID</th> <th>filename</th> <th>title</th> <th>last modified</th></tr> </thead>";
print "<tbody>";
my $i;
for ($i = 1; $i <= $count; $i++) {
    open(ARTCL, "article$i.txt");
    my $line = <ARTCL>;
    close(ARTCL);
    my $epoc = (stat "article$i.txt")[9];
    my ($sec, $min, $hour, $mday, $mon, $year) = localtime($epoc);
    $year = $year + 1900;
    $mon = $mon + 1;
    my $updatetime = "$year/$mon/$mday $hour:$min:$sec";
    print "<tr><th>$i</th> <td><a href=\"modify.php?q=$i\">article$i.txt</a></td> <td>$line</td> <td>$updatetime</td> </tr>";
}
#                <tr><th>1</th><td>article1.txt</td></tr>
print "</tbody> </table> ";
print "</body>";
print "</html>";
