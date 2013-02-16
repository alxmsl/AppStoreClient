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
const   PASSWORD = 'secred shared password',
        SANDBOX = true,
        RECEIPT = 'receipt';

// Create App Store client for production or sandbox
$AppStore = new \AppStore\Client\AppStoreClient();
$AppStore->setPassword(PASSWORD)
    ->setSandbox(SANDBOX);

// Verify purchase receipt
var_dump($AppStore->verifyReceipt(RECEIPT));