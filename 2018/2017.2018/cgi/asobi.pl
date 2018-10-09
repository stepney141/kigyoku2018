#!/usr/bin/perl

use strict;
use warnings;

open(OUT, "count.dat");
print OUT "Hello";
close(OUT);

my $unko = "生卵";

print "Content-Type: text/html;\n\n";
print "<li>";
print "<p>絶望した！ $unko に絶望した！</p>";
print "</li>";
