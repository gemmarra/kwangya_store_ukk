<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coba</title>
    <style>
    .long-textarea {
        width: 200px; /* Set your desired width */
        resize: none; /* Optional: disable resizing */
    }
</style>
</head>
<body>
    <h1>Kalau mau coba-coba code disini</h1>
    <hr>
    <textarea class="long-textarea">This is a long text that will wrap under the fixed width.</textarea>
<hr>
    <!-- HTML for the product cards -->
<?php if(isset($ProductList)) :
    foreach($ProductList as $row) :?>
        <div class="product-item" data-name="<?= $row->product_name ?>" data-price="<?= $row->selling_price ?>">
            <div class="category"><?= strtoupper($row->category_name) ?></div>
            <div class="name"><?= $row->product_name ?></div>
            <div class="price"><?= $row->selling_price ?></div>
            <div class="amount">
                <input type="number" name="quantity" min="1" class="input-number">
            </div>
            <button class="btn btn-add">Add</button>
        </div>
<?php endforeach;
endif;?>

<!-- HTML for the table -->
<table id="cart-table">
    <thead>
        <tr>
            <th>Category</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <!-- Table body will be populated dynamically -->
    </tbody>
</table>

<!-- JavaScript to handle adding products to the table -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all product cards
        const productItems = document.querySelectorAll('.product-item');

        // Add click event listener to each product card
        productItems.forEach(product => {
            product.addEventListener('click', function() {
                // Extract data from the clicked product card
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                const quantity = 1; // Default quantity

                // Check if a row with the same product already exists in the table
                const existingRow = document.querySelector(`#cart-table tbody tr[data-name="${name}"]`);
                if (existingRow) {
                    // If row exists, update the quantity
                    const existingQuantity = existingRow.querySelector('.quantity').innerText;
                    existingRow.querySelector('.quantity').innerText = parseInt(existingQuantity) + 1;
                } else {
                    // If row does not exist, create a new row
                    const newRow = document.createElement('tr');
                    newRow.setAttribute('data-name', name);
                    newRow.innerHTML = `
                        <td>${name}</td>
                        <td>${price}</td>
                        <td class="quantity">${quantity}</td>
                    `;

                    // Append the new row to the table body
                    document.querySelector('#cart-table tbody').appendChild(newRow);
                }
            });
        });
    });
</script>


    
</body>
</html>