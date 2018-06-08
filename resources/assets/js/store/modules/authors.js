const state = {
    authors: [],
};

const mutations = {
    getAuthors: (state, payload) => {
        let self = this
        axios.get('./authors/get_all').then(function (response) {
            state.authors = response.data;
        }).catch(function (error) {
            console.log(error);
        });
    },
};

const actions = {
    getAuthors: (context, payload) => {
        context.commit('getAuthors');
    },
};

export default {
    state: state,
    mutations: mutations,
    actions: actions
}