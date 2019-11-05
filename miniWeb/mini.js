$(document).ready(function() {
    $.getJSON('', function(data) {
        var x = location.hash;
        for (var i = 0; i < data.length(); i++) {
            if (x == data[i].fileName) {
                document.html(
                    "<h1>"+ data[i].FileName + "</h1>" +
                    "<p>Description: " + data[i].Description + "</p>" +
                    "<p href='"+ data[i].Instruction + "'>Instructions</p>" +
                    "<p>Due Date: " + data[i].DueDate + "</p>")
            }
        }
    })
})