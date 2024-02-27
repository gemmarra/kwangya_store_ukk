<?=$this->extend('layout');?>
<?=$this->section('content');?>


<div class="title-add">
  <div class="title"><h2><?=$page_title?></h2> </div>
</div>
<div class="title-add">
  <!-- <div class="title"><h2><?=$page_title?></h2> </div> -->
</div>
<table class="selling-details">
  <tbody>
<?php
    if(isset($SellingDetailsList)) :
    $html = null;
    $no = null;
    foreach($SellingDetailsList as $row) : 
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
<?=$this->endSection();?>