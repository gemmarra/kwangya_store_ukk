<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title-add">
  <div class="title"><h2><?=$page_title?></h2></div>
  <div class="add"><a href="/user/insert" class="btn"><i class="bi bi-plus"></i> Add</a></div>
</div>
<?php if (session()->getFlashdata('message') !== NULL) : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo session()->getFlashdata('message'); ?>
</div>
<?php endif; ?>
<?php if(isset($UserList)) : ?>
<table>
  <tbody>
  <?php
    if(isset($UserList)) :
    $html = null;
    $no = null;
    foreach($UserList as $row) : 
    $no++;
        $html .='<tr>'; 
        $html .='<td>'.$row->email.'</td>'; 
        $html .='<td>'.$row->name.'</td>'; 
        $html .='<td>'.$row->role.'</td>'; 
        $html .='<td class="action">';
        $html .='<a href="/user/edit/'.$row->email.'" class="mr-2 h5 btn-edit"><i class="bi bi-pencil"></i></a>'; 
        $html .='<a href="/user/delete/'.$row->email.'" OnClick="return confirm(\'Apakah anda yakin akan menghapus ini?\')" class="btn-delete"><i class="bi bi-trash text-danger"></i></a>';
        $html .='<a href="/user/edit_password/'.$row->email.'" class="btn-see"><i class="bi bi-key"></i></a>';
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