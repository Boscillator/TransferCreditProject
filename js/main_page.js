
function onSearchFinished(search) {
    var template = "";
    $(search).each(function(idx, course) {
        console.log(course);
        template += `
        <tr>
            <td>${course.code}</td>
            <td>${course.course_name}</td>
            <td>${course.school}</td>
        </tr>
        `;
    });
    $("#results_body > table > tbody").html(template);
}

function onSearchFunctionChange(e) {
    $.ajax({
        url: './api/search.php',
        type: 'get',
        data: {
            id: 1547
        },
        success: onSearchFinished
    })
}

$(document).ready(function () {
    console.log("FOO BAR");
    $("select").on('change', onSearchFunctionChange);
});