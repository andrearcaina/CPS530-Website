<%
Function IsValidColor(color)
    Dim regex
    Set regex = New RegExp
    regex.Pattern = "^[a-zA-Z]+$"
    IsValidColor = regex.Test(color)
End Function

Dim bgColor
bgColor = Request.QueryString("color")

If bgColor = "" Or Not IsValidColor(bgColor) Then
    bgColor = "white"
End If

Response.Write "<html><body style='background-color: " & bgColor & "; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh;'>"

If Request.Cookies("lastVisit") = "" Then
    Response.Write "<p style='font-size: 1.5rem; font-weight: bold;'>Welcome! This is your first visit.</p>"
Else
    Response.Write "<p style='font-size: 1.5rem; font-weight: bold;'>Your last visit was on: " & Request.Cookies("lastVisit") & "</p>"
End If

Response.Cookies("lastVisit") = Now()

Response.Write "<div style='font-size: 1.5rem; font-weight: bold; margin-bottom: 10px;'>Choose a color:</div>"
Response.Write "<div>"
Response.Write "<a href='?color=gray'>Gray</a> | <a href='?color=green'>Green</a> | <a href='?color=blue'>Blue</a> | <a href='?color=red'>Red</a> | <a href='?color=yellow'>Yellow</a> | <a href='?color=white'>White</a>"
Response.Write "</div>"
Response.Write "<a href='https://www.cs.ryerson.ca/~aarcaina/Lab10/lab10.html' style='margin: 50px;'>Back to Lab10.html</a>"
%>
</body></html>
