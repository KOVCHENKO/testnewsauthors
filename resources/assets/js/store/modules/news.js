const state = {
    news: [],
    countPage: 0
};

const mutations = {
    getNews: (state, payload) => {
        axios.post('./news/get_all', payload.query).then(function (response) {
            state.news = response.data.data;
            state.countPage = response.data.page_quantity;
        }).catch(function (error) {
            console.log(error);
        });
    },
};

const actions = {
    getNews: (context, payload) => {
        context.commit('getNews', { query: payload.query });
    },
};

export default {
    state: state,
    mutations: mutations,
    actions: actions
}