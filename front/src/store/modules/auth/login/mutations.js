import * as types from "./mutation_types";
import {setCurrentUser} from '../../../../utils/utils.js';

export default {
  [types.AUTH_LOGIN_SET_ERROR](state, error) {
    Object.assign(state, { error });
  },

  [types.AUTH_LOGIN_TOGGLE_LOADING](state) {
    Object.assign(state, { error: "", isLoading: !state.isLoading });
  },

  async [types.AUTH_LOGIN_SET_LOGGED] (state, user) {
    setCurrentUser(user)
    Object.assign(state, { user });
  },

  [types.AUTH_LOGIN_SET_VIOLATIONS](state, violations) {
    Object.assign(state, { violations });
  },

  [types.AUTH_LOGIN_RESET](state) {
    Object.assign(state, {
      user: null,
      error: "",
      isLoading: false,
      violations: null,
    });
  },
};
