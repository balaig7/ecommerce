<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
// Used for composer based installation
require __DIR__  . '/vendor/autoload.php';

// After Step 1
$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AaUgQAzHMI1FqSdE-acpDkel1dOmk0yxK90gESkKIfX4TESaKjAxx5AxpAMPjAG5ZpdBZGaa9wq9CJ72',     // ClientID
            'EJU9Q4WFNYUvWy3HgJBNfqx_s7q_LE3a7IBlGGCT7wSkXZ5FYqKpPskRnK5TUfBH8iY1AfqW0rNGIu6-'      // ClientSecret
        )
);