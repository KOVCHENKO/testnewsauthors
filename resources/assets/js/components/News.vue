<template>
    <div class="container-news">
        <div class="caption">
            <h3>Новости</h3>
        </div>
        <div>
            <el-button @click="dialogVisible = true">Фильтры</el-button>
            <el-table :data="news" stripe style="width: 100%">
                <el-table-column prop="name" label="Название" width="180"></el-table-column>
                <el-table-column prop="description" label="Описание" width="180"></el-table-column>
                <el-table-column prop="author.name" label="Автор" width="180"></el-table-column>
                <el-table-column prop="created_at" label="Создание" width="180"></el-table-column>
                <el-table-column label="Операция" width="180">
                    <template slot-scope="scope">
                        <el-button @click="handleMoreInfo($route.path + '/' + news[scope.$index].id)">Подробнее</el-button>
                    </template>
                </el-table-column>
            </el-table>
            
            <el-pagination @current-change="handleCurrentChange"
                layout="prev, pager, next" :page-count="countPage" :current-page.sync="page"></el-pagination>

            <el-dialog title="Фильтры" :visible.sync="dialogVisible" width="30%" :before-close="handleClose">
                <p>Дата создания новости</p>
                <el-date-picker v-model="params.dateStart" type="date" placeholder="От"></el-date-picker>
                <el-date-picker v-model="params.dateEnd" type="date" placeholder="До"></el-date-picker>
                <hr>
                <p>Автор</p>
                <el-select v-model="params.authorId" placeholder="Select">
                    <el-option
                        v-for="item in authors"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id">
                    </el-option>
                </el-select>
                <br>
                <span slot="footer" class="dialog-footer">
                    <el-button type="primary" @click="applyFilters">Применить</el-button>    
                    <el-button @click="cancelFilters">Отменить</el-button>                    
                </span>
            </el-dialog>
        </div>
    </div>
</template>
<script>
    import DataFormatter from '../services/utils/DataFormatter';
    import TimeManipulationService from '../services/TimeManipulationService';
    import ParamsFormatter from '../services/utils/ParamsFormatter';

    export default {

        data() {
            return {
                news: [],
                dialogVisible: false,
                authors: [],
                params: {
                    authorId: '',
                    dateStart: '',
                    dateEnd: ''
                },
                page: 1,
                countPage: 0,
                query: {
                    author_id: 0,
                    date_start: '',
                    date_end: '',
                    page: 1
                }
            }
        },

        methods: {
     
            getNews() {
                let self = this;
                axios.post('./news/get_all', this.query).then(function (response) {
                    self.news = response.data.data;
                    self.countPage = response.data.page_quantity;
                }).catch(function (error) {
                    console.log(error);
                });
            },

            handleClose(done) {
                done();
            },

            loadAuthors() {
                let self = this
                axios.get('./authors/get_all').then(function (response) {
                    self.authors = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },

            applyFilters() {
                let query = {};
                this.query = ParamsFormatter.formatQuery(this.query, this.params, this.page);

                this.updateRouter();
                this.dialogVisible = false;
            },

            cancelFilters() {
                let cancelFiltering = ParamsFormatter.clearParams(this.params, this.query);
                this.query = cancelFiltering.query;
                this.params = cancelFiltering.params;
                this.updateRouter();
                this.dialogVisible = false;
            },

            handleMoreInfo(path) {
                this.$router.push(path)
            },

            getParams() {
                this.query = this.$route.query;
                for (let key in this.query) {
                    if (key === 'page') {
                        this.page = Number(this.query[key]);
                    }
                    else if (TimeManipulationService.isTimestamp(this.query[key])) {
                        this.params[DataFormatter.camelCaseStr(key)] = TimeManipulationService.getDateByTimestamp(this.query[key]);
                    }
                    else {
                        this.params[DataFormatter.camelCaseStr(key)] = Number(this.query[key]);
                    }
                }
            },


            handleCurrentChange(val) {
                this.page = Number(val);
                this.query.page = this.page;
                this.updateRouter();
            },

            updateRouter() {
                this.$router.replace(this.$route.path);
                this.$router.push({ query: this.query});
            }

        },

        created() {
            this.getParams();
            this.getNews();
            this.loadAuthors();
        },

        watch: {
            '$route' (to, from) {
                let params = this.$route.query;
                this.getNews();
            }
        }

    }

</script>