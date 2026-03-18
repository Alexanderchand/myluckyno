$(function () {
    const toastWrap = $('<div class="toast-wrap"></div>').appendTo('body');

    function showToast(message, type = 'success') {
        const toast = $(`
            <div class="toast align-items-center text-bg-${type} border-0 show mb-2" role="alert">
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"></button>
                </div>
            </div>
        `);
        toast.find('.btn-close').on('click', () => toast.remove());
        toastWrap.append(toast);
        setTimeout(() => toast.fadeOut(300, () => toast.remove()), 2500);
    }

    function refreshCart() {
        $.getJSON('ajax/cart.php', { action: 'view' }, function (response) {
            $('#cart-items').html(response.html);
            $('.cart-count').text(response.count);
        });
    }

    function refreshWishlist() {
        $.getJSON('ajax/wishlist.php', { action: 'view' }, function (response) {
            $('#wishlist-items').html(response.html);
            $('.wishlist-count').text(response.count);
        });
    }

    function filterProducts(category) {
        $.getJSON('ajax/filter_products.php', { category }, function (response) {
            $('#product-list').html(response.html);
            $('#product-count').text(response.count);
        });
    }

    refreshCart();
    refreshWishlist();

    $(document).on('click', '.filter-btn', function () {
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        filterProducts($(this).data('category'));
    });

    $(document).on('click', '.add-cart-btn', function () {
        $.post('ajax/cart.php', {
            action: 'add',
            product_id: $(this).data('id'),
            csrf_token: window.APP.csrfToken
        }, function (response) {
            refreshCart();
            showToast(response.message || 'Added to cart');
        }, 'json');
    });

    $(document).on('change', '.cart-qty', function () {
        $.post('ajax/cart.php', {
            action: 'update',
            product_id: $(this).data('id'),
            quantity: $(this).val(),
            csrf_token: window.APP.csrfToken
        }, function (response) {
            refreshCart();
            showToast(response.message || 'Cart updated');
        }, 'json');
    });

    $(document).on('click', '.remove-cart-btn', function () {
        $.post('ajax/cart.php', {
            action: 'remove',
            product_id: $(this).data('id'),
            csrf_token: window.APP.csrfToken
        }, function (response) {
            refreshCart();
            showToast(response.message || 'Item removed', 'danger');
        }, 'json');
    });

    $(document).on('click', '.wishlist-btn', function () {
        $.post('ajax/wishlist.php', {
            action: 'add',
            product_id: $(this).data('id'),
            csrf_token: window.APP.csrfToken
        }, function (response) {
            refreshWishlist();
            showToast(response.message || 'Added to wishlist');
        }, 'json');
    });

    $(document).on('click', '.remove-wishlist-btn', function () {
        $.post('ajax/wishlist.php', {
            action: 'remove',
            product_id: $(this).data('id'),
            csrf_token: window.APP.csrfToken
        }, function (response) {
            refreshWishlist();
            showToast(response.message || 'Removed from wishlist', 'danger');
        }, 'json');
    });

    $('#login-form').on('submit', function (event) {
        event.preventDefault();
        $.post('auth/login.php', $(this).serialize(), function (response) {
            showToast(response.message, response.status === 'success' ? 'success' : 'danger');
            if (response.status === 'success') {
                $('#login-form')[0].reset();
            }
        }, 'json');
    });

    $('#register-form').on('submit', function (event) {
        event.preventDefault();
        $.post('auth/register.php', $(this).serialize(), function (response) {
            showToast(response.message, response.status === 'success' ? 'success' : 'danger');
            if (response.status === 'success') {
                $('#register-form')[0].reset();
            }
        }, 'json');
    });

    $('#contact-form').on('submit', function (event) {
        event.preventDefault();
        $.post('contact_submit.php', $(this).serialize(), function (response) {
            showToast(response.message, response.status === 'success' ? 'success' : 'danger');
            if (response.status === 'success') {
                $('#contact-form')[0].reset();
            }
        }, 'json');
    });
});
