<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 *
 * Script for In-app purchase receipts verification
 * @author alxmsl
 */

include __DIR__ . '/../vendor/autoload.php';

use alxmsl\AppStore\Client;
use alxmsl\AppStore\Response\iOS6\RenewableStatus;
use alxmsl\AppStore\Response\iOS6\Status;
use alxmsl\AppStore\Response\iOS7\ResponsePayload;
use alxmsl\Cli\CommandPosix;
use alxmsl\Cli\Exception\RequiredOptionException;
use alxmsl\Cli\Option;

$isSandbox = false;
$password  = '';
$receipt   = '';

$Command = new CommandPosix();
$Command->appendHelpParameter('show help');
$Command->appendParameter(new Option('password', 'p', 'subscription password', Option::TYPE_STRING)
    , function($name, $value) use (&$password) {
        $password = $value;
    });
$Command->appendParameter(new Option('receipt', 'r', 'receipt data (base 64)', Option::TYPE_STRING, true)
    , function($name, $value) use (&$receipt) {
        $receipt = $value;
    });
$Command->appendParameter(new Option('test', 't', 'use sandbox', Option::TYPE_BOOLEAN)
    , function($name, $value) use (&$isSandbox) {
        $isSandbox = $value;
    });
try {
    $Command->parse(true);
    $AppStore = new Client();
    $AppStore->setSandbox($isSandbox);
    if (!empty($password)) {
        $AppStore->setPassword($password);
    }
    $Response = $AppStore->verifyReceipt($receipt);
    switch (true) {
        case $Response instanceof Status:
            printf("---\nfound iOS6 receipt\n");
            break;
        case $Response instanceof RenewableStatus:
            printf("---\nfound iOS6 renewable receipt\n");
            break;
        case $Response instanceof ResponsePayload:
            printf("---\nfound iOS7 receipt\n");
            break;
    }
    var_dump($Response);
} catch (RequiredOptionException $Ex) {
    $Command->displayHelp();
}

