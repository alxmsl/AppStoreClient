<?php
/*
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace alxmsl\AppStore;
use alxmsl\AppStore\Response\iOS6\Status;
use alxmsl\AppStore\Response\iOS6\RenewableStatus;
use alxmsl\AppStore\Response\iOS7\ResponsePayload;
use InvalidArgumentException;

/**
 * AppStore client class
 * @author alxmsl
 * @date 2/14/13
 */ 
final class Client extends AbstractClient {
    /**
     * Service endpoints
     */
    const ENDPOINT_PRODUCTION_VERIFY_RECEIPT = 'https://buy.itunes.apple.com/verifyReceipt',
          ENDPOINT_SANDBOX_VERIFY_RECEIPT    = 'https://sandbox.itunes.apple.com/verifyReceipt';

    /**
     * Current endpoint getter
     * @return string Production or sandbox endpoint
     */
    private function getEndpointUrl() {
        return $this->isSandbox()
            ? self::ENDPOINT_SANDBOX_VERIFY_RECEIPT
            : self::ENDPOINT_PRODUCTION_VERIFY_RECEIPT;
    }

    /**
     * Method for receipts data verification
     * @param string $receipt base64 encoded receipt
     * @return Status|RenewableStatus|ResponsePayload iTunes status for receipt
     */
    public function verifyReceipt($receipt) {
        $Request = $this->getRequest($this->getEndpointUrl());
        $Request->addPostField('receipt-data', $receipt)
            ->addPostField('password', $this->getPassword());
        $data = $Request->send();
        try {
            return ResponsePayload::initializeByString($data);
        } catch (InvalidArgumentException $Ex) {
            try {
                return RenewableStatus::initializeByString($data);
            } catch (InvalidArgumentException $ex) {
                return Status::initializeByString($data);
            }
        }
    }
}
