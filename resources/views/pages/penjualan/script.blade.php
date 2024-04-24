    <script>
        document.querySelectorAll('.plus-btn').forEach(btn => {
            btn.addEventListener('click', function(event) {
                let quantityInput = event.target.parentElement.querySelector('.quantity');
                let currentValue = parseInt(quantityInput.value);
                let price = parseFloat(event.target.closest('.card').querySelector('.harga').value);
                quantityInput.value = currentValue + 1;

                let subtotal = (currentValue + 1) * price; // Perhatikan disini perubahan currentValue + 1
                event.target.closest('.card').querySelector('.subtotal').innerText = "Subtotal: Rp. " +
                    subtotal.toFixed(2);
            });
        });

        document.querySelectorAll('.minus-btn').forEach(btn => {
            btn.addEventListener('click', function(event) {
                let quantityInput = event.target.parentElement.querySelector('.quantity');
                let currentValue = parseInt(quantityInput.value);
                let harga = parseFloat(event.target.closest('.card').querySelector('.harga').value);
                if (currentValue > 0) {
                    quantityInput.value = currentValue - 1;

                    let subtotal = (currentValue - 1) *
                        harga; // Perhatikan disini perubahan currentValue - 1
                    event.target.closest('.card').querySelector('.subtotal').innerText = "Subtotal: Rp. " +
                        subtotal.toFixed(2);
                }
            });
        });
    </script>