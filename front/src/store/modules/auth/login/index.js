import { getField, updateField } from "vuex-map-fields";
import * as actions from "./actions";
import mutations from "./mutations";
import {getCurrentUser} from '../../../../utils/utils.js';

export default {
  namespaced: true,
  state: {
    isLoading: false,
    error: "",
    user: getCurrentUser() || null,
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
