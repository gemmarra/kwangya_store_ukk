<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tbody>
        <?php
            if(isset($sellingdetails)) :
            $html = null;
            $no = null;
            foreach($sellingdetails as $row) : 
        ?>
        <?php
            $no++;
                $html .='<tr>'; 
                $html .='<td>'.$row->product_name.'</td>'; 
                $html .='<td>'.$row->quantity.'</td>'; 
                $html .='<td>'.number_format($row->price_total, 2, ',', '.').'</td>';
                $html .='</tr>';
            endforeach;    
            endif;
            echo $html;
        ?>
        </tbody>
    </table>
</body>
</html>