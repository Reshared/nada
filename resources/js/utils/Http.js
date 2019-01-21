import axios from 'axios';

class Http {
    constructor() {
        this.axios = axios;

        this.axios.defaults.headers.common['X-Requestd-With'] = 'XMLHttpRequest';

        this.axios.defaults.baseURL = '/nada/api';
    }

    get(url, data) {
        return this.request(url, data);
    }

    post(url, data) {
        return this.request(url, data, 'post');
    }

    put(url, data) {
        return this.request(url, data, 'put');
    }

    patch(url, data) {
        return this.request(url, data, 'patch');
    }

    delete(url, data) {
        return this.request(url, data, 'delete');
    }

    option(url, data) {
        return this.request(url, data, 'option');
    }

    request(url, data, method) {
        if (method === undefined) {
            method = 'get';
        }

        if (method === 'get') {
            data = {
                params: data
            };
        }

        return new Promise((resolve, reject) => {
            axios[method.toLowerCase()](url, data)
                .then(({data}) => {
                    this.onSuccess(data);

                    resolve(data);
                })
                .catch(({response}) => {
                    this.onError(response);

                    reject(response);
                });
        });
    }

    onSuccess(data) {
        // console.log(data);
    }

    onError(response) {
        // console.log(response);
    }
}

export default new Http();