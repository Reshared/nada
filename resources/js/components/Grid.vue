<template>
    <div>
        <h1>Header: {{grid.header}}</h1>
        <h2>Description: {{grid.description}}</h2>
        <Search :keys="grid.searches" v-on:search="handleSearch"></Search>
        <Only v-on:only="handleOnly" v-if="grid.soft_delete"></Only>
        <router-link v-if="grid.edit" :to="'/'+grid.source+'/create'">创建</router-link>
        <router-link v-if="grid.edit" :to="'/'+grid.source+'/create'">创建</router-link>
        <button v-if="grid.export_able">导出</button>
        <button v-if="grid.delete" @click="handleBatchDestroy">批量删除</button>
        <button @click="grid.data.get()">刷新</button>
        <table border="1">
            <thead>
            <tr>
                <th v-if="grid.mult_select">
                    <input type="checkbox" value="1" @click="handleMultSelect($event.target.checked)">
                </th>
                <th v-for="(field, index) in grid.fields" :key="index">
                    {{field.title}}
                    <span v-if="!field.sort"></span>
                    <span @click="grid.data.order(field.key).get()"
                          v-else-if="grid.data.params.sort === field.key && grid.data.params.sort_type === 'asc'">
                            ↑
                        </span>
                    <span @click="grid.data.order(field.key).get()"
                          v-else-if="grid.data.params.sort === field.key && grid.data.params.sort_type === 'desc'">
                            ↓
                        </span>
                    <span @click="grid.data.order(field.key).get()" v-else>
                            -
                        </span>
                </th>
                <th v-if="grid.anyActions()">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(cols, index) in grid.data.list" :key="index">
                <td v-if="grid.mult_select">
                    <input type="checkbox">
                </td>
                <td v-for="(rows, index) in grid.fields" :key="index"
                    v-html="grid.valueEcho(rows.key, cols[rows.key])"></td>
                <td v-if="grid.anyActions()">
                    <button v-if="grid.view">查看</button>
                    <button v-if="grid.edit" @click="handleEdit(cols.id)">编辑</button>
                    <button v-if="grid.delete" @click="handleDestroy(index)">删除</button>
                </td>
            </tr>
            </tbody>
        </table>
        <paginate :type="4" :per_page="grid.data.paginator.per_page" :total="grid.data.paginator.total"
                  v-on:page="handlePage" v-on:size="handleSize"></paginate>
    </div>
</template>

<script>
    import Grid from './../elements/Grid';
    import Paginate from './Paginate';
    import Search from './Search'
    import Only from './Only';

    export default {
        name: "Grid",
        components: {
            Paginate, Search, Only
        },
        data() {
            return {
                grid: new Grid(this.$route.params)
            }
        },
        methods: {
            handleBatchDestroy() {
                let ids = [];
                document.querySelectorAll('tbody tr').forEach((item) => {
                    if (item.firstChild.firstChild.checked) {
                        ids.push(item.childNodes[2].innerText);
                    }
                });
                if (ids.length === 0) {
                    alert('没有选中的条目');
                } else if (confirm('确认删除选中的' + ids.length + '个条目么?')) {
                    this.grid.destroy(ids)
                        .then(() => {

                        })
                        .catch(() => {});
                }
            },
            handleEdit(id) {
                this.$router.push('/' + this.grid.source + '/' + id + '/edit');
            },
            handleDestroy(index) {
                if (confirm('确认删除?')) {
                    this.grid.destroy(document.querySelectorAll('tbody tr')[index].childNodes[2].innerText);
                }
            },
            handleMultSelect(checked) {
                let items = document.querySelectorAll('tbody input[type=checkbox]');
                for (let i = 0; i < items.length; i++) {
                    items[i].checked = checked;
                }
            },
            handlePage(page) {
                this.grid.data.page(page).get();
            },
            handleSize(size) {
                this.grid.data.size(size).get();
            },
            handleSearch(search) {
                this.grid.data.search(search).get();
            },
            handleOnly(type) {
                this.grid.data.only(type).get();
            }
        }
    }
</script>

<style scoped>

</style>