<?php

namespace AppStore\Client\Response;

use AppStore\Client\StringInitializedInterface;

/**
 * Class for iTunes status of receipt
 * @author alxmsl
 * @date 2/14/13
 */ 
class Status implements StringInitializedInterface {
    /**
     * Status code constants
     */
    const   STATUS_INVALID                          = -1,
            STATUS_OK                               = 0,
            STATUS_UNREADABLE_JSON_OBJECT           = 21000,
            STATUS_MALFORMED_RECEIPT_DATA           = 21002,
            STATUS_UNAUTHENTICATED_RECEIPT          = 21003,
            STATUS_UNAVAILABLE_SERVER               = 21005,
            STATUS_IS_SANDBOX_RECEIPT_ON_PRODUCTION = 21007,
            STATUS_IS_PRODUCTION_RECEIPT_ON_SANDBOX = 21008;

    /**
     * @var int receipt status code
     */
    private $status = self::STATUS_INVALID;

    /**
     * @var Receipt receipt object
     */
    private $Receipt = null;

    /**
     * Setter for receipt object
     * @param Receipt $Receipt receipt object
     * @return Status self
     */
    protected function setReceipt(Receipt $Receipt) {
        $this->Receipt = $Receipt;
        return $this;
    }

    /**
     * Getter for receipt object
     * @return Receipt receipt object
     */
    public function getReceipt() {
        return $this->Receipt;
    }

    /**
     * Setter for receipt status code
     * @param int $status receipt status code
     * @return Status self
     */
    protected function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    /**
     * Getter for receipt status code
     * @return int receipt status code
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Initialization method
     * @param string $string data for object initialization
     * @throws InvalidReceiptException when receipt status code is invalid
     * @return Status initialized status object
     */
    public static function initializeByString($string) {
        $Object = json_decode($string);
        $result = self::checkStatus($Object->status);
        if ($result === true) {
            $Status = new self();
            $Status->setStatus($Object->status)
                ->setReceipt(Receipt::initializeByObject($Object->receipt));
            return $Status;
        } else {
            $Exception = new $result($string, $Object->status);
            throw $Exception;
        }
    }

    /**
     * Define exception class by receipt status code
     * @param int $status receipt status code
     * @return bool|string exception class name for inalid status codes or TRUE for correct code
     */
    protected static function checkStatus($status) {
        switch ($status) {
            case Status::STATUS_OK:
                return true;
            case self::STATUS_UNREADABLE_JSON_OBJECT:
                return UnreadableRequestException::getClass();
            case self::STATUS_MALFORMED_RECEIPT_DATA:
                return MalformedReceiptDataException::getClass();
            case self::STATUS_UNAUTHENTICATED_RECEIPT:
                return UnauthenticatedReceiptException::getClass();
            case self::STATUS_UNAVAILABLE_SERVER:
                return UnavailableServerException::getClass();
            case self::STATUS_IS_PRODUCTION_RECEIPT_ON_SANDBOX:
                return ProductionReceiptOnSandboxException::getClass();
            case self::STATUS_IS_SANDBOX_RECEIPT_ON_PRODUCTION:
                return SandboxReceiptOnProductionException::getClass();
            default:
                return InvalidReceiptException::getClass();
        }
    }
}

/**
 * Base exception class for invalid receipts
 */
class InvalidReceiptException extends \Exception {
    public static function getClass() {
        return get_called_class();
    }
}

/**
 * The App Store could not read the JSON object you provided
 */
final class UnreadableRequestException extends InvalidReceiptException {}

/**
 * The data in the receipt-data property was malformed
 */
final class MalformedReceiptDataException extends InvalidReceiptException {}

/**
 * The receipt could not be authenticated
 */
final class UnauthenticatedReceiptException extends InvalidReceiptException {}

/**
 * The receipt server is not currently available
 */
final class UnavailableServerException extends InvalidReceiptException {}

/**
 * This receipt is a sandbox receipt, but it was sent to the production service for verification
 */
final class SandboxReceiptOnProductionException extends InvalidReceiptException {}

/**
 * This receipt is a production receipt, but it was sent to the sandbox service for verification
 */
final class ProductionReceiptOnSandboxException extends InvalidReceiptException {}
