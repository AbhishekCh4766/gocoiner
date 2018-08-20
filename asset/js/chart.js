jQuery(function () {
    "use strict";

    var priceChart = Morris.Area({
        element: 'price_chart'
        , xkey: 'date'
        , ykeys: ['price']
        , labels: ['Price']
        , pointSize: 2
        , fillOpacity: 0.1
        , pointStrokeColors: ['#009efb']
        , behaveLikeLine: true
        , gridLineColor: '#e0e0e0'
        , lineWidth: 0.5
        , smooth: false
        , hideHover: 'auto'
        , lineColors: ['#009efb']
        , resize: true
    });

    var volumeChart = Morris.Bar({
        element: 'volume_chart'
        , xkey: 'date'
        , ykeys: ['volume']
        , labels: ['Volume']
        , barColors: ['#55ce63', '#2f3d4a', '#009efb']
        , hideHover: 'auto'
        , gridLineColor: '#eef0f2'
        , resize: true
    });

    // destroy datatable
    jQuery.fn.destroyDataTable = function () {
        if (this.hasClass('dataTable')) {
            this.DataTable().destroy();
        }
    };

    // datatable initialization and re-initialization
    jQuery.fn.initDataTable = function (rowsPerPage, order, searchEnabled, footerCallback, footerCallbackArguments, buttons) {
        rowsPerPage = rowsPerPage || 15;
        order = order || [];
        searchEnabled = searchEnabled || false;
        footerCallback = footerCallback || function () {
        };
        buttons = buttons || false;
        var jQueryself = this;
        var table;
        var displayStart = 0;
        // if table exist retrieve its current order and page
        if (jQueryself.hasClass('dataTable')) {
            table = jQueryself.DataTable();
            var info = table.page.info();
            var order = table.order();
            displayStart = info.page;
            order = [[order[0][0], order[0][1]]];
            table.destroy();
        }

        table = jQueryself.DataTable({
            bLengthChange: false,
            pageLength: rowsPerPage,
            displayStart: displayStart * rowsPerPage,
            bFilter: searchEnabled,
            order: order,
            info: false, // hide "Showing 1 to K of N Entries"
            footerCallback: function () {
                if (typeof footerCallbackArguments != 'undefined') {
                    var extendedArguments = Array.prototype.slice.call(arguments);
                    extendedArguments.push(footerCallbackArguments);
                    footerCallback.apply(this, extendedArguments);
                } else {
                    footerCallback.apply(this);
                }
            },
            initComplete: function (settings, json) {
                if (!jQueryself.is(':visible')) {
                    jQueryself.show();
                }
            },
            dom: 'Bfrtip',
            buttons: buttons
        });

        if (searchEnabled) {
            jQueryself.closest('.dataTables_wrapper').find('.dataTables_filter').addClass('ui icon small input').append('<i class="search icon"></i>');
        }

        if (buttons) {
            jQueryself.closest('.dataTables_wrapper').find('.buttons-csv').addClass('ui basic icon button').prepend('<i class="file excel outline icon"></i> ');
        }

        return table;
    };

    function displayHistoricalDataTable(history) {
        var jQuerytable = jQuery('#historical-data').find('table');
        var jQuerytbody = jQuerytable.find('tbody');
        var n = history.length;
        for (var i = 0; i < n; i++) {
            if (history[i].value > 0) {
                jQuerytbody.append('<tr>' +
                    '<td>' + history[i].date + '</td>' +
                    '<td class="text-right"><sup>USD</sup>' + history[i].price_fmt + '</td>' +
                    '<td class="text-right" data-order="' + history[i].volume + '">' + history[i].volume_fmt + ' <sup>USD</sup></td>' +
                    '</tr>');
            }
        }
        jQuerytable.initDataTable(15, [[0, 'desc']]);
    }

    function showTable(data) {
        var data_table = jQuery('#historical-data');

        data_table.DataTable().destroy();

        data_table.DataTable({
            ordering: true,
            searching: false,
            data: data,
            columns: [
                {data: 'date'},
                {data: 'price_fmt', className: 'dt-right'},
                {data: 'volume_fmt', className: 'dt-right'}
            ]
        });
    }

    function fetchData(jQuerylimit) {
        var DATA = {symbol: SYMBOL, limit: jQuerylimit};
        jQuery.ajax({
            type: "POST",
            url: AJAX_URL,
            dataType: "json",
            data: DATA,
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        })
            .done(function (data) {
                //graph.setData(JSON.parse(data));
                priceChart.setData(data);
                volumeChart.setData(data.reverse());
                showTable(data);
                //displayHistoricalDataTable(data);
            })
            .fail(function () {
                //alert("error occured");
            });
    }

    // Request initial data for the past 7 days
    fetchData(7);

    jQuery('div#ranges button').click(function (e) {
        e.preventDefault();

        // Get the number of days from the data attribute
        var el = jQuery(this);
        var days = el.attr('data-range');

        // Request the data and render the chart using our handy function
        fetchData(days);

        // Make things pretty to show which button/tab the user clicked
        el.removeClass('btn-secondary');
        el.addClass('btn-info');
        el.siblings().addClass('btn-secondary');
        el.siblings().removeClass('btn-info');
    });

});