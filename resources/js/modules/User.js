export default new class User {
    constructor() {
        this.id = 0;
        this.name = '';
        this.email = '';
        this.avatar = '';
    }

    store(data) {
        this.id = data.id;
        this.name = data.name;
        this.email = data.email;
        this.avatar = data.avatar;
        return this;
    }

    destroy() {
        this.id = 0;
        this.name = '';
        this.email = '';
        this.avatar = '';
    }
}