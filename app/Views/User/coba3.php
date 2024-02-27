<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Your HTML and table structure -->
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price Total</th>
        </tr>
    </thead>
    <tbody>
        <!-- Iterate over all details and display each row -->
        <?php foreach ($allDetails as $detail): ?>
            <tr>
                <td><?= $detail->product_name ?></td>
                <td><?= $detail->quantity ?></td>
                <td><?= $detail->price_total ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>
</html>