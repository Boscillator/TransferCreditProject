
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

function onCourseSelect(e) {
    $.ajax({
        url: 'api/search.php',
        type: 'get',
        data: {
            id: 1547
        },
        success: onSearchFinished
    })
}

function fetchSchools() {
    $.ajax({
        url:'api/schools.php',
        type: 'get',
        success: function(schools) {
            $(schools).each(function(_,school) {
                console.log(school);
                $("#school_select").append('<option value="' + school.id + '">' + school.name + '</option>')
            });
            console.log("AHH");
            $('#school_select').removeAttr("disabled");
        }
    })
}


$(document).ready(function () {
    fetchSchools();
    $("#course_title").on('change', onCourseSelect);
});