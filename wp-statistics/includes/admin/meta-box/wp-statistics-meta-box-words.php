<?php

namespace WP_STATISTICS\MetaBox;

use WP_STATISTICS\SearchEngine;

class words
{

    public static function get($args = array())
    {
        /**
         * Filters the args used from metabox for query stats
         *
         * @param array $args The args passed to query stats
         * @since 14.2.1
         *
         */
        $args = apply_filters('wp_statistics_meta_box_words_args', $args);

        // Prepare Response
        try {
            $response = SearchEngine::getLastSearchWord($args);
        } catch (\Exception $e) {
            $response = array();
        }

        // Check For No Data Meta Box
        if (count(array_filter($response)) < 1) {
            $response['no_data'] = 1;
        }

        // Response
        return $response;
    }

}