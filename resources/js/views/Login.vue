<template>
    <div>
        <h1>Login</h1>
        <form @submit.prevent="onSubmit">
            <input v-model="email" type="email" name="email">
            <input v-model="password" type="password" name="password">
            <input type="submit">
        </form>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            onSubmit() {
                http.post('/login', {email: this.email, password: this.password})
                    .then(() => {
                        this.$router.push({name: 'home'});
                    })
                    .catch(() => {});
            }
        }
    }
</script>

<style scoped>

</style>