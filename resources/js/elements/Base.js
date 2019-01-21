export default class Base {
    constructor() {
        this.header = '';
        this.description = '';
    }

    baseFetch(data) {
        if (data.hasOwnProperty('header')) {
            this.header = data.header;
        }

        if (data.hasOwnProperty('description')) {
            this.description = data.description;
        }
    }
}
