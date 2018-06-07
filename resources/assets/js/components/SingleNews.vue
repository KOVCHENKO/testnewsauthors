<template>
    <div>
        <div class="row">
            <div class="col-sm">
                Название
            </div>
            <div class="col-sm">
                {{news.name}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                Дата
            </div>
            <div class="col-sm">
                {{news.created_at}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                Подробное описание
            </div>
            <div class="col-sm">
                {{news.description}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                Автор
            </div>
            <div class="col-sm">
                {{authorDescription}}
            </div>
        </div>
    </div>
</template>
<script>

    export default {

        data() {
            return {
                news : {
                    name : '',
                    created_at : '',
                    description : '',
                    author : {
                        name : '',
                        rating : '', 
                        count : ''
                    }
                }
            }
        },

        methods: {
            getNewsById(id){
                let self = this;
                axios.get('./news/get_by_id/' + id).then(function (response) {
                    self.news = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },

        created() {
            let id = this.$route.params.id;
            this.getNewsById(id);
        },

        computed: {
              
            authorDescription: function() {
                return this.news.author.name + '. Рейтинг : ' + this.news.author.rating + 
                    '. Количество новостей : ' + this.news.author.count;
            }

        }
    }

</script>