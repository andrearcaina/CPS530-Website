#!/usr/bin/ruby -w

require 'cgi'
cgi = CGI.new

city = cgi['city'].capitalize
province = cgi['province'].capitalize
country = cgi['country'].capitalize
picture_url = cgi['picture']

puts "Content-type: text/html\n\n"
puts "<html>"
puts "<head>"
puts "<title>Lab10 Ruby Script</title>"
puts "<style>"
puts "body {font-family: Roboto, monospace;}"
puts "h1 {text-align: center; color: white; background-color: #4CAF50; padding: 20px; font-size: 2em;}"
puts "img {width: 80%; height: auto; border: 10px solid #4CAF50; text-align: center; display: block; margin: 0 auto;}"
puts "</style>"
puts "</head>"
puts "<body>"

puts "<h1>#{city}, #{province}, #{country}</h1>"
puts "<p style='text-align: center;'><a href='https://www2.cs.ryerson.ca/~aarcaina/Lab10/lab10b.html'> Go back </a></p>"
puts "<img src='#{picture_url}' alt='City Picture'>" 
puts "</body>"
puts "</html>"
