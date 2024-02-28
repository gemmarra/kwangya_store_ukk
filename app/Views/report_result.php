<?=$this->extend('layout');?>
<?=$this->section('content');?>

<div class="title-add">
  <div class="title"><h2><?=$range?> report of <?=$month; echo '/';?><?=$year?></h2></div>
</div> <br/>
<table id="myTable">
  <thead>
    <th style="text-align:start;">Product Name</th>
    <th style="text-align:end;">Selling Price</th>
    <th style="text-align:end;">Purchase Price</th>
    <th style="text-align:end;">Selling Total</th>
    <th style="text-align:end;">Profit Total</th>
  </thead>
  <tbody>
    <tr>
        <td><?=$detail_selling[0]['product_name'] ?></td>
        <td><?=number_format($detail_selling[0]['selling_price'],  2, ',', '.') ?></td>
        <td><?=number_format($detail_selling[0]['purchase_price'],  2, ',', '.'); ?></td>
        <td><?=number_format($total_selling, 2, ',', '.')?></td>
        <td><?=number_format($total_profit, 2, ',', '.')?></td>
    </tr>
  </tbody>
</table>
<?=$this->endSection();?>