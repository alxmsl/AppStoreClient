<?php

namespace alxmsl\AppStore\Exception;
use alxmsl\AppStore\Response\RenewableStatus;

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
 