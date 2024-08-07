<?php

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly


// Setting up the logo.
$final_logo = ' <a href="' . esc_url($logo_url) . '"  class="wp-statistics-logo" style=" font-family: "Roboto" ,Arial,Helvetica,sans-serif; margin: 0; padding: 0; text-decoration: none;"><img src="' . esc_url($logo_image) . '" width="197" height="46" title="WP Statistics" alt="WP Statistics" style=" font-family: "Roboto",Arial,Helvetica,sans-serif; margin: 0; margin-bottom: 24px; padding: 0; text-decoration: none;"></a>';

// Advertisement For WP Statistics Advanced Report Plugin
$advanced_reporting_ad = is_plugin_active('wp-statistics-advanced-reporting/wp-statistics-advanced-reporting.php') ? '' :
    '<div class="better-reports" style="background: #404bf2; border: 1px solid #404bf2; border-radius: 8px;  font-family: \'Roboto\', Arial, Helvetica, sans-serif; margin: 0; margin-top: 39px; padding: 32px 18px 32px 18px; text-align: center; text-decoration: none;">
        <h2 class="better-reports__title" style=" color: #fff; font-family: \'Roboto\', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: 600; line-height: 21.09px; margin: 0 0 24px; padding: 0; text-decoration: none;">' . __('Get Better Reports', 'wp-statistics') . '</h2>
        <p style=" color: #fff; font-family: \'Roboto\', Arial, Helvetica, sans-serif; font-size: 15px; font-weight: 400; line-height: 25px; margin: 0 0 32px; padding: 0; text-decoration: none;">
           ' . __('Detailed and customizable email reports are available with the Advanced Reporting add-on. Make sure you always have the insights you need to make informed decisions by digging deeper into your website analytics.', 'wp-statistics') . '
        </p>
        <a href="https://wp-statistics.com/product/wp-statistics-advanced-reporting/?utm_source=wp_statistics&utm_medium=display&utm_campaign=email_report"  title="' . __('See the Full Picture — Try Advanced Reporting Today', 'wp-statistics') . '" style="background-color: #fff; background-image: url(\'' . esc_url(WP_STATISTICS_URL . 'assets/mail/images/arrow-right.png') . '\'); background-position: center right 24px; background-repeat: no-repeat; background-size: 16px; border-radius: 4px;  color: #404bf2; display: inline-block; font-family: \'Roboto\', Arial, Helvetica, sans-serif; font-size: 15px; font-weight: 600; line-height: 17.58px; margin: 0; padding: 12px 50px 12px 16px; position: relative; text-decoration: none; word-break: break-word;">
            ' . __('See the Full Picture — Try Advanced Reporting Today', 'wp-statistics') . '
        </a></div>';

$tipOfEmail = \WP_STATISTICS\Helper::getReportEmailTip();


$email_body = '
        <div class="mail-body" style="background: #e1ebfd;  font-family: \'Roboto\', Arial, Helvetica, sans-serif; margin: 0; padding: 43px 0; text-decoration: none;">
            <div class="main-section" style=" font-family: \'Roboto\', Arial, Helvetica, sans-serif; margin:0 auto; max-width: 100%; padding: 0 5px; text-decoration: none; width: 628px; ">
                <table class="header" style=" font-family: \'Roboto\', Arial, Helvetica, sans-serif; margin: 0; padding: 0; text-align: center; text-decoration: none; width: 100%;">
                    <tr style=" font-family: \'Roboto\', Arial, Helvetica, sans-serif; margin: 0; padding: 0; text-decoration: none;">
                        <td style=" font-family: \'Roboto\', Arial, Helvetica, sans-serif; margin: 0; padding: 0; text-decoration: none;">
                             ' . $final_logo . '
                        </td>
                    </tr>
                    <tr style=" font-family: \'Roboto\', Arial, Helvetica, sans-serif; margin: 0; padding: 0; text-decoration: none;">
                        <td style=" font-family: \'Roboto\', Arial, Helvetica, sans-serif; margin: 0; padding: 0; text-decoration: none;">
                            <p style=" color: #303032 ; font-family: \'Roboto\', Arial, Helvetica, sans-serif; font-size: 16px; font-style: italic; font-weight: 600; line-height: 18.75px; margin: 0; margin-bottom: 16px; margin-top: 24px; padding: 0;">' . $email_title . '</p>
                        </td>
                    </tr>
                </table>
                ' . $email_header . '
                <div class="content" style="background: #fff; border-radius: 8px;  font-family:  \'Roboto\',Arial,Helvetica,sans-serif; margin: 0; padding: 47px 34px 47px 34px; text-decoration: none;">
                    <div style="margin-bottom: 15px">
                    ' . wp_kses_post($content) . '
                    </div>
                     <div class="content__tip" style="background: #f0f5ff; border: 1px solid #9da3f7; border-radius: 8px;  font-family: \'Roboto\',Arial,Helvetica,sans-serif; margin: 0; padding: 18px; text-decoration: none;">
                        <div class="content__tip--title" style=" font-family: \'Roboto\',Arial,Helvetica,sans-serif; margin: 0; margin-bottom: 22px; padding: 0; position: relative; text-decoration: none;">
                            <h2 style=" font-family: \'Roboto\',Arial,Helvetica,sans-serif; font-size: 16px; font-weight: 500; line-height: 25px; margin: 0; text-decoration: none;">
                                <span style="background-color: #404bf2; background-position: center left 4px; background-repeat: no-repeat; background-size: 13px; border-radius: 4px;  color: #fff; font-family: \'Roboto\',Arial,Helvetica,sans-serif; font-size: 15px; font-weight: 500; line-height: 17.58px; margin: 0; padding: 4px 8px 4px 20px;  text-decoration: none; float:right;background-image: url(' . esc_url(WP_STATISTICS_URL . '/assets/images/tip.png') . ');">
                                     ' . __('Tip', 'wp-statistics') . '
                                </span>
                                ' . $tipOfEmail['title'] . '
                            </h2>
                        </div>
                        <div class="content__tip--description" style=" color: #303032; font-family: \'Roboto\',Arial,Helvetica,sans-serif; font-size: 15px; font-weight: 400; line-height: 17.58px; margin: 0; padding: 0; text-decoration: none;">
                            ' . $tipOfEmail['content'] . '
                        </div>
                     </div>
                 </div>
                 ' . $advanced_reporting_ad . $email_footer . $copyright . '</div></div>';


echo $email_body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped