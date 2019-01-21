<template>
    <div>
        <p>this is menus（{{ this.menus.count() }}）个菜单</p>
        <ol>
            <li v-for="(menu, index) in this.menus.topLevel()" :key="index">
                <p>{{menu.title}}</p>
                <menu-item v-if="menu.hasSubLevel()" :menu="menu"></menu-item>
            </li>
        </ol>
    </div>
</template>

<script>
    import Menus from "../modules/Menus";
    import MenuItem from "./MenuItem";

    export default {
        name: "Menu",
        components: {
            MenuItem
        },
        data() {
            return {
                menus: new Menus
            }
        },
        methods: {
            loadMenus() {
                http.get('/menus')
                    .then((menus) => {
                        this.menus.loadMenus(menus)
                    })
                    .catch(() => {
                    });
            }
        },
        created() {
            this.loadMenus();
        }
    }
</script>

<style scoped>

</style>