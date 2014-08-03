<?php
/*
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

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
