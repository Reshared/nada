export default class Menu {
    constructor(menu) {
        this.id = menu.id;
        this.title = menu.title;
        this.path = menu.path;
        this.parent_id = parseInt(menu.parent_id);
        this.parentMenus = null;
    }

    isTopLevel() {
        return this.parent_id === 0;
    }

    loadParentLevels(menus) {
        this.parentMenus = menus;
        return this;
    }

    hasSubLevel() {
        if (this.noParent()) {
            return false;
        }

        for (let i in this.parentMenus) {
            if (this.parentMenus[i].parent_id === this.id) {
                return true;
            }
        }

        return false;
    }

    subMenus() {
        let sub = [];

        for (let i in this.parentMenus) {
            if (this.parentMenus[i].parent_id === this.id) {
                sub.push(this.parentMenus[i]);
            }
        }

        return sub;
    }

    noParent () {
        return this.parentMenus === null;
    }
}