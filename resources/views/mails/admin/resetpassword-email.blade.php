Hello, {{ $email_data['name'] }}
<br><br>
Welcome to Praktikum Pemrograman Internet 2022!
<br>
Here is the link to your Email password reset page. 
<br><br>
<a href="http://127.0.0.1:8000/admin/verify-reset?code={{ $email_data['verification_code'] }}">Click here!</a>

<br><br>

If you don't feel like asking for reseting your password, please ignore this Email

<br><br>
Thank you!
<br>
praktikumprognet12