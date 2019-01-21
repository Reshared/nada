import Menu from './Menu';

export default class Menus {
    constructor() {
        this.menus = [];
    }

    loadMenus(menus) {
        menus.map((menu) => {
            this.menus.push(
                new Menu(menu).loadParentLevels(this.menus)
            );
        });
    }

    topLevel() {
        return this.menus.filter((menu) => {
            return menu.isTopLevel();
        });
    }

    topLevelText() {
        return this.topLevel().map((item) => {
            return item.text();
        });
    }

    count() {
        return this.menus.length;
    }
}