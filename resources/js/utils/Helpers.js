export function removeElement(element) {
    element && element.parentNode && element.parentNode.removeChild(element);
}

export function defaultParam(param, def) {
    return param === null ? def : param;
}