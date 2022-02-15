import * as types from "./mutation_types";

export default {
  [types.PLANIFICATOR_SHOW_RESET](state) {
    Object.assign(state, {
      error: "",
      isLoading: false,
      retrieved: null,
    });
  },

  [types.PLANIFICATOR_SHOW_SET_ERROR](state, error) {
    Object.assign(state, { error });
  },

  [types.PLANIFICATOR_SHOW_SET_RETRIEVED](state, retrieved) {
    Object.assign(state, { retrieved });
  },

  [types.PLANIFICATOR_SHOW_TOGGLE_LOADING](state) {
    Object.assign(state, { error: "", isLoading: !state.isLoading });
  },
};
