$(document).ready(function() {
    $.getJSON('./labs.json', function(data) {
        var x = location.hash.substr(1);
        for (var i = 0; i < data.length; i++) {
            if (x === data[i].FileName) {
                var lab = data[i];
                $('#lab-name').text(lab.FileName);
                $('#lab-time').text(lab.DueDate);
                $('#lab-description').text(lab.Description);
                $('#lab-instructions').attr('href',lab.Instructions);
            }
        }
    })
})