import * as types from "./mutation_types";

export default {
  [types.SEARCHTHEME_CREATE_SET_ERROR](state, error) {
    Object.assign(state, { error });
  },

  [types.SEARCHTHEME_CREATE_TOGGLE_LOADING](state) {
    Object.assign(state, { error: "", isLoading: !state.isLoading });
  },

  [types.SEARCHTHEME_CREATE_SET_CREATED](state, created) {
    Object.assign(state, { created });
  },

  [types.SEARCHTHEME_CREATE_SET_VIOLATIONS](state, violations) {
    Object.assign(state, { violations });
  },

  [types.SEARCHTHEME_CREATE_RESET](state) {
    Object.assign(state, {
      created: null,
      error: "",
      isLoading: false,
      violations: null,
    });
  },
};
