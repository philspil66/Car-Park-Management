<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Bruce Springsteen Information</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            body {
                font-family: arial, sans-serif;
                font-size:16px;
                color:#324146;
            }
            .order-summary {
                border:solid 1px #ccc;
                border-radius: 3px;
                
            }
            .order-summary-head {
                background-color: #ccc;
                padding:4px 10px;
            }
            .order-summary-content {
                padding:10px;
                font-size:12px;
                overflow:auto;
            }
            .order-summary-content ul {
                clear:both;
            }
            .order-summary-content li {
                float: left;
                list-style: none;
            }
            li.title {
                width: 70%;
            }
            li.price {
                width:50px;
                text-align: right;
            }
            ul.totals {
                font-weight: bold;
                padding-top: 10px;
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
                    
                    <p>With regard to the <strong>Bruce Springsteen</strong> concert tomorrow, please be advised that we are expecting the area around the Ricoh Arena to become very congested, both before and after the event. Please also be aware that it may take up to 90 minutes to leave the exits around the arena.</p>
                    
                    <p>Our teams will be available to help you, but please plan ahead and allow plenty of time for your journey.</p>

                    <p>See you at the event!</p>

                    @if($plate_id == 0)
                    <p>It appears we still do not have your car registration number for the event. 
                        You must provide the registration number before you can print an e-Ticket for the parking.</p>
                    <p>Please click on the link below (if clicking on the link doesn't work then you may copy the link, paste it in your browser address bar and press enter), 
                        login if requested and add your car registration number. </p>
                    <p>{{ $account_link }}</p>
                    <p>&nbsp;</p>
                    @endif
                    
                    <p>The Ricoh Arena Parking Team <br /><a href="mailto:support@ricoharenaparking.co.uk">support@ricoharenaparking.co.uk</a></p>
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
