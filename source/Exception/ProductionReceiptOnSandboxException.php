<?php

namespace alxmsl\AppStore\Exception;

/**
 * This receipt is a production receipt, but it was sent to the sandbox service for verification
 */
final class ProductionReceiptOnSandboxException extends InvalidReceiptException {}
