<?php

namespace alxmsl\AppStore\Exception;

/**
 * The shared secret you provided does not match the shared secret on file for your account
 */
final class UnmatchedSharedSecretException extends InvalidReceiptException {}
