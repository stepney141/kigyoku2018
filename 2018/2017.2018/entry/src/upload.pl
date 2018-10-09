#!/usr/bin/perl

use strict;
use warnings;
use CGI;

my $q = CGI->new;

my $title = $q->param('title');

print "Content-Type: text/html\n\n";
print "タイトル：$title\n";

read(STDIN, $PostData, $ENV{'CONTENT_LENGTH'});
print $PostData;
