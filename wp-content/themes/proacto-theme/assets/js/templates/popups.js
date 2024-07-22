jQuery(document).ready(function($) {

    // Bind to the event when a product is added to the cart
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
        $('#added_to_cart_popup').addClass('opened')
        window.setTimeout(function() {
            $('#added_to_cart_popup').removeClass('opened')
        }, 1500)

        $.ajax({
            url: proacto_vars.ajax_url,
            type: 'POST',
            data: {
                action: 'get_cart_quantity',
                nonce: proacto_vars.nonce
            },
            success: function(response) {
                if (response.success) {
                    console.log('Cart Quantity: ' + response.data.quantity);
                    // Update the cart quantity on the front-end
                    $('#header_cart-count').text(response.data.quantity);
                } else {
                    console.log('Error: ' + response.data);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + error);
            }
        });
    })
})

const popups = document.querySelectorAll('.pr-popup')
popups.forEach(popup => {
    popup.addEventListener('click', function(e) {
        this.classList.remove('opened')
    })

    const wrap = popup.querySelector('.pr-popup__wrap')
    wrap.addEventListener('click', function(e) {
        e.stopPropagation()
    })
})

const buttonsClosers = document.querySelectorAll('.closer')
buttonsClosers.forEach(closer => {
    closer.addEventListener('click', function(e) {
        e.preventDefault();
        let target = this.dataset.close
        console.log(target)
        if(target) {
            const closeTarget = document.getElementById(target)
            closeTarget.classList.remove('opened')
        }
    })
})

