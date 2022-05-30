Hello, {{ $email_data['name'] }}
<br><br>
Welcome to Praktikum Pemrograman Internet 2022!
<br>
Please click the link down below to verify your email and activate you account!
<br><br>
<a href="http://127.0.0.1:8000/admin/verify?code={{ $email_data['verification_code'] }}">Click here!</a>

<br><br>
Thank you!
<br>
praktikumprognet12