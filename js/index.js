let inputs = $("input[type='range']");

// give each input the same value initially (a fraction of a total 1000)
let values = [];

for (let i = 0; i < inputs.length; i++) {
	inputs[i].value = 1000 / inputs.length;
	values[i] = 1000 / inputs.length;
}

// set new values for all inputs exept the one that has been manually interacted with
// and distribute the resulting difference so that the ratio is kept
function setPercentage(input) {

	// calculate the new total inputs values sum,
	// the sum of the values of the inputs that hasn't been manually interacted with
	// and the difference of 1000 and the total inputs values sum 
	// wich is the negation of how much the value of the input that has been manually interacted with has gained
	let totalSum = 0;
	let unaffectedValuesSum = 0;

	for (let i = 0; i < inputs.length; i++) {
		totalSum += parseFloat(inputs[i].value);
		if (inputs[i].id == input.id) {
			// update the values array
			values[i] = parseFloat(input.value);
		} else {
			unaffectedValuesSum += parseFloat(inputs[i].value);
		}
	}

	let difference = 1000 - totalSum;
	
	// calculate the values ratio and the new value of each of the still unaffected inputs
	for (let i = 0; i < inputs.length; i++) {
		if (inputs[i].id != input.id) {
			let ratio;
			if (unaffectedValuesSum != 0) {
				ratio = parseFloat(inputs[i].value) / unaffectedValuesSum;
			} else {
				ratio = 1 / (inputs.length - 1);
			}
			// update the values array
			values[i] += difference * ratio;
		}
	}

	// update the inputs values in the dom
	for (let i = 0; i < inputs.length; i++) {
		inputs[i].value = values[i];
	}
}

// sort and render steel grades on click
function sort(string) {
	for (grade of steelGrades) {
		grade.score = 0;
		for (input of inputs) {
			let property = input.id;
			let points = parseFloat(grade[property]);
			let factor = parseFloat(input.value);
			grade.score += points * factor;
		}
	}

	steelGrades.sort(function(a, b) {
		return b.score - a.score;
	});

	$("#steelGrades").empty();

	for (grade of steelGrades) {
		$("#steelGrades").append(`
			<a href="details.php?id=${grade.mainId}">${grade.name}</a><br>
			<br>
		`);
	}
}

sort();

$(document).ready(function() {
	$("#sort").click(function() {
		sort();
	});
});