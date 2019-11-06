import * as helper from'../helpers/mainHelper';

class Translatable {
    constructor(name, parentId, languages, inputType = "input") {
        this.setVars(name, parentId, languages, inputType);
        this.initSelect();
    }

    setVars(name, parentId, languages, inputType) {
        this.name = name;
        this.inputType = inputType;
        this.container = document.getElementById(parentId);
        this.languages = languages;
        this.entries = {};
    }

    setEntries(entries) {
        for (let k in entries)
            this.addEntryField(k, entries[k]);
    }

    initSelect() {
        let selectContainer = document.createElement('div');
        helper.setAttributes(selectContainer, {'class': 'form-group row d-flex align-items-end'});

        let div = document.createElement('div');
        helper.setAttributes(div, {'class': 'col-lg-8'});
        selectContainer.appendChild(div);

        let label = document.createElement('label');
        helper.setAttributes(label, {
            'for': `${this.name}Select`,
            'class': 'col-form-label'
        });
        label.innerHTML = `Choose language to add ${this.name} entry`;
        div.appendChild(label);

        this.select = document.createElement('select');
        helper.setAttributes(this.select, {
            'class': 'form-control',
            'id': `${this.name}Select`,
        });
        div.appendChild(this.select);

        let option;
        for (let k in this.languages) {
            option = document.createElement('option');
            helper.setAttributes(option, {'value': this.languages[k].code});
            option.innerHTML = this.languages[k].name;
            this.select.appendChild(option);
        }

        div = document.createElement('div');
        helper.setAttributes(div, {'class': 'col-lg-4'});
        selectContainer.appendChild(div);

        let addingBtn = document.createElement('button');
        helper.setAttributes(addingBtn, {
            'class': 'btn btn-primary btn-block addingBtn',
            'id': `adding${this.name.capitalize()}Btn`,
            'type': 'button'
        });
        addingBtn.innerHTML = 'Add translations';
        addingBtn.addEventListener('click', this);
        div.appendChild(addingBtn);

        this.container.appendChild(selectContainer);
    }

    handleEvent(event) {
        this['on' + event.type](event);
    }

    onclick(event) {
        let target = event.target;
        if (helper.classIncludes(target, 'addingBtn'))
            this.addEntries(target);

        if (helper.classIncludes(target, 'deletingBtn'))
            this.removeEntryField(target);
    }

    addEntries(button) {
        let option = this.select.options[this.select.selectedIndex];

        if (this.isEntryNotCreated(option))
            this.addEntryField(option.value);
    }

    addEntryField(language, value = '') {
        let div = document.createElement('div');
        helper.setAttributes(div, {'class': 'form-group d-flex',});

        let inputContainer = document.createElement('div');
        helper.setAttributes(inputContainer, {'class': 'flex-grow-1',});
        div.appendChild(inputContainer);

        let label = document.createElement('label');
        helper.setAttributes(label, {
            'for': `${language}${this.name.capitalize()}`,
            'class': 'col-form-label'
        });
        label.innerHTML = language.capitalize() + " language " + this.name;
        inputContainer.appendChild(label);

        let input = document.createElement(this.inputType);
        let inputId = `${language}${this.name.capitalize()}`;
        helper.setAttributes(input, {
            'class': 'form-control',
            'id': inputId,
            'type': 'text',
            'value' : value,
            'name': `${this.name}[${language}]`,
            'required': ''
        });
        this.entries[language] = input;
        input.innerHTML = value;
        inputContainer.appendChild(input);

        let deleteBtn = document.createElement('button');
        helper.setAttributes(deleteBtn, {
            'class': 'btn btn-danger ml-2 mt-auto deletingBtn',
            'id': `${language}${this.name.capitalize()}DeletingBtn`,
            'type': 'button'
        });
        deleteBtn.innerHTML = "&times;";
        deleteBtn.addEventListener('click', this);
        div.appendChild(deleteBtn);

        this.container.appendChild(div);
        this.container.insertBefore(div, this.select.parentNode.parentNode);

        if(this.inputType === 'textarea')
            CKEDITOR.replace(inputId);
    }

    removeEntryField(entry) {
        let lang = entry.id.substr(0, 2);
        delete this.entries[lang];

        let group = entry.parentNode;
        group.parentNode.removeChild(group);
    }

    isEntryNotCreated(option) {
        if (option === undefined)
            return false;

        return this.entries[option.value] === undefined;
    }
}

export default Translatable;
window.Translatable = Translatable;
