<?php
/*
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace alxmsl\AppStore\Exception;
use alxmsl\AppStore\Response\iOS6\RenewableStatus;

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
