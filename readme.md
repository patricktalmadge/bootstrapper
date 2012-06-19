## Bootstraper Bundle, by Patrick Talmadge

Bootstraper is a set of classes that allow you to quickly create Twitter Bootstrap style markup.

Install using Artisan CLI:

	php artisan bundle:install bootstraper


Either auto-load the bundle in application/bundles.php:

	return array(
		'stripe' => array('auto'=>true)
	);

Or manually start:

	Bundle::start('stripe');

You can than use the Stripe API like normal (see Stripe API https://stripe.com/docs/api?lang=php)

	Stripe::setApiKey("YOUR_KEY");
	Stripe_Charge::create(array(
		"amount" => 40000,
		"currency" => "usd",
		"card" => "tok_Ydsdsedsad", // obtained with Stripe.js
		"description" => "Donation because you rock!")
	);


##Current Stripe API version is 1.7.1.


Stripe is an payment company with a simple API and a reasonable fee structure.

- Homepage:		   https://stripe.com/
- PHP API: 	  	   https://stripe.com/docs/api?lang=php
- Documentation:   https://stripe.com/docs 