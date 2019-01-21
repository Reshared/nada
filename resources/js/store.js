import Vue from 'vue';
import Vuex from 'vuex';
import User from './modules/User';
import Roles from './modules/Roles';
import Permissions from './modules/Permissions';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        roles: null,
        permissions: null
    },
    mutations: {
        loadUser(state, user) {
            state.user = User.store(user);
        },

        loadRolesPermissions(state, rolesAndPermissions) {
            state.roles = Roles;
            state.permissions = Permissions;
            rolesAndPermissions.map((role) => {
                state.roles.store(role.name);
                role.permissions.map((permission) => {
                    state.permissions.store(permission);
                });
            });
        }
    },
    actions: {
        fetchUser({commit}) {
            return http.get('/user')
                    .then((data) => {
                        commit('loadUser', data);
                    })
                    .catch((response) => {
                        throw response;
                    });
        },

        fetchRolesPermissions({commit}) {
            return http.get('/roles')
                    .then((data) => {
                        commit('loadRolesPermissions', data);
                    })
                    .catch((response) => {
                        console.log(response);
                    });
        }
    },
    getters: {
        user: state => {
            return state.user;
        },

        roles: state => {
            return state.roles;
        },

        permissions: state => {
            return state.permissions;
        },
    }
});