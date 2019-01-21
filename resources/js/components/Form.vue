<template>
    <div>
        <h1>Header: {{form.header}}</h1>
        <h2>Description: {{form.description}}</h2>
        <form v-model="form" @keydown="form.errors.clear($event.target.name)">
            <div v-for="(field, index) in form.fields" :key="index">
                {{field.title}}:
                <input type="text" :name="field.key" :readonly="field.readOnly" :placeholder="field.help" v-model="form.value[field.key]">
                <p v-if="form.errors.has(field.key)" v-text="form.errors.get(field.key)"></p>
            </div>
        </form>
        <router-link v-if="form.back" :to="'/'+form.source">返回列表</router-link>
        <button v-if="form.sab" @click="saveAndBack" :disabled="form.errors.any()">保存</button>
        <button v-if="form.sae" @click="saveAndEdit" :disabled="form.errors.any()">保存并继续编辑</button>
        <button v-if="form.saa" @click="saveAndAgain" :disabled="form.errors.any()">保存并继续新建</button>
        <button v-if="form.sav" @click="saveAndView" :disabled="form.errors.any()">保存并查看</button>
    </div>
</template>

<script>
    import Form from './../elements/Form';

    export default {
        name: "Form",
        data() {
            return {
                form: new Form(this.$route.params),
            }
        },
        methods: {
            saveAndEdit() {
                this.form.save();
            },
            saveAndBack() {
                this.form.save()
                    .then(() => {
                        console.log('ok');
                        this.$router.push('/' + this.form.source);
                    })
                    .catch(() => {
                    });
            },
            saveAndAgain() {
                this.form.save()
                    .then(() => {
                        this.$router.push('/' + form.source + '/create');
                    })
                    .catch(() => {
                    });
            },
            saveAndView() {
                this.form.save()
                    .then(() => {
                        this.$router.push('/' + form.source + '/' + form.id);
                    })
                    .catch(() => {
                    });
            }
        }
    }
</script>

<style scoped>

</style>