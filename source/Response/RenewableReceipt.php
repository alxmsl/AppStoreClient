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
     * Initialization method
     * @param \stdClass $Object object for initialization
     * @return RenewableReceipt initialized receipt for auto-renewable subscription
     */
    public static function initializeByObject(\stdClass $Object) {
        $RenewableReceipt = new self();
        $RenewableReceipt->setExpiresDate($Object->expires_date)
            ->setAppItemId($Object->app_item_id)
            ->setBid($Object->bid)
            ->setBvrs($Object->bvrs)
            ->setOriginalPurchaseDate($Object->original_purchase_date)
            ->setOriginalTransactionId($Object->original_transaction_id)
            ->setProductId($Object->product_id)
            ->setPurchaseDate($Object->purchase_date)
            ->setQuantity($Object->quantity)
            ->setTransactionId($Object->transaction_id)
            ->setWebOrderLineItemId($Object->web_order_line_item_id)
            ->setQuantity($Object->quantity);
            
        if (isset($Object->cancellation_date)) {
            $RenewableReceipt->setCancellationDate($Object->cancellation_date);
        }    
            
        return $RenewableReceipt;
    }
}
