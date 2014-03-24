<?php

namespace AppStore\Client\Response;

/**
 * Auto-renewable receipt class
 * @author alxmsl
 * @date 2/14/13
 */
final class RenewableReceipt extends Receipt {
    /**
     * @var int expiration timestamp, msec
     */
    private $expiresDate = 0;

    /**
     * @var string The primary key for identifying subscription purchases
     */
    private $webOrderLineItemId = '';

    /**
     * Setter for expiration timestamp
     * @param int $expiresDate timestamp of expiration, msec
     * @return RenewableReceipt self
     */
    private function setExpiresDate($expiresDate) {
        $this->expiresDate = $expiresDate;
        return $this;
    }

    /**
     * Getter for expiration timestamp
     * @return int timestamp of expiration, msec
     */
    public function getExpiresDate() {
        return $this->expiresDate;
    }

    /**
     * The primary key for identifying subscription purchases
     * @param string $webOrderLineItemId
     * @return $this
     */
    public function setWebOrderLineItemId($webOrderLineItemId)
    {
        $this->webOrderLineItemId = $webOrderLineItemId;
        return $this;
    }

    /**
     * The primary key for identifying subscription purchases
     * @return string
     */
    public function getWebOrderLineItemId()
    {
        return $this->webOrderLineItemId;
    }

    /**
     * Initialization method
     * @param \stdClass $Object object for initialization
     * @return RenewableReceipt initialized receipt for auto-renewable subscription
     */
    public static function initializeByObject(\stdClass $Object) {
        $Receipt = new self();

        if (isset($Object->app_item_id)) {
            $Receipt->setAppItemId($Object->app_item_id);
        }

        if (isset($Object->bid)) {
            $Receipt->setBid($Object->bid);
        }

        if (isset($Object->bvrs)) {
            $Receipt->setBvrs($Object->bvrs);
        }

        if (isset($Object->product_id)) {
            $Receipt->setProductId($Object->product_id);
        }

        if (isset($Object->quantity)) {
            $Receipt->setQuantity($Object->quantity);
        }

        if (isset($Object->transaction_id)) {
            $Receipt->setTransactionId($Object->transaction_id);
        }

        if (isset($Object->original_transaction_id)) {
            $Receipt->setOriginalTransactionId($Object->original_transaction_id);
        }

        if (isset($Object->purchase_date)) {
            $Receipt->setPurchaseDate($Object->purchase_date);
        }

        if (isset($Object->original_purchase_date)) {
            $Receipt->setOriginalPurchaseDate($Object->original_purchase_date);
        }

        if (isset($Object->cancellation_date)) {
            $Receipt->setCancellationDate($Object->cancellation_date);
        }

        if (isset($Object->web_order_line_item_id)) {
            $Receipt->setWebOrderLineItemId($Object->web_order_line_item_id);
        }

        if (isset($Object->expires_date)) {
            $Receipt->setExpiresDate($Object->expires_date);
        }

        return $Receipt;
    }
}