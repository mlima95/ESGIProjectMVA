import * as types from "./mutation_types";
import {ENTRY_POINT_AUTH} from '../../../../config/entrypoint.js';
import SubmissionError from '../../../../error/SubmissionError.js';

export const login = async ({commit}, credentials) => {
  commit(types.AUTH_LOGIN_SET_ERROR, "");
  commit(types.AUTH_LOGIN_TOGGLE_LOADING);
  try {
    const response = await fetch(ENTRY_POINT_AUTH, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',

      },
      body: JSON.stringify(credentials)
    });
    const json = await response.json()
    commit(types.AUTH_LOGIN_TOGGLE_LOADING);
    commit(types.AUTH_LOGIN_SET_LOGGED, json);
  } catch (e) {
    commit(types.AUTH_LOGIN_TOGGLE_LOADING);
    if (e instanceof SubmissionError) {
      commit(types.AUTH_LOGIN_SET_VIOLATIONS, e.errors);
      commit(types.AUTH_LOGIN_SET_ERROR, e.errors._error);
      return;
    }
    commit(types.AUTH_LOGIN_SET_ERROR, e.message);
  }
};

export const logout = ({commit}) => {
  commit(types.AUTH_LOGIN_RESET);
};
