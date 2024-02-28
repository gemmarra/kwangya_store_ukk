<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title-add">
  <div class="title"><h2><?=$page_title?></h2></div>
  <div class="add"><a href="/purchase/insert" class="btn"><i class="bi bi-plus"></i> Add</a></div>
</div>
<?php if (session()->getFlashdata('message') !== NULL) : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo session()->getFlashdata('message'); ?>
</div>
<?php endif; ?>
<?php if(isset($PurchaseList)) : ?>
<table id="myTable">
  <thead>
    <th>#</th>
    <th>Date & Time</th>
    <th>Expenditure Total</th>
    <th>Action</th>
  </thead>
  <tbody>
  <?php
    if(isset($PurchaseList)) :
    $html = null;
    $no = null;
    foreach($PurchaseList as $row) : 
    $no++;
        $html .='<tr>'; 
        $html .='<td>'.$no.'</td>'; 
        $html .='<td>'.$row->datetime.'</td>'; 
        $html .='<td>'.number_format($row->expenditure_total, 2, ',', '.').'</td>'; 
        $html .='<td><a href="/uploads/receipt/'. $row->receipt_image.'" download="purchase-receipt-'. $row->datetime.'" class="btn">Download Receipt</a></td>';
        // $html .='<td><img class="table-image" src="/uploads/'.$row->image.'" alt="'.$row->image.'" class="image"></td>'; 
        //$html .='<td class="action">';
        //$html .='<a href="/purchase/edit/'.$row->purchase_id.'" class="mr-2 h5 btn-edit"><i class="bi bi-pencil"></i></a>'; 
        //$html .='<a href="/purchase/delete/'.$row->purchase_id.'" OnClick="return confirm(\'Apakah anda yakin akan menghapus ini?\')" class="btn-delete"><i class="bi bi-trash text-danger"></i></a>';
        //$html .='</td>';
        $html .='</tr>';
      endforeach;    
      endif;
      echo $html;
  ?>
  </tbody>
</table>
<?php endif; ?>
<?=$this->endSection();?>