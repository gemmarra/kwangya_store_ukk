<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title-add">
  <div class="title"><h2><?=$page_title?></h2></div>
  <div class="add"><a href="/product/insert" class="btn"><i class="bi bi-plus"></i> Add</a></div>
</div> <br/>
<div class="add"><a href="/product/pdfgenerate" class="btn"><i class="bi bi-download"></i> Download PDF</a></div>
<?php if (session()->getFlashdata('message') !== NULL) : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo session()->getFlashdata('message'); ?>
</div>
<?php endif; ?>
<?php if(isset($ProductList)) : ?>
<table>
<thead>
      <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Category</th>
          <th>Stock</th>
          <th>Denomination</th>
          <th>Selling Price</th>
          <th>Purchase Price</th>
          <th>Action</th>
      </tr>
    </thead>
  <tbody>
  <?php
    if(isset($ProductList)) :
    $html = null;
    $no = null;
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
        $html .='<td class="action">';
        $html .='<a href="/product/edit/'.$row->product_id.'" class="mr-2 h5 btn-edit"><i class="bi bi-pencil"></i></a>'; 
        $html .='<a href="/product/delete/'.$row->product_id.'" OnClick="return confirm(\'Apakah anda yakin akan menghapus ini?\')" class="btn-delete"><i class="bi bi-trash text-danger"></i></a>';
        $html .='</td>';
        $html .='</tr>';
      endforeach;    
      endif;
      echo $html;
  ?>
  </tbody>
</table>
<?php
endif;
?>
<?=$this->endSection();?>