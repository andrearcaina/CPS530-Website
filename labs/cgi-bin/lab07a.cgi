#!/usr/bin/perl
use CGI':standard';
use strict;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser); 

print header;

print start_html(
	-title => 'Lab07a',
	-style => {'src' => 'lab07a.css'},
);

print "<h1>This is my first Perl program.</h1>";

print "<p><a href='https://www2.cs.ryerson.ca/~aarcaina/Lab07/lab07b.html'>Go to Lab07b</a></p>";

print "<p><a href='../index.html'>Go Back</a></p>";

print end_html;

