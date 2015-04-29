<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace alxmsl\AppStore\Response\iOS7;
use alxmsl\AppStore\ObjectInitializedInterface;
use stdClass;

/**
 * Class for App Receipt data
 * @author alxmsl
 */
final class AppReceipt implements ObjectInitializedInterface {
    /**
     * @var string app’s bundle identifier
     */
    private $bundleId = '';

    /**
     * @var string app’s version number
     */
    private $applicationVersion = '';

    /**
     * @var string version of the app that was originally purchased
     */
    private $originalApplicationVersion = '';

    /**
     * @var string date (ISO 3339) that the app receipt expires (for Volume Purchase Program only)
     */
    private $expirationDate = '';

    /**
     * @var InAppPurchaseReceipt[] receipts for an in-app purchases
     */
    private $inAppPurchaseReceipts = [];

    /**
     * @var string string that the App Store uses to uniquely identify the application that created the transaction
     */
    private $appItemId = '';

    /**
     * @var string arbitrary number that uniquely identifies a revision of your application
     */
    private $versionExternalIdentifier = '';

    /**
     * @return string app’s bundle identifier
     */
    public function getBundleId() {
        return $this->bundleId;
    }

    /**
     * @return string app’s version number
     */
    public function getApplicationVersion() {
        return $this->applicationVersion;
    }

    /**
     * @return string version of the app that was originally purchased
     */
    public function getOriginalApplicationVersion() {
        return $this->originalApplicationVersion;
    }

    /**
     * @return string date that the app receipt expires (for Volume Purchase Program only)
     */
    public function getExpirationDate() {
        return $this->expirationDate;
    }

    /**
     * @return InAppPurchaseReceipt[] receipts for an in-app purchases
     */
    public function getInAppPurchaseReceipts() {
        return $this->inAppPurchaseReceipts;
    }

    /**
     * @return string string that the App Store uses to uniquely identify the application that created the transaction
     */
    public function getAppItemId() {
        return $this->appItemId;
    }

    /**
     * @return string arbitrary number that uniquely identifies a revision of your application
     */
    public function getVersionExternalIdentifier() {
        return $this->versionExternalIdentifier;
    }

    /**
     * @inheritdoc
     * @return AppReceipt App Receipt instance
     */
    public static function initializeByObject(stdClass $Object) {
        $AppReceipt = new self();
        $AppReceipt->appItemId                  = (string) $Object->app_item_id;
        $AppReceipt->applicationVersion         = (string) $Object->application_version;
        $AppReceipt->bundleId                   = (string) $Object->bundle_id;
        $AppReceipt->originalApplicationVersion = (string) $Object->original_application_version;
        $AppReceipt->versionExternalIdentifier  = (string) $Object->version_external_identifier;
        foreach ($Object->in_app as $PurchaseObject) {
            $AppReceipt->inAppPurchaseReceipts[] = InAppPurchaseReceipt::initializeByObject($PurchaseObject);
        }

        if (isset($Object->expiration_date)) {
            $AppReceipt->expirationDate = (string) $Object->expiration_date;
        }
        return $AppReceipt;
    }
}
