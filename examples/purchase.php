<?php
/**
 * App Store In-App purchase receipt verification
 * @author alxmsl
 * @date 2/16/13
 */

include '../source/Autoloader.php';
include '../vendor/alxmsl/network/source/Autoloader.php';

use alxmsl\AppStore\Client;

/**
 * Define needed constants
 */
const SANDBOX = true,
      RECEIPT = 'MySECReTRece1Pt=';

// Create App Store client for production or sandbox
$AppStore = new Client();
$AppStore->setSandbox(SANDBOX);

// Verify purchase receipt
var_dump($AppStore->verifyReceipt(RECEIPT));
