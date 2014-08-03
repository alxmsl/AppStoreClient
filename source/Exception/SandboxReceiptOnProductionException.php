<?php

namespace alxmsl\AppStore\Exception;

/**
 * This receipt is a sandbox receipt, but it was sent to the production service for verification
 */
final class SandboxReceiptOnProductionException extends InvalidReceiptException {}
 