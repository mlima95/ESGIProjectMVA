import SubmissionError from "../../../../error/SubmissionError";
import {default as fetchApp} from "../../../../utils/fetch";
import * as types from "./mutation_types";
import {getCurrentUser} from "../../../../utils/utils";
import {ENTRY_POINT_VALID_PLANIFICATORS} from "../../../../config/entrypoint";

export const create = ({ commit }, values) => {
  commit(types.PLANIFICATOR_CREATE_SET_ERROR, "");
  commit(types.PLANIFICATOR_CREATE_TOGGLE_LOADING);
  values.userId = getCurrentUser().uuid
  return fetchApp("planificators", { method: "POST", body: JSON.stringify(values) })
    .then((response) => {
      commit(types.PLANIFICATOR_CREATE_TOGGLE_LOADING);

      return response.json();
    })
    .then((data) => {
      commit(types.PLANIFICATOR_CREATE_SET_CREATED, data);
    })
    .catch((e) => {
      commit(types.PLANIFICATOR_CREATE_TOGGLE_LOADING);

      if (e instanceof SubmissionError) {
        commit(types.PLANIFICATOR_CREATE_SET_VIOLATIONS, e.errors);
        // eslint-disable-next-line
        commit(types.PLANIFICATOR_CREATE_SET_ERROR, e.errors._error);

        return;
      }

      commit(types.PLANIFICATOR_CREATE_SET_ERROR, e.message);
    });
};

export const validHandler = ({commit}, values) => {
  commit(types.PLANIFICATOR_CREATE_SET_ERROR, "");
  commit(types.PLANIFICATOR_CREATE_TOGGLE_LOADING);
  values.statusId = "2";
  return fetch(ENTRY_POINT_VALID_PLANIFICATORS, { method: "POST", body: JSON.stringify(values) })
    .then((response) => {
      commit(types.PLANIFICATOR_CREATE_TOGGLE_LOADING);

      return response.json();
    })
    .then((data) => {
      commit(types.PLANIFICATOR_CREATE_SET_CREATED, data);
    })
    .catch((e) => {
      commit(types.PLANIFICATOR_CREATE_TOGGLE_LOADING);

      if (e instanceof SubmissionError) {
        commit(types.PLANIFICATOR_CREATE_SET_VIOLATIONS, e.errors);
        // eslint-disable-next-line
        commit(types.PLANIFICATOR_CREATE_SET_ERROR, e.errors._error);

        return;
      }

      commit(types.PLANIFICATOR_CREATE_SET_ERROR, e.message);
    });
}

export const reset = ({ commit }) => {
  commit(types.PLANIFICATOR_CREATE_RESET);
};
