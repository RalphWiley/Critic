import axios from 'axios'

export default {
  namespaced: true,

  state: {
      //want to keep token and user in store
    token: null,
    user: null
  },
  // allow us to read information from our state
  getters: {
    authenticated (state) {
        return state.token && state.user
    },

    user (state) {
        return state.user
    }
  },

  mutations: {
    SET_TOKEN (state, token) {
        state.token = token
    },
    SET_USER (state, data) {
        state.user = data
    }
  },

  actions: {
      //credentials because we dont have access to the form
    async signIn ({dispatch}, credentials) {
        let response = await axios.post("auth/signin", credentials);

        return dispatch('attempt', response.data.token)
    },
    // we hit signIn then we try to attempt authorization
    async attempt ({commit}, token){
        commit('SET_TOKEN', token)

        try {
          //works because setting the bearer token in subscriber
            let response = await axios.get('auth/me')

            commit('SET_USER', response.data)
        } catch(e){
            commit("SET_TOKEN", null)
            commit("SET_USER", null);
        }
    }
  }
}
