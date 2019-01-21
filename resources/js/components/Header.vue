<template>
    <div>
        <p>Hello, <a href="#">{{ this.$store.getters.user.name }}</a>, welcome back!</p>

        <p>ur roles are: </p>

        <ul>
            <li v-for="(role, index) in this.$store.getters.roles.get()" :v-key="index" v-text="role"></li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Header"
    }
</script>

<style scoped>

</style>