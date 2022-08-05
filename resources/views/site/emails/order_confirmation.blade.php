<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Booking Confirmation</title>
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
                    <p>Below you can find links to download your eTicket(s) for your upcoming events.</p>
                    
                    <p>&nbsp;</p>
                    <p><strong>On the day</strong></p>
                    <p>Please click the link below to login to your account, print eTicket and display it in your windscreen before reaching the car park. You may need this to gain entry.</p>
                    <a href="{{ $account_link }}">{{ $account_link }}</a>
                    
                    <p>&nbsp;</p>
                    <p><strong>Here to help</strong></p>
                    <p>Follow the link below for useful information on our Car Parks: <a href="{{ $carparks_link }}">{{ $carparks_link }}</a></p>
                    <p>Our teams will be available to help you on the day, but should you have any questions prior to the event concerning your booking please get in touch with us as soon as possible.</p>
                    <p>See you at the event!</p>

                    <div class="order-summary">
                        <div class="order-summary-head">Order Summary - ref #{{ $order_ref }}</div>
                        <div class="order-summary-content">
                            @foreach($order_details as $order_detail)
                            <ul>
                            <li class="title">{{ $order_detail['product'] }} - £ {{ $order_detail['price'] }}</li>
                            </ul>
                            @endforeach
                            <ul class="totals"><li class="title">Total: - £ {{ $total }}</li></ul>
                        </div>
                    </div>

                    <p>&nbsp;</p>
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
