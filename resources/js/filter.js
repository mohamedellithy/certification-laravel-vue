window.Vue = require('vue');

// Declaration
Vue.filter("FormatDateRules", function(value, options) {
    let D = new Date(value);
    let year = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(D),
        month_text = new Intl.DateTimeFormat('en', { month: 'long' }).format(D),
        month_numeric = new Intl.DateTimeFormat('en', { month: 'numeric' }).format(D),
        day_numeric = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(D),
        day_text = new Intl.DateTimeFormat('en', { weekday: 'long' }).format(D);

    let formate_date = "";

    if (options.formate_date == 'M/D/Y') {
        formate_date = (options.date_month ? month_numeric : null) + '/' + (options.date_day ? day_numeric : null) + '/' + (options.date_year ? year : null);
    }

    if (options.formate_date == 'D/M/Y') {
        formate_date = (options.date_day ? day_numeric : null) + '/' + (options.date_month ? month_numeric : null) + '/' + (options.date_year ? year : null);
    }

    if (options.formate_date == 'Y/M/D') {
        formate_date = (options.date_year ? year : null) + '/' + (options.date_month ? month_numeric : null) + '/' + (options.date_day ? day_numeric : null);
    }

    if (options.formate_date == 'M-D-Y') {
        formate_date = (options.date_month ? month_numeric : null) + '-' + (options.date_day ? day_numeric : null) + '-' + (options.date_year ? year : null);
    }

    if (options.formate_date == 'D-M-Y') {
        formate_date = (options.date_day ? day_numeric : null) + '-' + (options.date_month ? month_numeric : null) + '-' + (options.date_year ? year : null);
    }

    if (options.formate_date == 'Y-M-D') {
        formate_date = (options.date_year ? year : null) + '-' + (options.date_month ? month_numeric : null) + '-' + (options.date_day ? day_numeric : null);
    }

    if (options.formate_date == 'm d, y') {
        formate_date = (options.date_month ? month_text : null) + ' ' + (options.date_day ? day_text : null) + ', ' + (options.date_year ? year : null);
    }

    if (options.formate_date == 'D m, y') {
        formate_date = (options.date_day ? day_numeric : null) + ' ' + (options.date_month ? month_text : null) + ', ' + (options.date_year ? year : null);
    }

    if (options.formate_date == 'y, m D') {
        formate_date = (options.date_year ? year : null) + ', ' + (options.date_month ? month_text : null) + ' ' + (options.date_day ? day_numeric : null);
    }

    if (options.text_before_date) {
        formate_date = options.text_before_date + formate_date;
    }

    if (options.text_after_date) {
        formate_date = formate_date + options.text_after_date;
    }

    return formate_date;
});
