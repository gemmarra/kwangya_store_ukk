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
      }
    </style>
</head>
<body>
    <h3>Product Report</h3>
    <h5>Kwangya Store</h5>
  <table class="w3-table w3-border w3-bordered">
    <thead>
      <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Category</th>
          <th>Stock</th>
          <th>Denomination</th>
          <th>Selling Price</th>
          <th>Purchase Price</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $html = ""; // Initialize $html before the loop
    $no = null;
    if(isset($ProductList) && is_array($ProductList) && count($ProductList) > 0) :
        foreach($ProductList as $row) : 
            $no++;
            $html .='<tr>'; 
            $html .='<td>'.$row->product_id.'</td>'; 
            $html .='<td>'.$row->product_name.'</td>'; 
            $html .='<td>'.$row->category_name.'</td>'; 
            $html .='<td>'.$row->stock.'</td>'; 
            $html .='<td>'.$row->denomination_name.'</td>'; 
            $html .='<td>'.number_format($row->selling_price, 2, ',', '.').'</td>'; 
            $html .='<td>'.number_format($row->purchase_price, 2, ',', '.').'</td>'; 
            $html .='</tr>';
        endforeach;    
    else:
        echo "ProductList is either not set or empty.";
    endif;
    echo $html;
?>
    </tbody>
  </table>
</body>
</html>