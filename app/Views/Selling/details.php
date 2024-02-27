<?=$this->extend('Selling/cashier_machine');?>
<?=$this->section('details');?>

<table id="cart-table" class="cart-table">
        <tbody>
    <?php foreach($sellingDetails as $detail): ?>
    <tr>
        <td><?php echo $detail->product_name; ?></td>
        <td><?php echo $detail->quantity; ?></td>
        <td><?php echo $detail->price_total; ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>

        </table>

<?=$this->endSection();?>