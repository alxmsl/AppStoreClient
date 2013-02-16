<?php

namespace AppStore\Client\Response;

use AppStore\Client\ObjectInitializedInterface;

/**
 * Purchases receipt class
 * @author alxmsl
 * @date 2/14/13
 */ 
class Receipt implements ObjectInitializedInterface {
    /**
     * @var int number of purchased items
     */
    private $quantity = 0;

    /**
     * @var string product identifier for purchased items
     */
    private $productId = '';

    /**
     * @var string transaction identifier for purchased items
     */
    private $transactionId = '';

    /**
     * @var string purchase date GMT
     */
    private $purchaseDate = '';

    /**
     * @var string original transaction identifier for restored transactions
     */
    private $originalTransactionId = '';

    /**
     * @var string original purchase date GMT for restored transactions
     */
    private $originalPurchaseDate = '';

    /**
     * @var string application identifier from App Store
     */
    private $appItemId = '';

    /**
     * @var string application revision number
     */
    private $versionExternalIdentifier = '';

    /**
     * @var string bundle identifier
     */
    private $bid = '';

    /**
     * @var string application version number
     */
    private $bvrs = '';

    /**
     * Setter for application identifier from App Store
     * @param string $appItemId application identifier from App Store
     * @return Receipt self
     */
    protected function setAppItemId($appItemId) {
        $this->appItemId = (string) $appItemId;
        return $this;
    }

    /**
     * Getter for application identifier from App Store
     * @return string application identifier from App Store
     */
    public function getAppItemId() {
        return $this->appItemId;
    }

    /**
     * Setter for bundle identifier
     * @param string $bid bundle identifier
     * @return Receipt self
     */
    protected  function setBid($bid) {
        $this->bid = (string) $bid;
        return $this;
    }

    /**
     * Getter for bundle identifier
     * @return string bundle identifier
     */
    public function getBid() {
        return $this->bid;
    }

    /**
     * Setter for application version number
     * @param string $bvrs application version number
     * @return Receipt self
     */
    protected  function setBvrs($bvrs) {
        $this->bvrs = (string) $bvrs;
        return $this;
    }

    /**
     * Getter for application version number
     * @return string application version number
     */
    public function getBvrs() {
        return $this->bvrs;
    }

    /**
     * Setter for original purchase date GMT for restored transactions
     * @param string $originalPurchaseDate original purchase date GMT for restored transactions
     * @return Receipt self
     */
    protected  function setOriginalPurchaseDate($originalPurchaseDate) {
        $this->originalPurchaseDate = (string) $originalPurchaseDate;
        return $this;
    }

    /**
     * Getter for original purchase date GMT for restored transactions
     * @return string original purchase date GMT for restored transactions
     */
    public function getOriginalPurchaseDate() {
        return $this->originalPurchaseDate;
    }

    /**
     * Setter for original transaction identifier for restored transactions
     * @param string $originalTransactionId original transaction identifier for restored transactions
     * @return Receipt self
     */
    protected  function setOriginalTransactionId($originalTransactionId) {
        $this->originalTransactionId = (string) $originalTransactionId;
        return $this;
    }

    /**
     * Getter for original transaction identifier for restored transactions
     * @return string original transaction identifier for restored transactions
     */
    public function getOriginalTransactionId() {
        return $this->originalTransactionId;
    }

    /**
     * Setter for product identifier for purchased items
     * @param string $productId product identifier for purchased items
     * @return Receipt self
     */
    protected function setProductId($productId) {
        $this->productId = (string) $productId;
        return $this;
    }

    /**
     * Getter for product identifier for purchased items
     * @return string product identifier for purchased items
     */
    public function getProductId() {
        return $this->productId;
    }

    /**
     * Setter for purchase date GMT
     * @param string $purchaseDate purchase date GMT
     * @return Receipt self
     */
    protected function setPurchaseDate($purchaseDate) {
        $this->purchaseDate = (string) $purchaseDate;
        return $this;
    }

    /**
     * Getter for purchase date GMT
     * @return string purchase date GMT
     */
    public function getPurchaseDate() {
        return $this->purchaseDate;
    }

    /**
     * Setter for number of purchased items
     * @param string $quantity number of purchased items
     * @return Receipt self
     */
    protected function setQuantity($quantity) {
        $this->quantity = (int) $quantity;
        return $this;
    }

    /**
     * Getter number of purchased items
     * @return int number of purchased items
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * Setter for transaction identifier for purchased items
     * @param string $transactionId transaction identifier for purchased items
     * @return Receipt self
     */
    protected function setTransactionId($transactionId) {
        $this->transactionId = (string) $transactionId;
        return $this;
    }

    /**
     * Getter for transaction identifier for purchased items
     * @return string transaction identifier for purchased items
     */
    public function getTransactionId() {
        return $this->transactionId;
    }

    /**
     * Setter for application revision number
     * @param string $versionExternalIdentifier application revision number
     * @return Receipt self
     */
    protected function setVersionExternalIdentifier($versionExternalIdentifier) {
        $this->versionExternalIdentifier = (string) $versionExternalIdentifier;
        return $this;
    }

    /**
     * Getter for application revision number
     * @return string application revision number
     */
    public function getVersionExternalIdentifier() {
        return $this->versionExternalIdentifier;
    }

    /**
     * Initialization method
     * @param \stdClass $Object object for initialization
     * @return RenewableReceipt initialized receipt for auto-renewable subscription
     */
    public static function initializeByObject(\stdClass $Object) {
        $Receipt = new self();
        $Receipt->setAppItemId($Object->app_item_id)
            ->setBid($Object->bid)
            ->setBvrs($Object->bvrs)
            ->setOriginalPurchaseDate($Object->original_purchase_date)
            ->setOriginalTransactionId($Object->original_transaction_id)
            ->setProductId($Object->product_id)
            ->setPurchaseDate($Object->purchase_date)
            ->setQuantity($Object->quantity)
            ->setTransactionId($Object->transaction_id)
            ->setQuantity($Object->quantity);
        return $Receipt;
    }
}