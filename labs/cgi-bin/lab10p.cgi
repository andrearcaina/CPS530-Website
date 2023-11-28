#!/usr/bin/python2

import cgi

form = cgi.FieldStorage()

# Get values from form
city = form.getvalue('city')
province = form.getvalue('province') or ""  # Set a default value if province is None
country = form.getvalue('country')
picture_url = form.getvalue('picture')

# Process values
city = city.upper() if city is not None else ""
country = country.upper() if country is not None else ""

print("Content-type: text/html\n")
print("<html>")
print("<head>")
print("<title>Lab10 Python Script</title>")
print("<style>")
print("body {font-family: Arial, sans-serif;}")
print("h1 {text-align: center; color: white; background-color: #4CAF50; padding: 20px; font-size: 2em;}")
print("img {width: 80%; height: auto; border: 10px solid #4CAF50;}")
print("</style>")
print("</head>")
print("<body>")

print("<h1>{}, {}, {}</h1>".format(city, province, country))
print("<p style='text-align: center;'><a href='https://www2.cs.ryerson.ca/~aarcaina/Lab10/lab10b.html'> Go back </a></p>")
print("<img src='{}' alt='City Picture'>".format(picture_url))

print("</body>")
print("</html>")
