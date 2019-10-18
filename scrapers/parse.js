var all_subjects = document.getElementsByClassName("filterlist");
// console.log( all_subjects.length);
all_subjects = all_subjects[0].children;
var full_text = "Subject, Name, Credits, Lecture Hours, Lab Hours, Other Hours, Description\n";
var subject = "";
var name = "";
var credits = "";
var lecture_hours = "";
var lab_hours = "";
var other_hours = "";
var desc = "";
for (var i = 0; i < all_subjects.length; i++) {
	for (var j = 0; j < all_subjects[i].children[0].children.length; j++) {
		//Get subject name
		if (j === 0) {
			subject  = all_subjects[i].children[0].children[j].children[0].innerHTML;
			// console.log(subject);
		}
		else {
			for (var k = 0; k < all_subjects[i].children[0].children[j].children.length; k++) {
				if (k === 0) {
					name = all_subjects[i].children[0].children[j].children[k].innerHTML.replace(/,/g,"");
					// console.log(name);
				}
				else {
					for(var l = 0; l < 2; l++) {
						if (l === 0) {
							var current_substring_loc = all_subjects[i].children[0].children[j].children[k].children[l].textContent.search("Credits:");
							if (current_substring_loc != -1) {
								credits = all_subjects[i].children[0].children[j].children[k].children[l].textContent.substring(current_substring_loc+9, current_substring_loc+14);
								// console.log(credits);
							}
							else {
								credits = "0.000";
							}
							current_substring_loc = all_subjects[i].children[0].children[j].children[k].children[l].textContent.search("Lecture Hours:");
							if (current_substring_loc != -1) {
								lecture_hours = all_subjects[i].children[0].children[j].children[k].children[l].textContent.substring(current_substring_loc+15, current_substring_loc+21);
								// console.log(lecture_hours);
							}
							else {
								lecture_hours = "0.000";
							}
							current_substring_loc = all_subjects[i].children[0].children[j].children[k].children[l].textContent.search("Lab Hours:");
							if (current_substring_loc != -1) {
								lab_hours = all_subjects[i].children[0].children[j].children[k].children[l].textContent.substring(current_substring_loc+11, current_substring_loc+17);
								// console.log(lab_hours);
							}
							else {
								lab_hours = "0.000";
							}
							//Delete?
							current_substring_loc = all_subjects[i].children[0].children[j].children[k].children[l].textContent.search("Other Hours:");
							if (current_substring_loc != -1) {
								other_hours = all_subjects[i].children[0].children[j].children[k].children[l].textContent.substring(current_substring_loc+13, current_substring_loc+19);
								// console.log(other_hours);
							}
							else {
								other_hours = "0.000";
							}
							// console.log(all_subjects[i].children[0].children[j].children[k].children[l].textContent);
						}
						else {
							desc = all_subjects[i].children[0].children[j].children[k].children[l].textContent.substring(44).replace(/,/g,"").replace(/(\r\n|\n|\r)/gm, "");
							// .replace(/,/g,"");
							// desc.replace(/(\r\n|\n|\r)/gm, "");
							// console.log(desc);
						}
					}
				}
			}
			full_text += subject + ', ' + name + ', ' + credits + ', ' + lecture_hours + ', ' + lab_hours + ', ' + other_hours + ', ' + desc +'\n';
		}
	}
}
console.log(full_text);
// var fs = require('fs');
// fs.writeFile("test.txt", full_text, function(err) {
    // if (err) {
        // console.log(err);
    // }
// });
