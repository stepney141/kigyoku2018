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

my $title = $q->param('title');
my $article = $q->param('article');
my $id = $q->param('id');
my $filename= $q->param('img');
utf8::decode($title);
utf8::decode($article);
utf8::decode($id);

$title =~ s/\n//g;

if ($filename ne "") {
    my $img = basename($filename);
    my $type = $q->uploadInfo($filename)->{'Content-Type'};
    &err("file type error: $type") if ($type !~ /^image/);
    my $newfile = "../blogimg/$img";
    my $fh = $q->upload('img');
    copy($fh, "$newfile");
}

undef($q);

my $count = 0;
if ($id == 0) {
    open(FILE, "count.dat");
    $count = <FILE>;
    close(FILE);
    $count++;
    open(FILE, ">count.dat");
    print FILE $count;
    close(FILE);
} else {
    $count = $id;
}

open(TEXT, ">article$count.txt");
print TEXT "$title \n\n";
print TEXT "$article";
close(TEXT);

print "Content-Type: text/html; charset=UTF-8;\n\n";
print "以下の記事を投稿しました。<br><br>";
print "タイトル： $title ";
print "<br>";
print "本文： $article";
print "<br> <br> <a href=index.shtml>メインページ</a>";

