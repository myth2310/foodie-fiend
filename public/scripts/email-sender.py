import smtplib

sender = "Foodie Fiend <mailtrap@microsaas.my.id>"
receiver = "A Test User <rezaayuningtias642@gmail.com>"

message = f"""\
Subject: Hi Foodie Fiend with Mailtrap
To: {receiver}
From: {sender}

This is a test e-mail message."""

with smtplib.SMTP("live.smtp.mailtrap.io", 587) as server:
    server.starttls()
    server.login("api", "12d5d9b9d1cbf4ba4641a26cc6eacaad")
    server.sendmail(sender, receiver, message)

print('Email has sent')