function formatDate(date, withHours) {
    var monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"
    ];

    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();

    var str = monthNames[monthIndex] + ' ' + day + ', ' + year;

    if (withHours === true) {
        str += ' - ' + date.getHours() + ':' + date.getMinutes();
    }

    return str;
}