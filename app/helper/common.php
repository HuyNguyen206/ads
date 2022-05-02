<?php

use Cohensive\Embed\Facades\Embed;

if (!function_exists('displayLinkFromUrl')) {
    /**
     * @return int
     */
    function displayLinkFromUrl($url) {

        $embed = Embed::make($url)->parseUrl();
        // Will return Embed class if provider is found. Otherwie will return false - not found. No fancy errors for now.
        if ($embed) {
            // Set width of the embed.
            $embed->setAttribute(['width' => 600]);

            // Print html: '<iframe width="600" height="338" src="//www.youtube.com/embed/uifYHNyH-jA" frameborder="0" allowfullscreen></iframe>'.
            // Height will be set automatically based on provider width/height ratio.
            // Height could be set explicitly via setAttr() method.
            return $embed->getHtml();
        }
        return null;
    }
}

if (!function_exists('testHelper')) {
    /**
     * @return int
     */
    function testHelper($url) {

        return $url;
    }
}
