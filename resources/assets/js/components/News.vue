<template>
    <div>
        <el-table :data="news" stripe style="width: 100%">
            <el-table-column prop="name" label="Название" width="180"></el-table-column>
            <el-table-column prop="description" label="Описание" width="180"></el-table-column>
            <el-table-column prop="author" label="Автор" width="180"></el-table-column>
            <el-table-column prop="created_at" label="Создание" width="180"></el-table-column>
        </el-table>
        <div class="block">
            <el-pagination layout="prev, pager, next" :total="1000"></el-pagination>
        </div>
    </div>
</template>
<script>

    export default {

        data() {
            return {
                news: []
            }
        },
        methods: {
     
            getNews() {                
                let self = this
                axios.get('./news/get_all').then(function (response) {
                    let data = response.data;
                    for (var key of data) {
                        self.news.push({
                            name: key.name,
                            created_at: key.created_at,
                            author: key.author.name,
                            description: key.description
                        });
                    }
                    // self.news = response.data;
                    // console.log('news', response);
                }).catch(function (error) {
                    console.log(error);
                });
            }

        },

        created() {
            this.getNews();
        }

    }

</script>