AppStoreClient
==============

AppStore client for iTunes purchases receipts verification

Installation
-------

For install library completely, you need to update submodules after checkout. For example:

    git clone git://github.com/alxmsl/AppStoreClient.git temp
    && cd temp
    && git submodule init
    && git submodule update

Auto-renewable subscription receipt verification
-------

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
    var_dump($AppStore->verifyReceipt(RECEIPT));

Purchases receipt verification
-------

    include '../source/Autoloader.php';
    include '../lib/Network/source/Autoloader.php';

    const   SANDBOX = true,
            RECEIPT = 'MySECReTRece1Pt=';

    // Create App Store client for production or sandbox
    $AppStore = new \AppStore\Client\AppStoreClient();
    $AppStore->setSandbox(SANDBOX);

    // Verify purchase receipt
    var_dump($AppStore->verifyReceipt(RECEIPT));
