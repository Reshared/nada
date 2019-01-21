<template>
    <ul>
        <li v-for="(subMenu, index) in this.menu.subMenus()" :key="index">
            <p>{{subMenu.title}}</p>
            <menu-item v-if="subMenu.hasSubLevel()" :menu="subMenu"></menu-item>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "MenuItem",
        props: {
            menu: {
                type: Object
            }
        }
    }
</script>

<style scoped>

</style>