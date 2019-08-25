var percentFields = document.getElementsByClassName('langPercent');
for (var key in percentFields)
    colorField(percentFields[key]);

function colorField(field) {
    var percent = field.innerHTML.split('%')[0] / 100;
    field.style.color = getColor(percent);
}

function getColor(value) {
    var hue = ((value) * 120).toString(10);
    return ["hsl(", hue, ",100%,50%)"].join("");
}
