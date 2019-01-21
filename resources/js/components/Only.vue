<template>
    <select @change="handleSelect($event.target.value)">
        <option value="all">全部</option>
        <option value="only-trashed">垃圾箱</option>
        <option value="no-trashed">正常</option>
    </select>
</template>

<script>
    export default {
        name: "Only",
        methods: {
            handleSelect(value){
                this.$emit('only', value);
            }
        }
    }
</script>

<style scoped>

</style>