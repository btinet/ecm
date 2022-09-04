/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap');
import {} from 'tablesorter';



$(function() {
    $.extend($.tablesorter.themes.jui, {
        // change default jQuery uitheme icons - find the full list of icons at
        // http://jqueryui.com/themeroller/ (hover over them for their name)
        table        : 'ui-widget ui-widget-content ui-corner-all', // table classes
        caption      : 'ui-widget-content',
        // header class names
        header       : 'ui-widget-header ui-corner-all ui-state-default', // header classes
        sortNone     : '',
        sortAsc      : '',
        sortDesc     : '',
        active       : 'ui-state-active', // applied when column is sorted
        hover        : 'ui-state-hover',  // hover class
        // icon class names
        icons        : 'ui-icon', // icon class added to the <i> in the header
        iconSortNone : 'ui-icon-carat-2-n-s ui-icon-caret-2-n-s', // class name added to icon when column is not sorted
        iconSortAsc  : 'ui-icon-carat-1-n ui-icon-caret-1-n', // class name added to icon when column has ascending sort
        iconSortDesc : 'ui-icon-carat-1-s ui-icon-caret-1-s', // class name added to icon when column has descending sort
        filterRow    : '',
        footerRow    : '',
        footerCells  : '',
        even         : 'ui-widget-content', // even row zebra striping
        odd          : 'ui-state-default'   // odd row zebra striping
    });

    var $table = $('table'),
        // define pager options
        pagerOptions = {
            // target the pager markup - see the HTML block below
            container: $(".pager"),
            // output string - default is '{page}/{totalPages}';
            // possible variables: {size}, {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
            // also {page:input} & {startRow:input} will add a modifiable input in place of the value
            output: '{startRow} - {endRow} / {filteredRows} ({totalRows})',
            // if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
            // table row set to a height to compensate; default is false
            fixedHeight: true,
            // remove rows from the table to speed up the sort of large tables.
            // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
            removeRows: false,
            // go to page selector - select dropdown that sets the current page
            cssGoto: '.gotoPage'
        };

    // Initialize tablesorter
    // ***********************
    $table
        .tablesorter({
            theme: 'bootstrap',
            headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
            widthFixed: true,
            widgets: ['zebra', 'filter', 'stickyHeaders'],
            stickyHeaders: true,

        })


});

