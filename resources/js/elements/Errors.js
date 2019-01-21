export default class Errors {
    constructor() {
        this.errors = {};
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    record(data) {
        this.errors = data.errors;
    }

    clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }
        this.errors = {};
    }

    classes(field) {
        return this.has(field) ? 'is-error' : '';
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }
}