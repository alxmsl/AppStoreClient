AppStoreClient
==============

AppStore client for iTunes purchases receipts verification

Installation
-------

For install library completely, you need to include require configuration:

    "alxmsl/appstoreclient": "1.1.0"

Auto-renewable subscription receipt verification
-------
```php
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
```
Purchases receipt verification
-------
```php
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
```
