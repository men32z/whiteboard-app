import axios from '../../axios';

export default {
    namespaced: true,
    state: {
        whiteboards: [],
        whiteboard: null,
    },
    mutations: {
        SET_WHITEBOARDS(state, whiteboards) {
            state.whiteboards = whiteboards;
        },
        SET_WHITEBOARD(state, whiteboard) {
            state.whiteboard = whiteboard;
        },
        ADD_WHITEBOARD(state, whiteboard) {
            state.whiteboards.push(whiteboard);
        },
        UPDATE_WHITEBOARD(state, updatedWhiteboard) {
            const index = state.whiteboards.findIndex(w => w.id === updatedWhiteboard.id);
            if (index !== -1) {
                state.whiteboards.splice(index, 1, updatedWhiteboard);
            }
        },
        DELETE_WHITEBOARD(state, id) {
            state.whiteboards = state.whiteboards.filter(w => w.id !== id);
        },
    },
    actions: {
        async fetchWhiteboards({ commit }) {
            const { data } = await axios.get('/whiteboards');
            commit('SET_WHITEBOARDS', data);
        },
        async fetchWhiteboard({ commit }, id) {
            const { data } = await axios.get(`/whiteboards/${id}`);
            commit('SET_WHITEBOARD', data);
        },
        async createWhiteboard({ commit }, payload) {
            const { data } = await axios.post('/whiteboards', payload);
            commit('ADD_WHITEBOARD', data);
        },
        async updateWhiteboard({ commit }, { id, payload }) {
            const { data } = await axios.put(`/whiteboards/${id}`, payload);
            commit('UPDATE_WHITEBOARD', data);
        },
        async deleteWhiteboard({ commit }, id) {
            await axios.delete(`/whiteboards/${id}`);
            commit('DELETE_WHITEBOARD', id);
        },
        async addParticipant({ dispatch }, { whiteboardId, email }) {
            await axios.post(`/whiteboards/${whiteboardId}/participants`, { email });
            await dispatch('fetchWhiteboard', whiteboardId);
        },

        async removeParticipant({ dispatch }, { whiteboardId, userId }) {
            await axios.delete(`/whiteboards/${whiteboardId}/participants`, {
                data: { userId },
            });
            await dispatch('fetchWhiteboard', whiteboardId);
        },
    },
    getters: {
        getWhiteboard: state => state.whiteboard,
        whiteboardsList: (state) => state.whiteboards,
    },
};