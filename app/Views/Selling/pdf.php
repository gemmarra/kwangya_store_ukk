<?php 
$querydate = "SELECT CURRENT_DATE";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
      h3 {
        font-weight:  bold;
        text-align: center;
      }

      h5{
        text-align: center;
      }

      table{
        border: 1px solid black;
        width: 100%;
      }
      td, th {
        font-size: 1.2rem;
        padding: 5px;
        text-align: start;
        border: 1px solid black;
        margin: 0;
        border-spacing: 0;
      }
      th {
        background-color: yellow;
      }
    </style>
</head>
<body>
    <h3>Selling Report</h3>
    <h5>Kwangya Store</h5>
  <table class="w3-table w3-border w3-bordered">
  <thead>
    <th>#</th>
    <th>Factur</th>
    <th>Date & Time</th>
    <th>Grand Total</th>
    <th>Payed Money</th>
    <th>Change</th>
    <th>Cashier</th>
  </thead>
  <tbody>
  <?php
    if(isset($SellingList)) :
    $html = null;
    $no = null;
    foreach($SellingList as $row) : 
    $no++;
        $html .='<tr>'; 
        $html .='<td>'.$no.'</td>'; 
        $html .='<td>'.$row->factur.'</td>'; 
        $html .='<td>'.$row->datetime.'</td>'; 
        $html .='<td>'.number_format($row->grand_total, 2, ',', '.').'</td>'; 
        $html .='<td>'.number_format($row->payed_money, 2, ',', '.').'</td>'; 
        $html .='<td>'.number_format($row->change_money, 2, ',', '.').'</td>'; 
        $html .='</tr>';
      endforeach;    
      endif;
      echo $html;
  ?>
  </tbody>
  </table>
</body>
</html>