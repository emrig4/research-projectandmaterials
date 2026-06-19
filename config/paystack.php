<?php

declare(strict_types=1);

/*
 *
 * This file is part of the Xeviant Laravel Paystack package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package         Laravel Paystack
 * @version         1.0
 * @author          Olatunbosun Egberinde
 * @license         MIT Licence
 * @copyright       (c) Olatunbosun Egberinde <bosunski@gmail.com>
 * @link            https://github.com/bosunski/lpaystack
 *
 */
/*
    


/*
 * Here you can specify different Paystack connection.
 */
$connections = [
    'test' => [
        'publicKey'     => env('PAYSTACK_PUBLIC_TEST_KEY', 'publicKey'),
        'secretKey'     => env('PAYSTACK_SECRET_TEST_KEY', 'secretKey'),
        'paymentUrl'    => env('PAYSTACK_PAYMENT_URL'),
        'merchantEmail' => env('MERCHANT_EMAIL'),
        'webhookUrl' => '/paystack/hook',
        'cache'         => false,
    ],
    'live' => [
        'publicKey'     => env('PAYSTACK_PUBLIC_KEY', 'publicKey'),
        'secretKey'     => env('PAYSTACK_SECRET_KEY', 'secretKey'),
        'paymentUrl'    => env('PAYSTACK_PAYMENT_URL'),
        'merchantEmail' => env('MERCHANT_EMAIL'),
        'webhookUrl' => '/paystack/hook',
        'cache'         => false,
    ],
];

// select connections here
return $connections['test'];