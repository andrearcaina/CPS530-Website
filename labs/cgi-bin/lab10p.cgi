#!/usr/bin/env python

import cgi

form = cgi.FieldStorage()

city = form.getvalue('city').upper()
province = form.getvalue('province').upper()
country = form.getvalue('country').upper()
picture_url = form.getvalue('picture')


print "Content-type: text/html\n\n"
print "<html>"
print "<head>"
print "<title>Lab10 Python Script</title>"
print "<style>"
print "body {font-family: Roboto, monospace;}"
print "h1 {text-align: center; color: white; background-color: #4CAF50; padding: 20px; font-size: 2em;}"
print "img {width: 80%; height: auto; border: 10px solid #4CAF50; text-align: center; display: block; margin: 0 auto;}"
print "</style>"
print "</head>"
print "<body>"

print "<h1>{}, {}, {}</h1>".format(city, province, country)
print "<p style='text-align: center;'><a href='https://www2.cs.ryerson.ca/~aarcaina/Lab10/lab10b.html'> Go back </a></p>"
print "<img src='{}' alt='City Picture'>".format(picture_url)

print "</body>"
print "</html>" 
