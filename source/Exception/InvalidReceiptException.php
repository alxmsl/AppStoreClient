<?php

namespace alxmsl\AppStore\Exception;
use Exception;

/**
 * Base exception class for invalid receipts
 */
class InvalidReceiptException extends Exception {
    public static function getClass() {
        return get_called_class();
    }
}
