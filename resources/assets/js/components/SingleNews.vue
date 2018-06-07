<template>
    <div>
    </div>
</template>
<script>

// Название
// Дата
// Подробное описание
// Блок информации об Авторе: Имя, Рейтинг, Количество новостей данного автора

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