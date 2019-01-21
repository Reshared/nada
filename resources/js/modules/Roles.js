export default new class Roles {
    constructor() {
        this.roles = [];
    }

    store(role) {
        this.roles.push(role);
    }

    is(role) {
        return this.roles.indexOf(role) !== false;
    }

    get() {
        return this.roles;
    }
}