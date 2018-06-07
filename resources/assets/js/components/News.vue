<template>
    <div>
        <el-button @click="dialogVisible = true">Фильтры</el-button>
        <el-table :data="news" stripe style="width: 100%">
            <el-table-column prop="name" label="Название" width="180"></el-table-column>
            <el-table-column prop="description" label="Описание" width="180"></el-table-column>
            <el-table-column prop="author.name" label="Автор" width="180"></el-table-column>
            <el-table-column prop="created_at" label="Создание" width="180"></el-table-column>
        </el-table>
        
        <el-pagination @current-change="handleCurrentChange"
            layout="prev, pager, next" :total="1000" :current-page.sync="page"></el-pagination>

        <el-dialog title="Фильтры" :visible.sync="dialogVisible" width="30%" :before-close="handleClose">
            <span slot="footer" class="dialog-footer">

                <p>Дата создания новости</p>
                <el-date-picker v-model="params.dateStart" type="date" placeholder="От"></el-date-picker>
                <el-date-picker v-model="params.dateEnd" type="date" placeholder="До"></el-date-picker>

                <p>Автор</p>
                <el-select v-model="params.idAuthor" placeholder="Select">
                    <el-option
                        v-for="item in authors"
                        :key="item.id"
                        :label="item.value"
                        :value="item.id">
                    </el-option>
                </el-select>
                <br>
                <el-button @click="cancelFilters">Отменить</el-button>
                <el-button type="primary" @click="applyFilters">Применить</el-button>
            </span>
        </el-dialog>
    </div>
</template>
<script>

    export default {

        data() {
            return {
                news: [],
                dialogVisible: false,
                authors: [],
                params: {
                    idAuthor: '',
                    dateStart: '',
                    dateEnd: ''
                },
                page: 1,
                query: {}             
            }
        },

        methods: {
     
            getNews() {                
                let self = this
                axios.get('./news/get_all').then(function (response) {
                    self.news = response.data
                }).catch(function (error) {
                    console.log(error)
                });
            },

            handleClose(done) {
                done();
            },

            loadAuthors() {
                return [
                    { id: 1, value: "vue" },
                    { id: 2, value: "element" },
                    { id: 3, value: "cooking" },
                    { id: 4, value: "mint-ui" },
                    { id: 5, value: "vuex" },
                    { id: 6, value: "vue-router" },
                    { id: 7, value: "babel" }
                ];
            },

            applyFilters() {
                let query = {}
                this.formatQuery()
                this.updateRouter()
                this.dialogVisible = false
            },

            cancelFilters() {
                this.clearParams()
                this.updateRouter()
                this.dialogVisible = false
            },

            formatQuery() {
                this.query = {}
                for (let param in this.params) {
                    if (this.params[param] !== '' && this.params[param] !== null && this.params[param].getTime) {
                        this.query[this.snakeCaseStr(param)] = moment(this.params[param]).format('x')
                    }
                    else if (this.params[param] !== '' && this.params[param] !== null) {
                        this.query[this.snakeCaseStr(param)] = this.params[param]
                    }
                }
                this.query.page = this.page;
            },

            clearParams() {
                for (let param in this.params) {
                    this.params[param] = ''
                    delete this.query[this.snakeCaseStr(param)]
                }
            },

            getParams() {
                this.query = this.$route.query
                for (let key in this.query) {
                    if (key === 'page') {
                        this.page = Number(this.query[key])
                    }
                    else if (this.isTimestamp(this.query[key])) {
                        this.params[this.camelCaseStr(key)] = this.getDateByTimestamp(this.query[key])
                    }
                    else {
                        this.params[this.camelCaseStr(key)] = this.query[key]
                    }
                }
            },

            snakeCaseStr(str) {
                return str.replace(/([A-Z])/g, '_$1').toLowerCase()
            },

            camelCaseStr(str) {
                return str.replace(/_([a-z])/g, function (m, w) {
                    return w.toUpperCase()
                });
            },

            isTimestamp(str) {
                return (str.search(/^[0-9]{13}$/) === 0) ? true : false
            },

            getDateByTimestamp(timestamp) {
                let date = new Date()
                date.setTime(timestamp)
                return date
            },
            
            handleCurrentChange(val) {
                this.page = Number(val)
                this.query.page = this.page
                this.updateRouter()
            },

            updateRouter() {
                this.$router.replace('/news')
                this.$router.push({ query: this.query})
            }

        },

        created() {
            this.getParams();
            this.getNews()
            this.authors = this.loadAuthors()
        },

        watch: {
            '$route' (to, from) {
                let params = this.$route.query
                this.getNews()
            }
        }

    }

</script>