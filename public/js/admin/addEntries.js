String.prototype.capitalize = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

var options;
var select;
var mainContainer;
var selectContainer;
var inputName;

function addEntries(name, containerId, selectId, inputType) {
    select = document.getElementById(selectId);
    mainContainer = document.getElementById(containerId);
    selectContainer = select.parentNode.parentNode;
    inputType = inputType !== undefined ? inputType : 'input';
    inputName = name;

    var option = select.options[select.selectedIndex];

    if (isEntryNotCreated(option))
        addEntryField(option, inputType);
}

function isEntryNotCreated(option) {
    if (option === undefined)
        return false;

    var list = document.getElementsByClassName('entry' + inputName.capitalize() + 'Input');

    for (var i = 0; i < list.length; i++) {
        if (list[i].name.split('[')[1] === (option.value + ']'))
            return false;
    }

    return true;
}

function addEntryField(option, inputType) {
    var div = document.createElement('div');
    setAttributes(div, {'class': 'form-group d-flex',});

    var inputContainer = document.createElement('div');
    setAttributes(inputContainer, {'class': 'flex-grow-1',});
    div.appendChild(inputContainer);

    var label = document.createElement('label');
    setAttributes(label, {
        'for': "transEntry" + inputName.capitalize() + option.value.capitalize(),
        'class': 'col-form-label'
    });
    label.innerHTML = option.value.capitalize() + " language " + inputName;
    inputContainer.appendChild(label);

    var input = document.createElement(inputType);
    setAttributes(input, {
        'class': 'form-control entry' + inputName.capitalize() + 'Input',
        'id': "transEntry" + inputName.capitalize() + option.value.capitalize(),
        'type': 'text',
        'name': inputName + '[' + option.value + ']',
        'required': ''
    });
    inputContainer.appendChild(input);

    var deleteBtn = document.createElement('button');
    setAttributes(deleteBtn, {
        'class': 'btn btn-danger ml-2 mt-auto',
        'onclick': "removeEntryField(this)",
        'type': 'button'
    });
    deleteBtn.innerHTML = "&times;";
    div.appendChild(deleteBtn);

    mainContainer.appendChild(div);
    mainContainer.insertBefore(div, selectContainer);
}

function removeEntryField(deleteBtn) {
    var group = deleteBtn.parentNode;
    group.parentNode.removeChild(group);
}

function setAttributes(elem, attrs) {
    for (var key in attrs) {
        elem.setAttribute(key, attrs[key]);
    }
}
