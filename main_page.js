/**
 * Populates the table with the new search information.
 * Called when new search information is received by AJAX.
 * @param search
 */
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


/**
 * Called when a new course is selected from the side bar.
 * Triggers the ajax request to populate the search table.
 * @param e
 */
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

/**
 * Called when a new school is selected in the side bar.
 * Triggers Ajax request to fill the course select page.
 * @param e
 */
function onSchoolSelect(e) {
    $.ajax({
        url:'api/courses.php',
        type: 'get',
        data: {
            school_id: $(this).children("option:selected").val()
        },
        success: function(courses) {

            // courses is a list of objects {id, course_name, ...}

            // Clear out field and add default selector.
            $('#course_title').empty();
            $('#course_title').append('<option value="0"> All Courses</option>')

            // Add schools from AJAX
            $(courses).each(function(_,course) {
                $("#course_title").append('<option value="' + course.id + '">' + course.course_name + '</option>')
            });
            $('#course_title').removeAttr("disabled");
        }
    })
}

/**
 * Triggers an ajax request to populate the school select field with all available schools.
 * Called on page load.
 *
 * Should this be done serverside?
 */
function fetchSchools() {
    $.ajax({
        url:'api/schools.php',
        type: 'get',
        success: function(schools) {

            // schools is a list of objects {id, name}

            $('#school_select').empty();
            $('#school_select').append('<option value="0">All Schools</option>')
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