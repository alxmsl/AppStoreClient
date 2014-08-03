<?php

namespace alxmsl\AppStore;
use stdClass;

/**
 * Interface for self-initialization objects by standard classes
 * @author alxmsl
 * @date 2/14/13
 */
interface ObjectInitializedInterface {
    /**
     * Initialization method
     * @param stdClass $Object object for initialization
     * @return ObjectInitializedInterface initialized object
     */
    public static function initializeByObject(stdClass $Object);
}
