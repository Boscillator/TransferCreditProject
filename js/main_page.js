
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
            id: $(this).children("option:selected").val()
        },
        success: onSearchFinished
    })
}

function onSchoolSelect(e) {
    $.ajax({
        url:'api/courses.php',
        type: 'get',
        data: {
            school_id: $(this).children("option:selected").val()
        },
        success: function(courses) {
            $('#course_title').empty();
            $('#course_title').append('<option value="0">--Course Select--</option>')
            $(courses).each(function(_,course) {
                $("#course_title").append('<option value="' + course.id + '">' + course.course_name + '</option>')
            });
            $('#course_title').removeAttr("disabled");
        }
    })
}

function fetchSchools() {
    $.ajax({
        url:'api/schools.php',
        type: 'get',
        success: function(schools) {
            $('#school_select').empty();
            $('#school_select').append('<option value="0">--Select School--</option>')
            $(schools).each(function(_,school) {
                $("#school_select").append('<option value="' + school.id + '">' + school.name + '</option>')
            });
            $('#school_select').removeAttr("disabled");
        }
    })
}


$(document).ready(function () {
    fetchSchools();
    $("#school_select").on('change', onSchoolSelect);
    $("#course_title").on('change', onCourseSelect);
});