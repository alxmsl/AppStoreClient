<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 *
 * App Store In-App purchase receipt verification
 * @author alxmsl
 * @date 2/16/13
 */

include '../source/Autoloader.php';
include '../vendor/alxmsl/network/source/Autoloader.php';

use alxmsl\AppStore\Client;
use alxmsl\AppStore\Exception\ExpiredSubscriptionException;

/**
 * Define needed constants
 */
const PASSWORD = 'secredsharedpassword',
      SANDBOX = true,
      RECEIPT = 'MySECReT5u8sCR1Pti0NRece1Pt=';

// Create App Store client for production or sandbox
$AppStore = new Client();
$AppStore->setPassword(PASSWORD)
    ->setSandbox(SANDBOX);

// Verify subscription receipt
try {
    var_dump($AppStore->verifyReceipt(RECEIPT));
} catch (ExpiredSubscriptionException $ex) {
    var_dump($ex->getStatus());
}
