<?php

namespace alxmsl\AppStore\Response\iOS7;
use alxmsl\AppStore\ObjectInitializedInterface;
use stdClass;

/**
 * Class for In-App purchase receipt data
 * @author alxmsl
 */
final class InAppPurchaseReceipt implements ObjectInitializedInterface {
    /**
     * @var int number of items purchased
     */
    private $quantity = 0;

    /**
     * @var string product identifier of the item that was purchased
     */
    private $productId = '';

    /**
     * @var string transaction identifier of the item that was purchased
     */
    private $transactionId = '';

    /**
     * @var string transaction that restores a previous transaction, the transaction identifier of the original
     * transaction. Otherwise, identical to the transaction identifier
     */
    private $originalTransactionId = '';

    /**
     * @var string date and time that the item was purchased (ISO 3339)
     */
    private $purchaseDate = '';

    /**
     * @var string transaction that restores a previous transaction, the date of the original transaction (ISO 3339)
     */
    private $originalPurchaseDate = '';

    /**
     * @var int expiration date for the subscription (milliseconds)
     */
    private $expiresDate = 0;

    /**
     * @var string transaction that was canceled by Apple customer support,
     * the time and date of the cancellation (ISO 3339)
     */
    private $cancellationDate = '';

    /**
     * @var string primary key for identifying subscription purchases
     */
    private $webOrderLineItemId = '';

    /**
     * @inheritdoc
     * @return InAppPurchaseReceipt App Receipt instance
     */
    public static function initializeByObject(stdClass $Object) {
        $InAppPurchaseReceipt = new self();
        $InAppPurchaseReceipt->originalPurchaseDate  = (string) $Object->original_purchase_date;
        $InAppPurchaseReceipt->originalTransactionId = (string) $Object->original_transaction_id;
        $InAppPurchaseReceipt->productId             = (string) $Object->product_id;
        $InAppPurchaseReceipt->purchaseDate          = (string) $Object->purchase_date;
        $InAppPurchaseReceipt->quantity              = (int) $Object->quantity;
        $InAppPurchaseReceipt->transactionId         = (string) $Object->transaction_id;

        if (isset($Object->cancellation_date)) {
            $InAppPurchaseReceipt->cancellationDate = (string) $Object->cancellation_date;
        }
        if (isset($Object->web_order_line_item_id)) {
            $InAppPurchaseReceipt->expiresDate        = (int) $Object->expires_date;
            $InAppPurchaseReceipt->webOrderLineItemId = (string) $Object->web_order_line_item_id;
        }
        return $InAppPurchaseReceipt;
    }
}
