import { getField, updateField } from "vuex-map-fields";
import * as actions from "./actions";
import mutations from "./mutations";

export default {
  namespaced: true,
  state: {
    isLoading: false,
    error: "",
    user: null,
    violations: null,
  },
  actions,
  getters: {
    getField,
  },
  mutations: {
    updateField,
    ...mutations,
  },
};
