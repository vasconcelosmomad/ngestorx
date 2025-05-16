<?php

use Detection\MobileDetect as MobileDetect;

if (!function_exists('isMobile')) {
    function isMobile() {
        $detect = new MobileDetect();
        return $detect->isMobile() && !$detect->isTablet();
    }
}

if (!function_exists('isTablet')) {
    function isTablet() {
        $detect = new MobileDetect();
        return $detect->isTablet();
    }
}
