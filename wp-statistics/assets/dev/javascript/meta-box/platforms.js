wps_js.platforms_meta_box = {

    placeholder: function () {
        return wps_js.rectangle_placeholder();
    },

    view: function (args = []) {

        // Create Html
        let html = '';

        // Check Show Button Group
        // if (wps_js.is_active('overview_page')) {
        //     html += wps_js.btn_group_chart('platforms', args);
        //     setTimeout(function () {
        //         wps_js.date_picker();
        //     }, 1000);
        // }

        // Add Chart
        html += '<div class="o-wrap"><div class="c-chart c-chart--limited-height"><canvas id="' + wps_js.chart_id('platforms') + '" height="220"></canvas></div></div>';

        // show Data
        return html;
    },

    meta_box_init: function (args = []) {
        // Prepare Data
        let data = [{
            label: wps_js._('platform'),
            data: args['platform_value'],
         }];

        const label_callback = function (tooltipItem) {
            return tooltipItem.label;
        }

        const title_callback = (ctx) => {
            return wps_js._('visitors') + ':' + ctx[0].formattedValue
        }

        wps_js.horizontal_bar(wps_js.chart_id('platforms'), args['platform_name'], data[0].data , args['platform_logos']);

        // Check Table information
        if (wps_js.exist_tag('#' + wps_js.getMetaBoxKey('platforms-table'))) {

            // Reset All Height
            ['platforms-table', 'platforms'].forEach((key) => {
                jQuery("#" + wps_js.getMetaBoxKey(key) + " .inside").removeAttr("style");
            });

            // Show Table information
            let tbl = `<div class="title-center">${args.title}</div>
                    <table width="100%" class="o-table">
                        <tr>
                            <td class="wps-text-muted">${wps_js._('platform')}</td>
                            <td class="wps-text-muted">${wps_js._('visitor_count')}</td>
                            <td class="wps-text-muted">${wps_js._('percentage')}</td>
                        </tr>`;

            for (let i = 0; i < args.platform_name.length; i++) {
                tbl += `
                 <tr>
                        <td>${args.platform_name[i]}</td>
                        <td>${(parseInt(args.platform_value[i]) > 0 ? `<a href="` + args.info.visitor_page + `&platform=` + args.platform_name[i] + `&from=` + args.from + `&to=` + args.to + `" target="_blank"> ${wps_js.number_format(args.platform_value[i])} </a>` : wps_js.number_format(args.platform_value[i]))}</td>
                        <td>${wps_js.number_format((args.platform_value[i] / args.total) * 100)}%</td>
                 </tr>
                `;
            }

            // Set Total
            tbl += ` <tr><td>${wps_js._('total')}</td><td>${wps_js.number_format(args.total)}</td><td></td></tr>`;
            tbl += `</table>`;
            jQuery("#" + wps_js.getMetaBoxKey('platforms-table') + " .inside").html(tbl);

            // Set Equal Height
            wps_js.set_equal_height('.postBox-table .inside', '.postBox-chart .inside');
        }

    }

};
