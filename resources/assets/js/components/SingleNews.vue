<template>
    <div>
        <div>
            <h3>{{news.name}}</h3>
        </div>
        <div>
            <div class="row">
                <div class="col-sm-2">Название</div>
                <div class="col-sm-4">{{news.name}}</div>
            </div>
            <div class="row">
                <div class="col-sm-2">Дата</div>
                <div class="col-sm-4">{{news.created_at}}</div>
            </div>
            <div class="row">
                <div class="col-sm-2">Подробное описание</div>
                <div class="col-sm-4">{{news.description}}</div>
            </div>
            <div class="row">
                <div class="col-sm-2">Автор</div>
                <div class="col-sm-4">{{authorDescription}}</div>
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