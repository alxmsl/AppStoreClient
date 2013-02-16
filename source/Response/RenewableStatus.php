<?php

namespace AppStore\Client\Response;

/**
 * Class for iTunes status of auto-renewable subscription receipt
 * @author alxmsl
 * @date 2/14/13
 */ 
final class RenewableStatus extends Status {
    /**
     * Status code constants
     */
    const   STATUS_UNMATCHED_SHARED_SECRET  = 21004,
            STATUS_EXPIRED_SUBSCRIPTION     = 21006;

    /**
     * @var string latest receipt base64 encoded data
     */
    private $latestReceipt = '';

    /**
     * @var RenewableReceipt latest receipt object
     */
    private $LatestReceiptInfo = null;

    /**
     * Setter for latest receipt object
     * @param RenewableStatus $LatestReceiptInfo latest receipt object
     * @return RenewableStatus self
     */
    private function setLatestReceiptInfo(RenewableReceipt $LatestReceiptInfo) {
        $this->LatestReceiptInfo = $LatestReceiptInfo;
        return $this;
    }

    /**
     * Getter for latest receipt object
     * @return RenewableReceipt latest receipt object
     */
    public function getLatestReceiptInfo() {
        return $this->LatestReceiptInfo;
    }

    /**
     * Setter for latest receipt base64 encoded data
     * @param string $latestReceipt latest receipt base64 encoded data
     * @return RenewableStatus self
     */
    private function setLatestReceipt($latestReceipt) {
        $this->latestReceipt = $latestReceipt;
        return $this;
    }

    /**
     * Getter for latest receipt base64 encoded data
     * @return string latest receipt base64 encoded data
     */
    public function getLatestReceipt() {
        return $this->latestReceipt;
    }

    /**
     * Initialization method
     * @param string $string data for object initialization
     * @throws InvalidReceiptException when receipt status code is invalid
     * @throws ExpiredSubscriptionException when subscription expired
     * @throws \InvalidArgumentException wen initialization data incorrect
     * @return RenewableStatus initialized status object
     */
    public static function initializeByString($string) {
        $Object = json_decode($string);
        switch ($Object->status) {
            case self::STATUS_OK:
            case self::STATUS_EXPIRED_SUBSCRIPTION:
                if (!isset($Object->latest_receipt)) {
                    throw new \InvalidArgumentException();
                } else {
                    $RenewableStatus = new self();
                    $RenewableStatus->setLatestReceipt($Object->latest_receipt)
                        ->setLatestReceiptInfo(RenewableReceipt::initializeByObject($Object->latest_receipt_info))
                        ->setStatus($Object->status)
                        ->setReceipt(RenewableReceipt::initializeByObject($Object->receipt));
                    if ($RenewableStatus == self::STATUS_EXPIRED_SUBSCRIPTION) {
                        throw new ExpiredSubscriptionException($RenewableStatus);
                    } else {
                        return $RenewableStatus;
                    }
                }
            default:
                $exceptionClass = self::checkStatus($Object->status);
                $Exception = new $exceptionClass($string, $Object->status);
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
            case self::STATUS_UNMATCHED_SHARED_SECRET:
                return UnmatchedSharedSecretException::getClass();
            default:
                return parent::checkStatus($status);
        }
    }
}

/**
 * The shared secret you provided does not match the shared secret on file for your account
 */
final class UnmatchedSharedSecretException extends InvalidReceiptException {}

/**
 * This receipt is valid but the subscription has expired
 */
final class ExpiredSubscriptionException extends InvalidReceiptException {
    /**
     * @var RenewableStatus status object for expired subscription
     */
    private $Status = null;

    /**
     * Getter for expired subscription object
     * @return RenewableStatus expired subscription object
     */
    public function getStatus() {
        return $this->Status;
    }

    /**
     * @param RenewableStatus $Status expired subscription object
     */
    public function __construct(RenewableStatus $Status) {
        $this->Status = $Status;
    }
}
