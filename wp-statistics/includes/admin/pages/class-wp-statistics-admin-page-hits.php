<?php

namespace WP_STATISTICS;
use WP_Statistics\Components\Singleton;

class hits_page extends Singleton
{

    public function __construct()
    {

        // Check if in Hits Page
        if (Menus::in_page('hits')) {

            // Disable Screen Option
            add_filter('screen_options_show_screen', '__return_false');

            // Is Validate Date Request
            $DateRequest = Admin_Template::isValidDateRequest();
            if (!$DateRequest['status']) {
                wp_die(esc_html($DateRequest['message']));
            }
        }
    }

    /**
     * Display Html Page
     *
     * @throws \Exception
     */
    public static function view()
    {

        // Page title
        $args['title'] = __('View Statistics', 'wp-statistics');

        // Get Current Page Url
        $args['pageName']   = Menus::get_page_slug('hits');
        $args['pagination'] = Admin_Template::getCurrentPaged();

        // Get Date-Range
        $args['DateRang']    = Admin_Template::DateRange();
        $args['hasDateRang'] = True;

        // Get Total Views and Visitors
        $args['total_visits']   = wp_statistics_visit('total');
        $args['total_visitors'] = wp_statistics_visitor('total', null, true);

        // Show Template Page
        Admin_Template::get_template(array('layout/header', 'layout/title', 'pages/hits', 'layout/footer'), $args);
    }

}

hits_page::instance();