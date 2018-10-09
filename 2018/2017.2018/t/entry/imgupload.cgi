#!/usr/bin/perl

use strict;
use warnings;
use utf8;
use CGI;
use File::Copy;
use File::Basename;

binmode(STDIN, ":utf8");
binmode(STDOUT, ":utf8");

my $q = CGI->new;

my $filename= $q->param('img');

print "Content-Type: text/html; charset=UTF-8;\n\n";

if ($filename ne "") {
    my $img = basename($filename);
    my $type = $q->uploadInfo($filename)->{'Content-Type'};
    &err("file type error: $type") if ($type !~ /^image/);
    my $newfile = "../blogimg/$img";
    my $fh = $q->upload('img');
    copy($fh, "$newfile");
    print "以下の画像をアップロードしました。<br><br>";
    print "ファイル名： $filename";
} else {
    print "画像ファイルが指定されていません。";
}

undef($q);

print "<br> <br> <a href=index.shtml>メインページ</a>";
print "<br> <br> <a href=\"images.cgi\">もう一枚アップロードする</a>";

