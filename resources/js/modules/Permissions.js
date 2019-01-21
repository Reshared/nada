export default new class Permissions {
    constructor() {
        this.permissions = [];
    }

    store(permission) {
        this.permissions.push({path: permission.path, name: permission.name, mod: permission.mod});
        return this;
    }

    can(permission) {
        return this.permissions.indexOf(permission) !== false;
    }
}