function updateValue(element, column, id){
    var value = element.innerText;

    console.log(value + column + id);
    $.ajax({
        url: 'api/update.php',
        type: 'post',
        data: {
            value: value,
            column: column,
            id: id
        },
        success:function(data){
            $('#results_body').append(data);
        }
    })
}

/**
 * Called when a new school is selected in the side bar.
 * Triggers Ajax request to fill the course select page.
 * @param e
 */
function onSchoolSelect(e) {
    $.ajax({
        url:'api/course_admin.php',
        type: 'post',
        data: {
            school_id: $(this).children("option:selected").val()
        },
        success: function(data) {
            $('#results_body').html(data);
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