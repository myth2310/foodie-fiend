import os
import sys
import json
import base64
import smtplib
from smtplib import SMTPException
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from string import Template
from jinja2 import Environment, FileSystemLoader

def read_template(filename):
    with open(filename, 'r', encoding='utf-8') as file:
        template_content = file.read()
    return Template(template_content)

def send_email(**kwargs) -> str:    
    SMTP_SERVER: str = kwargs.get('smtp_server')
    SMTP_PORT: int = kwargs.get('smtp_port')
    SMTP_USERNAME: str = kwargs.get('smtp_username')
    SMTP_PASSWORD: str = kwargs.get('smtp_password')

    from_email: str = f"Foodie Fiend <{kwargs.get('from_email')}>"
    to_email: str = f"Foodies <{kwargs.get('to_email')}>"
    email_type: str = kwargs.get('email_type')
    subject: str = kwargs.get('subject')
    name: str = kwargs.get('name')
    verif_link: str = kwargs.get('verif_link')
    template_dir = os.path.join(os.path.dirname(__file__), '..', 'templates')
    env = Environment(loader=FileSystemLoader(template_dir))
    template = env.get_template(kwargs.get('template'))
    html_content = template.render(kwargs)
    
    msg = MIMEMultipart('alternative')
    msg['From'] = from_email
    msg['To'] = to_email
    msg['Subject'] = subject
    msg.attach(MIMEText(html_content, email_type))

    try:
        with smtplib.SMTP(SMTP_SERVER, SMTP_PORT) as server:
            server.starttls()
            server.login(SMTP_USERNAME, SMTP_PASSWORD)
            server.sendmail(from_email, to_email, msg.as_string())
        return 'Email berhasil dikirim!'
    except SMTPException as err:
        return f'SMTPException reached: {str(err)}'
    except Exception as err:
        return str(err)

if __name__ == "__main__":
    kwargs = json.loads(base64.b64decode(sys.argv[1]).decode('utf-8'))
    result = send_email(**kwargs)
    print(result)