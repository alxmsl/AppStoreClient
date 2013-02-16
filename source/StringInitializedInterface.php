<?php

namespace AppStore\Client;

/**
 * Interface for self-initialization objects by encoded strings
 * @author alxmsl
 * @date 2/9/13
 */
interface StringInitializedInterface {
    /**
     * Initialization method
     * @param string $string data for object initialization
     * @return StringInitializedInterface initialized object
     */
    public static function initializeByString($string);
}
