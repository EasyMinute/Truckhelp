document.addEventListener('DOMContentLoaded', function () {
    // Function to handle the 'chosen' class
    function updateChosenClass() {
        // Remove 'chosen' class from all payment method list items
        document.querySelectorAll('.wc_payment_method').forEach(function (li) {
            li.classList.remove('chosen');
        });

        // Add 'chosen' class to the parent of the checked radio input
        const checkedInput = document.querySelector('.input-radio:checked');
        if (checkedInput) {
            checkedInput.closest('.wc_payment_method').classList.add('chosen');
        }
    }

    // Run the function on page load
    updateChosenClass();

    // Event delegation for input-radio change
    document.body.addEventListener('change', function (event) {
        if (event.target.matches('.input-radio')) {
            updateChosenClass();
        }
    });

    // Re-run the function after WooCommerce updates the checkout via AJAX
    jQuery(document.body).on('updated_checkout', function () {
        updateChosenClass();
    });
});
