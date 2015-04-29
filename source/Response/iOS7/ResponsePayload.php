<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace alxmsl\AppStore\Response\iOS7;
use alxmsl\AppStore\Exception\InvalidReceiptException;
use alxmsl\AppStore\Response\iOS6\Status;
use alxmsl\AppStore\StringInitializedInterface;
use InvalidArgumentException;

/**
 * Class for response payload for receipt validation data
 * @author alxmsl
 */
final class ResponsePayload implements StringInitializedInterface {
    /**
     * @var int response status code
     */
    private $status = Status::STATUS_INVALID;

    /**
     * @var string purchase environment
     */
    private $environment = '';

    /**
     * @var null|AppReceipt app receipt instance
     */
    private $AppReceipt = null;

    /**
     * @return AppReceipt|null app receipt instance
     */
    public function getAppReceipt() {
        return $this->AppReceipt;
    }

    /**
     * @return int response status code
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @return string purchase environment
     */
    public function getEnvironment() {
        return $this->environment;
    }

    /**
     * @inheritdoc
     * @return ResponsePayload response payload instance
     * @throws InvalidReceiptException when unknown status code found
     * @throws InvalidArgumentException when not iOS7 receipt string
     */
    public static function initializeByString($string) {
        $Object = json_decode($string);
        if (isset($Object->receipt->in_app)) {
            $result = Status::checkStatus($Object->status);
            if ($result === true) {
                $Response = new self();
                $Response->AppReceipt  = AppReceipt::initializeByObject($Object->receipt);
                $Response->environment = (string) $Object->environment;
                $Response->status      = (int) $Object->status;
                return $Response;
            } else {
                $Exception = new $result($string, $Object->status);
                throw $Exception;
            }
        } else {
            throw new InvalidArgumentException('not found in_app receipt field in iOS7 receipt');
        }
    }
}
