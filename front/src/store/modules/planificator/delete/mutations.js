import * as types from "./mutation_types";

export default {
  [types.PLANIFICATOR_DELETE_SET_DELETED](state, deleted) {
    Object.assign(state, { deleted });
  },

  [types.PLANIFICATOR_DELETE_SET_ERROR](state, error) {
    Object.assign(state, { error });
  },

  [types.PLANIFICATOR_DELETE_TOGGLE_LOADING](state) {
    Object.assign(state, { error: "", isLoading: !state.isLoading });
  },

  [types.PLANIFICATOR_DELETE_RESET](state) {
    Object.assign(state, {
      deleted: null,
      error: "",
      isLoading: false,
    });
  },
};
