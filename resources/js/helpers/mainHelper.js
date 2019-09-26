String.prototype.capitalize = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

export function setAttributes(elem, attrs) {
    for (let key in attrs) {
        elem.setAttribute(key, attrs[key]);
    }
}

export function classIncludes(domElem, className) {
    return domElem.getAttribute('class').includes(className);
}
