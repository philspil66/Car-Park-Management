<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>

</head>
<body>

         <table style="width:900px;">
             <tr><td colspan="2" align="center">{{$title}}<br /><br /></td></tr>
        @for($i=0; $i<count($results); $i++)
             <tr>
                 <td style="width:49%;">        
                    <?php $result = $results[$i]; ?>
                     <table style="" cellpadding="0" cellspacing="0">
                         <tr style="border-bottom:solid 1px #ccc;">
                             @if ($sorting == 'name')
                             <td style="width:150px;border-bottom:solid 1px #ccc;">{{ ucwords($result->lastname) }},</td>
                             <td style="width:150px;border-bottom:solid 1px #ccc;">{{ ucwords($result->firstname) }}</td>
                             <td style="width:100px;border-bottom:solid 1px #ccc;">{{ strtoupper($result->plate_number)?strtoupper($result->plate_number):'?' }}</td>
                             @else
                             <td style="width:100px;border-bottom:solid 1px #ccc;">{{ strtoupper($result->plate_number)?strtoupper($result->plate_number):'?' }}</td>
                             <td style="width:150px;border-bottom:solid 1px #ccc;">{{ ucwords($result->lastname) }},</td>
                             <td style="width:150px;border-bottom:solid 1px #ccc;">{{ ucwords($result->firstname) }}</td>
                             @endif
                         </tr>
                     </table>
                 </td>
                
                <?php $i++; ?>
                 <td style="width:49%; ">    
                @if( $i<count($results) )
                <?php $result = $results[$i]; ?>
                     <table style="" cellpadding="0" cellspacing="0">
                         <tr style="border-botton:solid 1px #ccc;">
                             @if ($sorting == 'name')
                             <td style="width:150px;border-bottom:solid 1px #ccc;">{{ ucwords($result->lastname) }},</td>
                             <td style="width:150px;border-bottom:solid 1px #ccc;">{{ ucwords($result->firstname) }}</td>
                             <td style="width:100px;border-bottom:solid 1px #ccc;">{{ strtoupper($result->plate_number)?strtoupper($result->plate_number):'?' }}</td>
                             @else
                             <td style="width:100px;border-bottom:solid 1px #ccc;">{{ strtoupper($result->plate_number)?strtoupper($result->plate_number):'?' }}</td>
                             <td style="width:150px;border-bottom:solid 1px #ccc;">{{ ucwords($result->lastname) }},</td>
                             <td style="width:150px;border-bottom:solid 1px #ccc;">{{ ucwords($result->firstname) }}</td>
                             @endif
                         </tr>
                     </table>
                @endif
                 </td>            
             </tr>            
        @endfor
        
         </table>

</body>
</html>

