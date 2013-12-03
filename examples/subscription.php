<?php
/**
 * App Store In-App purchase receipt verification
 * @author alxmsl
 * @date 2/16/13
 */

include '../source/Autoloader.php';
include '../lib/Network/source/Autoloader.php';

/**
 * Define needed constants
 */
const   PASSWORD = 'secredsharedpassword',
        SANDBOX = true,
        RECEIPT = 'MySECReT5u8sCR1Pti0NRece1Pt=';

// Create App Store client for production or sandbox
$AppStore = new \AppStore\Client\AppStoreClient();
$AppStore->setPassword(PASSWORD)
    ->setSandbox(SANDBOX);

// Verify subscription receipt
try {
    var_dump($AppStore->verifyReceipt(RECEIPT));
} catch (\AppStore\Client\Response\ExpiredSubscriptionException $ex) {
    var_dump($ex->getStatus());
}
