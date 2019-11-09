
function onSearchFinished(search) {
    var template = "";
    $(search).each(function(idx, course) {
        console.log(course);
        template += `
        <tr>
            <td>${course.code}</td>
            <td>${course.name}</td>
            <td>${course.school}</td>
        </tr>
        `;
    });
    $("#results_body > table > tbody").html(template);
}

function onSearchFunctionChange(e) {
    $.ajax({
        url: './mock_search.json',
        success: onSearchFinished
    })
}

$(document).ready(function () {
    console.log("FOO BAR");
    $("select").on('change', onSearchFunctionChange);
});