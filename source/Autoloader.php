<?php

namespace AppStore\Client;

// append autoloader
spl_autoload_register(array('\AppStore\Client\Autoloader', 'Autoloader'));

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
        'AppStore\\Client\\Autoloader'                  => 'Autoloader.php',
        'AppStore\\Client\\StringInitializedInterface'  => 'StringInitializedInterface.php',
        'AppStore\\Client\\ObjectInitializedInterface'  => 'ObjectInitializedInterface.php',
        'AppStore\\Client\\Client'                      => 'Client.php',
        'AppStore\\Client\\AppStoreClient'              => 'AppStoreClient.php',
        'AppStore\\Client\\Response\\Receipt'           => 'Response/Receipt.php',
        'AppStore\\Client\\Response\\RenewableReceipt'  => 'Response/RenewableReceipt.php',
        'AppStore\\Client\\Response\\Status'            => 'Response/Status.php',
        'AppStore\\Client\\Response\\RenewableStatus'   => 'Response/RenewableStatus.php',
    );

    /**
     * Component autoloader
     * @param string $className claass name
     */
    public static function Autoloader($className) {
        if (array_key_exists($className, self::$classes)) {
            $fileName = realpath(dirname(__FILE__)) . '/' . self::$classes[$className];
            if (file_exists($fileName)) {
                include $fileName;
            }
        }
    }
}
