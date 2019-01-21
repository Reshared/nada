import Base from './Base'
import Errors from './Errors';

export default class Form extends Base {
    constructor(params) {
        super();
        this.source = params.source;
        this.id = 0;
        this.fields = [];
        this.value = {};
        this.errors = new Errors;
        if (params.hasOwnProperty('id')) {
            this.id = params.id;
        }
        http.get('/structures/form/' + this.source)
            .then((data) => {
                this.baseFetch(data);

                this.fetchOption(data);

                this.fetchFields(data);

                this.fetchValue();
            })
            .catch(() => {
            });
    }

    fetchValue() {
        this.fields.map((field) => {
            this.value[field.key] = '';
        });

        if (this.id) {
            http.get('/item/' + this.source + '/' + this.id)
                .then((data) => {
                    this.value = data;
                })
                .catch(() => {
                });
        }
    }

    fetchOption(data) {
        this.back = data.back;
        this.sab = data.sab;
        this.sae = data.sae;
        this.saa = data.saa;
        this.sav = data.sav;
    }

    fetchFields(data) {
        if (data.hasOwnProperty('fields')) {
            data.fields.map((field) => {
                if (this.id || field.key !== 'id') {
                    this.fields.push(
                        this.newField(field)
                    );
                }
            });
        }
    }

    newField(field) {
        return field;
    }

    save() {
        return new Promise((resolve, reject) => {
            http.post('/item/' + this.source, this.value)
                .then((data) => {
                    resolve();
                })
                .catch((response) => {
                    if (response.status === 422) {
                        this.errors.record(response.data);
                    } else {
                        alert(response.data.message);
                    }

                    reject();
                });
        });
    }
}