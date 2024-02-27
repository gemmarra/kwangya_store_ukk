<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title-add">
  <div class="title"><h2><?=$page_title?></h2></div>
  <div class="add"><a id="myBtnAddCategory" class="btn"><i class="bi bi-plus"></i> Add</a></div>
</div>
<?php if (session()->getFlashdata('message') !== NULL) : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo session()->getFlashdata('message'); ?>
</div>
<?php endif; ?>
<?php if(isset($CategoryList)) : ?>
<table>
  <tbody>
  <?php
    if(isset($CategoryList)) :
    $html = null;
    $no = null;
    foreach($CategoryList as $row) : 
    $no++;
        $html .='<tr>'; 
        $html .='<td>'.$no.'</td>'; ; 
        $html .='<td>'.$row->category_name.'</td>'; ; 
        // $html .='<td><div class="editable" contenteditable="false" data-category-id="'.$row->category_id.'">'.$row->category_name.'</div></td>'; 
        $html .='<td class="action">';
        // $html .='<button type="button" class="btn-save d-none btn btn-see">Save</button>'; // Save button (initially hidden)
        $html .='<a href="/category/edit/'.$row->category_id.'" class="mr-2 h5 btn-edit"><i class="bi bi-pencil"></i></a>'; 
        $html .='<a href="/category/delete/'.$row->category_id.'" OnClick="return confirm(\'Apakah anda yakin akan menghapus ini?\')" class="btn-delete"><i class="bi bi-trash text-danger"></i></a>';
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