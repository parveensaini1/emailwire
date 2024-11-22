<!-- app/View/Payments/subscribe.ctp -->
<h2>Subscription Payment</h2>

<form action="/payments/subscribe" method="POST" id="subscription-form">
    <div class="form-row">
        <label for="email">
            Email Address
        </label>
        <input type="email" name="email" required>

        <label for="card-element">
            Credit or Debit Card
        </label>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
    <button type="submit">Start Subscription</button>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('<?php echo Configure::read('Stripe.public'); ?>');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('subscription-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('subscription-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        form.submit();
    }
</script>