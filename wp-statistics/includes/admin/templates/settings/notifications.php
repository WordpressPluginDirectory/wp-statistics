<?php

use WP_STATISTICS\Option;
use WP_STATISTICS\Schedule;

?>
<h2 class="wps-settings-box__title">
    <span><?php esc_html_e('Email Reports', 'wp-statistics'); ?></span>
    <a href="<?php echo esc_url(WP_STATISTICS_SITE_URL . '/resources/admin-notifications-settings/?utm_source=wp-statistics&utm_medium=link&utm_campaign=settings') ?>" target="_blank"><?php esc_html_e('View Guide', 'wp-statistics'); ?></a>
</h2>

<div class="postbox">
    <table class="form-table">
        <tbody>
        <tr class="wps-settings-box_head">
            <th scope="row" colspan="2"><h3><?php esc_html_e('Email Configuration', 'wp-statistics'); ?></h3></th>
        </tr>

        <tr data-id="recipient_email_addresses_tr">
            <th scope="row">
                <label for="email_list"><?php esc_html_e('Recipient Email Addresses', 'wp-statistics'); ?></label>
            </th>

            <td>
                <input dir="ltr" type="text" id="email_list" name="wps_email_list" size="30" value="<?php if (Option::get('email_list') == '') {
                    $wp_statistics_options['email_list'] = get_bloginfo('admin_email');
                }
                echo esc_textarea(Option::get('email_list')); ?>"/>
                <p class="description"><?php esc_html_e('Enter email addresses to receive reports. Use a comma to separate multiple addresses. If this field is left empty, the "Administration Email Address" from the "General Settings" of WordPress will be used.', 'wp-statistics'); ?></p>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="postbox" id='wps_stats_report_option'>
    <table class="form-table">
        <tbody>
        <tr class="wps-settings-box_head">
            <th scope="row" class="wps-sm-pb-0">
                <h3><?php esc_html_e('Automated Report Delivery', 'wp-statistics'); ?></h3>
            </th>
            <td  class="wps-sm-pt-0">
                <div>
                    <?php $next_scheduled_time = Schedule::getNextScheduledTime('wp_statistics_report_hook') ?>
                    <?php if ($next_scheduled_time) : ?>
                        <div class="alert alert-success"><span><?php echo sprintf(__('Your next report is scheduled to be sent on <b>%s at %s</b>.', 'wp-statistics'), wp_date(get_option('date_format'), $next_scheduled_time), wp_date(get_option('time_format'), $next_scheduled_time)) ?></span></div>
                    <?php endif; ?>
                </div>
            </td>
        </tr>

        <tr data-id="report_frequency_tr">
            <th scope="row" style="vertical-align: top;">
                <label for="time-report"><?php esc_html_e('Report Frequency', 'wp-statistics'); ?></label>
            </th>
            <td>
                <select name="wps_time_report" id="time-report">
                    <option value="0" <?php selected(Option::get('time_report'), '0'); ?>><?php esc_html_e('Disable', 'wp-statistics'); ?></option>
                    <?php
                    foreach (Schedule::getSchedules() as $key => $value) {
                        echo '<option value="' . esc_attr($key) . '" ' . selected(Option::get('time_report'), $key) . '>' . esc_attr($value['display']) . '</option>';
                    }
                    ?>
                </select>
                <p class="description"><?php _e('Select the frequency of report deliveries.', 'wp-statistics'); // phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction	?></p>
            </td>
        </tr>

        <tr data-id="delivery_method_tr">
            <th scope="row" style="vertical-align: top;">
                <label for="send-report"><?php esc_html_e('Delivery Method', 'wp-statistics'); ?></label>
            </th>

            <td>
                <select name="wps_send_report" id="send-report">
                    <option value="0" <?php selected(Option::get('send_report'), '0'); ?>><?php esc_html_e('Please select', 'wp-statistics'); ?></option>
                    <option value="mail" <?php selected(Option::get('send_report'), 'mail'); ?>><?php esc_html_e('Email', 'wp-statistics'); ?></option>
                    <?php if (is_plugin_active('wp-sms/wp-sms.php') || is_plugin_active('wp-sms-pro/wp-sms.php')) { ?>
                        <option value="sms" <?php selected(Option::get('send_report'), 'sms'); ?>><?php esc_html_e('SMS', 'wp-statistics'); ?></option>
                    <?php } ?>
                </select>

                <p class="description"><?php echo sprintf(__('Select your preferred method for receiving reports: via email or SMS. (Note: SMS notifications only include the Custom Report. For full reports, please choose email. SMS notifications are sent using the %s Plugin to the Admin Mobile Number).', 'wp-statistics'), '<a href="https://wordpress.org/extend/plugins/wp-sms/" target="_blank">' . __('WP SMS', 'wp-statistics') . '</a>'); ?></p>
            </td>
        </tr>

        <tr data-id="custom_report_tr">
            <th scope="row" style="vertical-align: top;">
                <span class="wps-setting-label"><?php esc_html_e('Custom Report', 'wp-statistics'); ?></span>
            </th>

            <td>
                <?php wp_editor(Option::get('content_report'), 'content-report', array('media_buttons' => false, 'textarea_name' => 'wps_content_report', 'textarea_rows' => 5, 'editor_height' => 400)); ?>
                <p class="description"><?php esc_html_e('Using WP Statistics shortcodes to display specific statistics.', 'wp-statistics'); ?></p>

                <p class="description data">
                    <?php esc_html_e('Insert any of the following shortcode examples to show corresponding data:', 'wp-statistics'); ?>
                    <br><br>
                    <?php esc_html_e('Today\'s Visitors', 'wp-statistics'); ?>:
                    <code>[wpstatistics stat=visitors time=today]</code><br>
                    <?php esc_html_e('Today\'s Views', 'wp-statistics'); ?>:
                    <code>[wpstatistics stat=visits time=today]</code><br>
                    <?php esc_html_e('Yesterday\'s Visitors', 'wp-statistics'); ?>:
                    <code>[wpstatistics stat=visitors time=yesterday]</code><br>
                    <?php esc_html_e('Yesterday\'s Views', 'wp-statistics'); ?>:
                    <code>[wpstatistics stat=visits time=yesterday]</code><br>
                    <?php esc_html_e('Total Visitors', 'wp-statistics'); ?>:
                    <code>[wpstatistics stat=visitors time=total]</code><br>
                    <?php esc_html_e('Total Views', 'wp-statistics'); ?>:
                    <code>[wpstatistics stat=visits time=total]</code><br>
                </p>
                <p class="description"><?php _e('Refer to our complete <a href="https://wp-statistics.com/resources/shortcodes/?utm_source=wp-statistics&utm_medium=link&utm_campaign=settings" target="_blank">shortcode guide</a> for more options.', 'wp-statistics'); // phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction	?></p>
            </td>
        </tr>

        <tr data-id="email_header_customization_tr">
            <th scope="row">
                <label for="email_free_content_header"><?php esc_html_e('Email Header Customization', 'wp-statistics'); ?></label>
            </th>

            <td>
                <?php wp_editor(stripslashes(Option::get('email_free_content_header')), 'email_free_content_header', array('textarea_name' => 'wps_email_free_content_header', 'editor_height' => 150, 'media_buttons' => false, 'teeny' => true)); ?>
                <p class="description"><?php esc_html_e('Add a custom header to your email reports to introduce your brand or report summary.', 'wp-statistics'); ?></p>
            </td>
        </tr>

        <tr data-id="email_footer_customization_tr">
            <th scope="row">
                <label for="email_free_content_footer"><?php esc_html_e('Email Footer Customization', 'wp-statistics'); ?></label>
            </th>

            <td>
                <?php wp_editor(stripslashes(Option::get('email_free_content_footer')), 'email_free_content_footer', array('textarea_name' => 'wps_email_free_content_footer', 'editor_height' => 150, 'media_buttons' => false, 'teeny' => true)); ?>
                <p class="description"><?php esc_html_e('Insert a custom footer in your email reports for additional notes, disclaimers, or contact information.', 'wp-statistics'); ?></p>
            </td>
        </tr>

        <tr data-id="enhanced_visual_report_tr">
        <?php if (Option::get('privacy_audit')) : ?>
            <tr>
                <th scope="row">
                    <span class="wps-setting-label"><?php esc_html_e('Privacy Audit issues', 'wp-statistics'); ?></span>
                </th>
                <td>
                    <input id="wps_show_privacy_issues_in_report" type="checkbox" name="wps_show_privacy_issues_in_report" <?php echo WP_STATISTICS\Option::get('show_privacy_issues_in_report') == true ? "checked='checked'" : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>'>
                    <label for="wps_show_privacy_issues_in_report"><?php esc_html_e('Enable', 'wp-statistics'); ?></label>
                    <p class="description"><?php esc_html_e('Include open audit issues in each report email.', 'wp-statistics'); ?></p>
                </td>
            </tr>
        <?php endif; ?>

        <tr>
            <th scope="row" style="vertical-align: top;">
                <label for="content-report"><?php esc_html_e('Enhanced Visual Report', 'wp-statistics'); ?></label>
            </th>
            <td>
                <div><?php _e('For graphical representations of your data, explore our <a class="js-wps-openPremiumModal"  data-target="wp-statistics-advanced-reporting" href="https://wp-statistics.com/add-ons/wp-statistics-advanced-reporting/?utm_source=wp-statistics&utm_medium=link&utm_campaign=settings" >Advanced Reporting Add-on</a> for additional chart and graph options.', 'wp-statistics') // phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction	  ?></div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<?php submit_button(__('Update', 'wp-statistics'), 'wps-button wps-button--primary', 'submit', '', array('OnClick' => "var wpsCurrentTab = getElementById('wps_current_tab'); wpsCurrentTab.value='notifications-settings'")); ?>
