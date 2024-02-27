// Get all product items
document.querySelectorAll(".product-item").forEach(function (product) {
  let quantity = 1; // Initial quantity for each product item

  // Get buttons within each product item
  let decrementButton = product.querySelector(".decrement");
  let incrementButton = product.querySelector(".increment");
  let quantitySpan = product.querySelector(".quantity");

  // Attach click event listeners to buttons within each product item
  decrementButton.addEventListener("click", function () {
    if (quantity > 1) {
      quantity--;
      quantitySpan.innerText = quantity;
    }
  });

  incrementButton.addEventListener("click", function () {
    quantity++;
    quantitySpan.innerText = quantity;
  });
});
