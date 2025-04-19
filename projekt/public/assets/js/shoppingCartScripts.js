function updateTotal() {
    let total = 0;

    document.querySelectorAll('input[type="number"][name^="amounts"]').forEach(input => {
        const quantity = parseInt(input.value) || 0;

        const priceText = input.closest('.col-md-4').querySelector('p').textContent;
        const price = parseFloat(priceText.replace(/[^\d.]/g, ''));

        if (!isNaN(price)) {
            total += quantity * price;
        }
    });

    const totalElement = document.getElementById("cart-total");
    if (totalElement) {
        totalElement.textContent = `€${total.toFixed(2)}`;
    }
}

function sendQuantityUpdate(productId, quantity) {
    fetch('/shopping-cart/update-quantity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(`Quantity updated for product ${productId}`);
        } else {
            console.error(`Failed to update product ${productId}`);
        }
    })
    .catch(error => {
        console.error('Error updating cart:', error);
    });
}

document.addEventListener("DOMContentLoaded", function () {
    updateTotal();

    document.querySelectorAll('input[type="number"][name^="amounts"]').forEach(input => {
        input.addEventListener('input', function () {
            const productId = this.id.split('_')[1];
            const quantity = parseInt(this.value) || 0;

            updateTotal();
            sendQuantityUpdate(productId, quantity);
        });
    });
});
