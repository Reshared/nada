<template>
    <div>
        <top-header></top-header>
        <Menu></Menu>
        <grid-component></grid-component>
    </div>
</template>

<script>
    import TopHeader from './../components/Header';
    import Menu from './../components/Menu';
    import GridComponent from './../components/Grid';

    export default {
        name: "List",
        components: {
            TopHeader, Menu, GridComponent
        }
    }
</script>

<style scoped>

</style>
