<?php

namespace alxmsl\AppStore\Response\iOS7;
use alxmsl\AppStore\Exception\InvalidReceiptException;
use alxmsl\AppStore\Response\iOS6\Status;
use alxmsl\AppStore\StringInitializedInterface;

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
     */
    public static function initializeByString($string) {
        $Object = json_decode($string);
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
    }
}
