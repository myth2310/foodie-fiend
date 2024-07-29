const quantityInput = document.getElementById('quantity-input');
const increaseButton = document.getElementById('increment-button');
const decreasetButton = document.getElementById('decrement-button');
const formOrder = document.getElementById('formOrder');

increaseButton.addEventListener('click', function() {
    quantityInput.value = parseInt(quantityInput.value) + 1;
});

decreasetButton.addEventListener('click', function() {
    if (quantityInput.value > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    }
});

quantityInput.addEventListener('input', function() {
    if (quantityInput.value === '' || quantityInput.value === '0') {
        quantityInput.value = 1;
    }
});

document.getElementById('checkoutSubmit').addEventListener('click', function() {
    formOrder.setAttribute('action', '/checkout');
    document.getElementById('hiddenSubmit').click();
});

document.getElementById('addToChartSubmit').addEventListener('click', function() {
    document.getElementById('hiddenSubmit').click();
});