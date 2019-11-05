function makeLink(lab) {
    return `<li><a href="./lab.html#${lab.FileName}">${lab.FileName}</a>`
}

$(document).ready(function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm +  '-' + dd ;
    $.getJSON('labs.json', function(data) {
        for (var i = 0; i < data.length; i++) {
            console.log(data[i]);
            if (data[i].DueDate == today) {
                $('#present').append(makeLink(data[i]));
            } else if (data[i].DueDate > today) {
                $('#future').append(makeLink(data[i]));
            } else if (data[i].DueDate < today) {
                $('#past').append(makeLink(data[i]));
            }
        }
    })
})