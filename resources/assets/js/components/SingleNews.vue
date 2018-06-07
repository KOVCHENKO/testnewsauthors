<template>
    <div>
        <el-table :data="news" stripe style="width: 100%">
            <el-table-column prop="name" label="Название" width="180"></el-table-column>
            <el-table-column prop="created_at" label="Дата" width="180"></el-table-column>
            <el-table-column prop="description" label="Описание" width="180"></el-table-column>
            <el-table-column prop="author.name" label="Автор" width="180"></el-table-column>
        </el-table>
    </div>
</template>
<script>

    export default {

        data() {
            return {
                news : {}
            }
        },

        methods: {
            getNewsById(){

            }
        },

        created() {
            let id = this.$route.params.id;
            this.getNewsById(id);
        },
    }

</script>