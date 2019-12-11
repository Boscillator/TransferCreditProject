function getPrefixFromCode(code) {
    return code.match(/[A-Z]+/)[0];
}

function unique(a) {
    return a.filter((item, i, ar) => ar.indexOf(item) === i);
}

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

function onPrefixSelect(e) {
    const prefix = $(this).children("option:selected").val();
    if(prefix === "all") {
        $("#course_title option").show();
        $("#course_title").val(0);
        return;
    }
    $("#course_title option").hide();
    $(`#course_title option[data-prefix='${prefix}']`).show();
    $("#course_title option[data-prefix='all']").show();
    $("#course_title").val(0);
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
            $('#course_title').append('<option data-prefix="all" value="0">--Course Select--</option>')

            // Add schools from AJAX
            $(courses).each(function(_,course) {
                $("#course_title").append('<option data-prefix="' + getPrefixFromCode(course.code) + '" value="' + course.id + '">' + course.course_name + '</option>')
            });
            $('#course_title').removeAttr("disabled");

            // Add prefixes to prefix select;
            const prefixes = unique(courses.map(c => c.code).map(getPrefixFromCode)).sort();
            $("#prefix").empty();
            $("#prefix").append('<option value="all">All Prefixes</option>')
            $(prefixes).each(function(_, prefix) {
                $("#prefix").append(`<option value="${prefix}">${prefix}</option>`);
            });
            $("#prefix").removeAttr("disabled");
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
    $("#prefix").on('change',onPrefixSelect);
});