#!/usr/local/bin/perl
use strict;
use warnings;


sub display {
    my ($filename, $title, $update_time) = @_;
    print "Content-Type: text/html\n\n";
    print "<li>";
    print "<a href=\"entry/$filename\">";
    print "<h2>$title</h2>";
    print "<p>更新日時：$update_time</p>";
    print "</a>";
    print "</li>";
}


display("entry000.html", "Perlを書くためのたった一つの冴えたやり方", "YYYY/MM/DD");
