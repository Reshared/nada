export default class Data {
    constructor(source) {
        this.list = [];
        this.paginator = {
            current_page: 1,
            total: 0,
            per_page: 15,
            last_page: 0
        };
        this.params = {
            page: this.paginator.current_page,
            size: this.paginator.per_page
        };
        this.source = source;
    }

    page(page) {
        this.params.page = page ? page > 0 ? page < this.paginator.last_page ? page : this.paginator.last_page : page : 1;
        return this;
    }

    search(setting) {
        this.params.where = {};

        if (setting.hasOwnProperty('value') && setting.value) {
            this.params.where[setting.key] = setting.value;
        } else {
            delete this.params.where;
        }

        return this;
    }

    only(type) {
        this.params.only = type;
        return this;
    }

    size(size) {
        this.params.size = size;
        return this;
    }

    order(sorter) {
        if (typeof sorter === 'string') {
            if (sorter !== this.params.sort) {
                this.params.sort = sorter;
                this.params.sort_type = 'asc';
            } else if (this.params.sort_type === 'asc') {
                this.params.sort = sorter;
                this.params.sort_type = 'desc';
            } else if (this.params.sort_type === 'desc') {
                this.params.sort = '';
                this.params.sort_type = ''
            } else {
                this.params.sort = sorter;
                this.params.sort_type = 'asc';
            }

            return this;
        }

        this.params.sort = sorter.key;
        this.params.sort_type = sorter.type;
        return this;
    }

    get() {
        http.get('/data/' + this.source, this.params)
            .then((data) => {
                this.receiveData(data);
            })
            .catch(() => {
            });
    }

    receiveData(data) {
        this.list = data.data;
        this.paginator.current_page = parseInt(data.current_page);
        this.paginator.total = parseInt(data.total);
        this.paginator.per_page = parseInt(data.per_page);
        this.paginator.last_page = parseInt(data.last_page);
    }

    filter(field, value) {
        this.params[field] = value;
        return this;
    }
}