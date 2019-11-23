function updateValue(element, column, id){
    var value = element.innerText;

    console.log(element+column+id);
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
            var template="";
            // courses is a list of objects {id, course_name, ...}
            // Add schools from AJAX
            $(courses).each(function(_,course) {
                template += `
                <tr>
                    <td><div contenteditable="true" onblur="updateValue()">${course.code}<div></td>
                    <td><div contenteditable="true">${course.course_name}<div></td>
                    <td>${course.school}</td>
                </tr>
                `;
                $("#results_body > table > tbody").html(template);
            });
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
});