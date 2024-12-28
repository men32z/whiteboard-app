import { createStore } from 'vuex';
import whiteboards from './modules/whiteboards';

const store = createStore({
    modules: {
        whiteboards
    },
});

export default store;