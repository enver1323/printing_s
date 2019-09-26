import APISelect from "./apiSelect";
import Translatable from "./translatable";
import * as Helper from "../helpers/mainHelper"

export default class DataValueList {
    constructor(name, parentId, apiUrl, languages, values) {
        this.setVars(name, parentId, apiUrl, languages, values);
        this.initValue();
    }

    setVars(name, parentId, apiUrl, languages) {
        this.name = name;
        this.apiUrl = apiUrl;
        this.languages = languages;
        this.container = document.getElementById(parentId);
        this.entries = {};
    }

    setEntries(entries) {
        for (let k in entries){
            let values = JSON.parse(entries[k]['value']);
            let currentLanguage = window.location.pathname.split('/')[1];
            let name = JSON.parse(entries[k]['data_key']['name'])[currentLanguage];

            this.addEntryField(entries[k]['data_key']['id'],
                name,
                values
            );
        }
    }

    initValue() {
        let selectContainer = document.createElement('div');
        Helper.setAttributes(selectContainer, {'class': 'form-group row d-flex align-items-end'});

        this.container.appendChild(selectContainer);

        let div = document.createElement('div');
        Helper.setAttributes(div, {'class': 'col-lg-8'});
        selectContainer.appendChild(div);

        let label = document.createElement('label');
        Helper.setAttributes(label, {
            'for': `${this.name}Select`,
            'class': 'col-form-label'
        });
        label.innerHTML = `Choose data key to add`;
        div.appendChild(label);

        this.select = document.createElement('select');
        Helper.setAttributes(this.select, {
            'class': 'form-control',
            'id': `${this.name}Select`,
        });
        div.appendChild(this.select);
        new APISelect(`#${this.name}Select`, this.apiUrl);

        div = document.createElement('div');
        Helper.setAttributes(div, {'class': 'col-lg-4'});
        selectContainer.appendChild(div);

        let addingBtn = document.createElement('button');
        Helper.setAttributes(addingBtn, {
            'class': 'btn btn-secondary btn-block addingBtn',
            'id': `adding${this.name.capitalize()}Btn`,
            'type': 'button'
        });
        addingBtn.innerHTML = 'Add values';
        addingBtn.addEventListener('click', this);
        div.appendChild(addingBtn);
    }

    handleEvent(event) {
        this['on' + event.type](event)
    }

    onclick(event) {
        let target = event.target;
        if (Helper.classIncludes(target, 'addingBtn'))
            this.addEntries(target);

        if (Helper.classIncludes(target, 'deletingBtn'))
            this.removeEntryField(target);
    }

    addEntries(button) {
        let option = this.select.options[this.select.selectedIndex];
        let optionName = document.getElementById('select2-valuesSelect-container').innerHTML;

        if (this.isEntryNotCreated(option))
            this.addEntryField(option.value, optionName);
    }

    addEntryField(keyId, keyName, entries = []) {
        let row = document.createElement('div');
        Helper.setAttributes(row, {'class': 'row',});

        let keyCol = document.createElement('div');
        Helper.setAttributes(keyCol, {'class': 'col-md-4 d-flex align-items-center',});
        row.appendChild(keyCol);

        let header = document.createElement('h5');
        header.innerHTML = keyName;
        keyCol.appendChild(header);

        let deleteBtn = document.createElement('button');
        Helper.setAttributes(deleteBtn, {
            'class': 'btn btn-danger ml-2 my-auto deletingBtn',
            'id': `${keyId}-${this.name.capitalize()}DeletingBtn`,
            'type': 'button'
        });
        deleteBtn.innerHTML = "Delete value &times;";
        deleteBtn.addEventListener('click', this);
        keyCol.appendChild(deleteBtn);

        let translationCol = document.createElement('div');
        Helper.setAttributes(translationCol, {
            'class': 'col-md-8',
            'id': `${keyId}TranslationCol`
        });
        row.appendChild(translationCol);

        let hr = document.createElement('hr');

        this.entries[keyId] = true;

        this.container.appendChild(row);
        this.container.appendChild(hr);

        this.container.insertBefore(row, this.select.parentNode.parentNode);
        this.container.insertBefore(hr, this.select.parentNode.parentNode);

        let translatable = new Translatable(`${this.name}[${keyId}][value]`, `${keyId}TranslationCol`, this.languages);
        translatable.setEntries(entries);
    }

    removeEntryField(entry) {
        let key = entry.id.split('-')[0];
        delete this.entries[key];

        let group = entry.parentNode.parentNode;
        group.parentNode.removeChild(group);
    }

    isEntryNotCreated(option) {
        if (option === undefined)
            return false;

        return this.entries[option.value] === undefined;
    }
}

window.DataValueList = DataValueList;
