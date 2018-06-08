import Vuex from 'vuex';

import news from './modules/news';
import authors from './modules/authors';

export const store = new Vuex.Store({
    state: {

    },

    modules: {
        news,
        authors
    }

});
