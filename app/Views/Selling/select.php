<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title-add">
  <div class="title"><h2><?=$page_title?></h2></div>
</div> <br/>
<div class="add"><a href="/selling/pdfgenerate" class="btn"><i class="bi bi-download"></i> Download PDF</a></div>
<table>
  <thead>
    <th>#</th>
    <th>Factur</th>
    <th>Date & Time</th>
    <th>Grand Total</th>
    <th>Payed Money</th>
    <th>Change</th>
    <th>Cashier</th>
    <th>Action</th>
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
        $html .='<td class="cashier_id">'.$row->cashier.'</td>';
        $html .='<td class="action"><a href="/sellingdetails/select/'.$row->factur.'" class="mr-2 h5 btn-see">See Details</a></td>';  
        $html .='</tr>';
      endforeach;    
      endif;
      echo $html;
  ?>
  </tbody>
</table>
<?=$this->endSection();?>