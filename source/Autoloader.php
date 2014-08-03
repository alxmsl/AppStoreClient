<?php

namespace alxmsl\AppStore;

// append autoloader
spl_autoload_register(array('\AppStore\Client\Autoloader', 'autoload'));

/**
 * AppStore Client classes autoloader
 * @author alxmsl
 * @date 1/13/13
 */
final class Autoloader {
    /**
     * @var array array of available classes
     */
    private static $classes = array(
        'alxmsl\\AppStore\\Autoloader'                 => 'Autoloader.php',
        'alxmsl\\AppStore\\StringInitializedInterface' => 'StringInitializedInterface.php',
        'alxmsl\\AppStore\\ObjectInitializedInterface' => 'ObjectInitializedInterface.php',
        'alxmsl\\AppStore\\AbstractClient'             => 'AbstractClient.php',
        'alxmsl\\AppStore\\Client'                     => 'Client.php',

        'alxmsl\\AppStore\\Response\\Receipt'          => 'Response/Receipt.php',
        'alxmsl\\AppStore\\Response\\RenewableReceipt' => 'Response/RenewableReceipt.php',
        'alxmsl\\AppStore\\Response\\Status'           => 'Response/Status.php',
        'alxmsl\\AppStore\\Response\\RenewableStatus'  => 'Response/RenewableStatus.php',

        'alxmsl\\AppStore\\Exception\\ExpiredSubscriptionException'        => 'Exception/ExpiredSubscriptionException.php',
        'alxmsl\\AppStore\\Exception\\InvalidReceiptException'             => 'Exception/InvalidReceiptException.php',
        'alxmsl\\AppStore\\Exception\\MalformedReceiptDataException'       => 'Exception/MalformedReceiptDataException.php',
        'alxmsl\\AppStore\\Exception\\ProductionReceiptOnSandboxException' => 'Exception/ProductionReceiptOnSandboxException.php',
        'alxmsl\\AppStore\\Exception\\SandboxReceiptOnProductionException' => 'Exception/SandboxReceiptOnProductionException.php',
        'alxmsl\\AppStore\\Exception\\UnauthenticatedReceiptException'     => 'Exception/UnauthenticatedReceiptException.php',
        'alxmsl\\AppStore\\Exception\\UnavailableServerException'          => 'Exception/UnavailableServerException.php',
        'alxmsl\\AppStore\\Exception\\UnmatchedSharedSecretException'      => 'Exception/UnmatchedSharedSecretException.php',
        'alxmsl\\AppStore\\Exception\\UnreadableRequestException'          => 'Exception/UnreadableRequestException.php',
    );

    /**
     * Component autoloader
     * @param string $className claass name
     */
    public static function autoload($className) {
        if (array_key_exists($className, self::$classes)) {
            $fileName = realpath(dirname(__FILE__)) . '/' . self::$classes[$className];
            if (file_exists($fileName)) {
                include $fileName;
            }
        }
    }
}
