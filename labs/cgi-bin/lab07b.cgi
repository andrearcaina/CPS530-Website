#!/usr/bin/perl
use CGI ':standard';
use strict;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);
use File::Basename;

my $script_path = '/class-years/y2022/aarcaina/public_html/cgi-bin';
my $upload_dir = "$script_path/uploads";

mkdir $upload_dir or die "Cannot create $upload_dir: $!" unless -d $upload_dir;

my $query = new CGI;

my $firstName = $query->param('First Name');
my $lastName = $query->param('Last Name');
my $streetName = $query->param('Street Name');
my $city = $query->param('City');
my $postalCode = $query->param('Postal Code');
my $province = $query->param('Province');
my $phoneNumber = $query->param('Phone Number');
my $email = $query->param('Email');
my $photo = $query->param('Photo');
$photo =~ s/.*[\/\\](.*)/$1/;
my $upload_filehandle = $query->upload('Photo');

open UPLOADFILE, ">$upload_dir/$photo";

while ( <$upload_filehandle> ) { 
	print UPLOADFILE; 
}
close UPLOADFILE;

my $validPhoneNumber = $phoneNumber =~ /^\d{10}$/;
my $validPostalCode = $postalCode =~ /^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/;
my $validEmail = $email =~ /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
my $validPhoto = $photo =~ /\.(jpg|jpeg|gif|png)$/i;

print header;
print start_html(
    -title => 'Lab07b Result',
    -style => {
        -type => 'text/css',
        -code => '
            @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap");

            body {
                font-family: "Roboto", sans-serif;
                background-color: #f5f5f5;
                text-align: center;
            }

            div.container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: left;
            }

            h2 {
                color: #1e70bf;
            }

            ul {
                list-style-type: none;
                padding: 0;
            }

            li {
                margin-bottom: 10px;
            }

            img {
                max-width: 100%;
                height: auto;
                margin-top: 10px;
            }

            .error {
                color: #ff0000;
                font-weight: bold;
            }
        ',
    },
);

print "<div class='container'>";
print "<h2>Form Submission Result</h2>";

print "<ul>";
print "<li><strong>First Name:</strong> $firstName</li>";
print "<li><strong>Last Name:</strong> $lastName</li>";
print "<li><strong>Street Name:</strong> $streetName</li>";
print "<li><strong>City:</strong> $city</li>";

print "<li><strong>Postal Code:</strong> ";
print $validPostalCode ? $postalCode : "<span class='error'>$postalCode = Invalid format. Correct = L0L 0L0</span>";
print "</li>";

print "<li><strong>Province:</strong> $province</li>";
print "<li><strong>Phone Number:</strong> ";
print $validPhoneNumber ? $phoneNumber : "<span class='error'>$phoneNumber = Invalid format. Correct = 4164053838</span>";
print "</li>";

print "<li><strong>Email Address:</strong> ";
print $validEmail ? $email : "<span class='error'>$email = Invalid format, Correct = dtandre331\@gmail.com</span>";
print "</li>";

print "<li><strong>Photograph:</strong> ";
if ($validPhoto) {
    print "<img src='uploads/$photo' alt='/uploads/$photo'>";
} else {
    print "<span class='error'>Invalid file format</span>";
}
print "</li>";

print "</ul>";
print "<p><a href='../Lab07/lab07b.html'>Go Back</a></p>";
print "</div>";

print end_html;
