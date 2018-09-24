# もしもHTMLファイルをそのままアップするなら、パスの指定を直さないといけないので
# perl sagyouyou.pl
# してください

#! /usr/local/perl
use strict;
use utf8;
use warnings;

my $dat;
open(my $file, "index.html") or die("error: $!");
while (my $line = <$file>) {
    $line =~ s/\.\.\/js/js/g;
    $line =~ s/\.\.\/css/css/g;
    $dat = $dat . $line;
}
print $dat;
close($file);
