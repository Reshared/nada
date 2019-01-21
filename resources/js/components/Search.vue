<template>
    <div>
        <select @change="handleSelect($event.target.value)">
            <option value="all">全部</option>
            <option v-for="(desc, key) in keys" :key="key" :value="key" v-text="desc"></option>
        </select>
        <input v-model="value" type="text" @keydown.enter.prevent="handleSearch">
        <button @click="handleSearch">搜索</button>
        <button @click="clearSearch">清空</button>
    </div>
</template>

<script>
    export default {
        name: "Search",
        props: {
            keys: Object
        },
        data() {
            return {
                key: 'all',
                value: '',
            }
        },
        methods: {
            handleSearch() {
                this.$emit('search', {
                    key: this.key,
                    value: this.value
                });
            },
            handleSelect(key) {
                this.key = key;
            },
            clearSearch() {
                this.value = '';
                this.handleSearch();
            }
        }
    }
</script>

<style scoped>

</style>