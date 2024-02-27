<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title-add">
  <div class="title"><h2><?=$page_title?></h2></div>
  <div class="add"><a id="myBtnAddDenomination" class="btn"><i class="bi bi-plus"></i> Add</a></div>
</div>
<?php if (session()->getFlashdata('message') !== NULL) : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo session()->getFlashdata('message'); ?>
</div>
<?php endif; ?>
<?php if(isset($DenominationList)) : ?>
<table>
  <tbody>
  <?php
    if(isset($DenominationList)) :
    $html = null;
    $no = null;
    foreach($DenominationList as $row) : 
    $no++;
        $html .='<tr>'; 
        $html .='<td>'.$no.'</td>';  
        $html .='<td>'.$row->denomination_name.'</td>'; 
        $html .='<td class="action">';
        $html .='<a href="/denomination/edit/'.$row->denomination_id.'" class="mr-2 h5 btn-edit"><i class="bi bi-pencil"></i></a>'; 
        $html .='<a href="/denomination/delete/'.$row->denomination_id.'" OnClick="return confirm(\'Apakah anda yakin akan menghapus ini?\')" class="btn-delete"><i class="bi bi-trash text-danger"></i></a>';
        $html .='</td>';
        $html .='</tr>';
      endforeach;    
      endif;
      echo $html;
  ?>
  </tbody>
</table>
<?php endif; ?>
<?=$this->endSection();?>