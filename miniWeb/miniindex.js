$(document).ready(function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm +  '-' + dd ;
    $.getJSON('', function(data) {
        for (var i = 0; i < data.length(); i++) {
            if (data[i].DueDate == today) {
                $('#present').append('<li>' + data[i].fileName + '</li>')
            } else if (data[i].DueDate > today) {
                $('#future').append('<li>' + data[i].fileName + '</li>')
            } else if (data[i].DueDate < today) {
                $('#past').append('<li>' + data[i].fileName + '</li>')
            }
        }
    })
})