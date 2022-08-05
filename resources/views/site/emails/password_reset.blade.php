<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Password Reset</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            body {
                font-family: arial, sans-serif;
                font-size:16px;
                color:#324146;
            }
        </style>
    </head>
    <body>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="color:#465a64; border-collapse: collapse;">
            <tr>
                <td colspan="2" align="left" style="padding: 0;">
                    <img src="http://admin.expertavenue.co.uk/images/est_email_logo.png" alt="EST Email Banner" style="display: block;" />
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:20px 10px;">
                    <p><strong>Dear {{ $firstname }}</strong></p>
                    <p>This is an automated email to reset your password. Please click the link below to complete the process, 
                        if clicking on the link doesn't work then you may copy the link, paste it in your browser address bar and press enter:</p>
                    <p>&nbsp;</p>
                    {{ $password_reset_link }}
                    <p>&nbsp;</p>
                    <p>Thank you.</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="padding: 0;">
                    <img src="http://admin.expertavenue.co.uk/images/est_email_footer.png" alt="EST Email Banner" style="display: block;" />
                </td>
            </tr>
         </table>
    </body>
</html>
