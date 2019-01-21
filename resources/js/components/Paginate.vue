<template>
    <div>
        <b style="margin:5px;" v-if="type >= 2">共{{total}}条</b>
        <b style="margin:5px;" v-if="type >= 3">
            <select @change="perPageChange($event.target.value)">
                <option v-for="(opt, index) in per_page_select" :key="index" :value="opt" :selected="per_page === opt ? 'selected' : ''">{{opt}}条/页</option>
            </select>
        </b>
        <ul style="display: flex;">
            <li style="list-style-type: none; margin: 5px;" v-for="(page, index) in this.pagers"
                @click="handlePageChange(page)" v-html="pageEcho(page)"
                :key="index"></li>
        </ul>
        <b style="margin:5px;" v-if="type >= 4">
            前往<input type="text" @change="selectPage($event.target.value)">页
        </b>
    </div>
</template>

<script>
    export default {
        name: "Paginate",
        props: {
            total: {
                type: Number
            },
            per_page: {
                type: Number
            },
            type: {
                type: Number,
                default: 1
            },
            max_page: {
                type: Number,
                default: 7
            },
            per_page_select: {
                type: Array,
                default: () => {
                    return [15, 30, 50, 100, 500];
                }
            }
        },
        data() {
            return {
                current_page: 0,
                last_page: 0,
                pagers: [],
            }
        },
        watch: {
            current_page(page) {
                this.$emit('page', page);
            },
            total() {
                this.last_page = Math.ceil(this.total / this.per_page);
                this.generatePager();
            },
            per_page() {
                this.last_page = Math.ceil(this.total / this.per_page);
                this.generatePager();
            }
        },
        mounted() {
            if (this.total > 0) {
                // 为了静态数据调用
                this.last_page = Math.ceil(this.total / this.per_page);
            }
            this.current_page = 1;
        },
        methods: {
            isFirstPage() {
                return this.current_page === 1;
            },
            isLastPage() {
                return this.last_page === this.current_page;
            },
            perPageChange(value) {
                this.$emit('size', parseInt(value));
            },
            selectPage(value) {
                let page = parseInt(value);
                if (page < 1 || page > this.last_page) {
                    alert('非法页数');
                } else {
                    this.pageChangeEvent(page);
                }
            },
            pageEcho(page) {
                if (page === '-1') {
                    return this.isFirstPage() ? '<' : '<b><</b>';
                }
                if (page === '+1') {
                    return this.isLastPage() ? '>' : '<b>></b>';
                }
                if (typeof page === 'string') {
                    return '<b>...</b>';
                }
                return this.current_page === page ? page : '<b>' + page + '</b>';
            },
            handlePageChange(page) {
                if ((page !== '-1' || this.isFirstPage()) || (page !== '+1' || !this.isLastPage())) {
                    if (typeof page === 'string') {
                        this.pageChangeEvent(eval(this.current_page + page));
                    } else {
                        this.pageChangeEvent(page);
                    }
                }
            },
            pageChangeEvent(page) {
                if (page > 0 && page <= this.last_page && page !== this.current_page) {
                    this.current_page = page;
                }
            },
            generatePager() {
                if (this.type) {
                    this.generateNumberPager();
                } else {
                    this.generateSimplePager();
                }
            },
            generateSimplePager() {
                this.pagers = [];
                if (this.last_page > 0) {
                    this.pagers.push('-1', '+1');
                }
            },
            generateNumberPager() {
                this.pagers = [];
                if (this.last_page > 0) {
                    if (this.last_page <= this.max_page) {
                        for (let p = 1; p <= this.last_page; p++) {
                            this.pagers.push(p);
                        }
                    } else {
                        let mid_page = Math.round(this.max_page / 2);
                        let last_mid_page = this.last_page - mid_page + 1;
                        let mid_size = this.max_page - 2;
                        if (this.current_page <= mid_page) {
                            for (let p = 1; p <= this.max_page - 1; p++) {
                                this.pagers.push(p);
                            }
                            this.pagers.push('+' + String(mid_size), this.last_page);
                        } else if (this.current_page >= last_mid_page) {
                            this.pagers.push(1, '-' + String(mid_size));
                            for (let p = this.last_page - this.max_page + 2; p <= this.last_page; p++) {
                                this.pagers.push(p);
                            }
                        } else {
                            this.pagers.push(1, '-' + String(mid_size));
                            mid_size = Math.max(3, mid_size);
                            if (mid_size % 2 !== 0) {
                                let step = (mid_size - 1) / 2;
                                // 奇数,则两边+相同数量的值
                                for (let p = this.current_page - step; p <= this.current_page + step; p++) {
                                    this.pagers.push(p);
                                }
                                this.pagers.push('+' + String(mid_size), this.last_page);
                            } else {
                                // 为偶数
                                let step = mid_size / 2;
                                if (2 * this.current_page < this.last_page + 1) {
                                    for (let p = this.current_page - step + 1; p <= this.current_page + step; p++) {
                                        this.pagers.push(p);
                                    }
                                } else {
                                    for (let p = this.current_page - step; p <= this.current_page + step - 1; p++) {
                                        this.pagers.push(p);
                                    }
                                }
                                this.pagers.push('+' + String(mid_size), this.last_page);
                            }
                        }
                    }
                    this.pagers.unshift('-1');
                    this.pagers.push('+1');
                }
            }
        }
    }
</script>

<style scoped>

</style>