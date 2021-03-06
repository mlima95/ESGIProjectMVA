import SubmissionError from "../../../../error/SubmissionError";
import fetch from "../../../../utils/fetch";
import {getCurrentUser} from "../../../../utils/utils";
import * as types from "./mutation_types";

export const create = ({ commit }, values) => {
  commit(types.SEARCHTHEME_CREATE_SET_ERROR, "");
  commit(types.SEARCHTHEME_CREATE_TOGGLE_LOADING);
  values.userId = getCurrentUser().uuid;

  return fetch("search_themes", { method: "POST", body: JSON.stringify(values) })
    .then((response) => {
      commit(types.SEARCHTHEME_CREATE_TOGGLE_LOADING);

      return response.json();
    })
    .then((data) => {
      commit(types.SEARCHTHEME_CREATE_SET_CREATED, data);
    })
    .catch((e) => {
      commit(types.SEARCHTHEME_CREATE_TOGGLE_LOADING);

      if (e instanceof SubmissionError) {
        commit(types.SEARCHTHEME_CREATE_SET_VIOLATIONS, e.errors);
        // eslint-disable-next-line
        commit(types.SEARCHTHEME_CREATE_SET_ERROR, e.errors._error);

        return;
      }

      commit(types.SEARCHTHEME_CREATE_SET_ERROR, e.message);
    });
};

export const reset = ({ commit }) => {
  commit(types.SEARCHTHEME_CREATE_RESET);
};
