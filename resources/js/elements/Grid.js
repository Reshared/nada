import Base from "./Base";
import Data from "./Data";

export default class Grid extends Base {
    constructor(params) {
        super();
        this.source = params.source;
        this.fields = [];
        this.searches = {};
        this.data = new Data(params.source);
        http.get('/structures/grid/' + this.source)
            .then((data) => {
                this.baseFetch(data);

                this.fetchOption(data);

                this.fetchFields(data);

                this.fetchSearchKeys(data);

                this.fetchData();
            })
            .catch(() => {
            });
    }

    fetchOption(data) {
        this.edit = data.edit;
        this.view = data.view;
        this.create = data.create;
        this.delete = data.delete;
        this.mult_select = data.mult_select;
        this.export_able = data.export_able;
        this.paginate = data.paginate;
        this.soft_delete = data.soft_delete;
        this.default_sort = {
            key: data.default_sort,
            type: data.default_sort_type
        };
    }

    fetchData() {
        this.data.order(this.default_sort);
    }

    fetchFields(data) {
        data.fields.map((field) => {
            this.fields.push(
                this.newField(field)
            );
        });
    }

    fetchSearchKeys(data) {
        let keys = {};
        let typeMap = {
            '=': '等于某?的',
            '!': '不等于?的',
            '>': '大于某?的',
            '<': '小于某?的',
            '+': '大于等于某?的',
            '-': '小于等于某?的',
            'i': '选取这些?的',
            'l': '?类似的',
            'b': '?范围的',
        };
        for (let index in data.fields) {
            if (data.fields[index].search) {
                for (let i = 0; i < data.fields[index].search.length; i++) {
                    keys[data.fields[index].key + '-' + data.fields[index].search[i]] = typeMap[data.fields[index].search[i]].replace(/\?/i, data.fields[index].title);
                }
            }
        }
        this.searches = keys;
    }

    newField(field) {
        return field;
    }

    valueEcho(key, value) {
        for (let i in this.fields) {
            if (key === this.fields[i].key) {
                if (this.fields[i].filter) {
                    return this.fields[i].filter.replace(/{\?}/i, value);
                } else {
                    return value;
                }
            }
        }
        return value;
    }

    anyActions() {
        return this.create || this.delete || this.edit;
    }

    destroy(id) {
        return new Promise((resolve, reject) => {
            if (typeof id === 'object') {
                http.delete('/item/' + this.source, {ids: id.join(',')})
                    .then(() => {
                        this.data.get();
                        resolve();
                    })
                    .catch(() => {
                        reject();
                    });
            } else {
                http.delete('/item/' + this.source + '/' + id)
                    .then(() => {
                        this.data.get();
                        resolve();
                    })
                    .catch(() => {
                        reject();
                    });
            }
        });
    }
}
