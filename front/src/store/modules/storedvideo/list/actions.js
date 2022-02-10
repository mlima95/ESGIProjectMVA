import fetch from "../../../../utils/fetch";
import * as types from "./mutation_types";

const getItems = ({ commit }, {page, status} = {page: "stored_videos", status : 0}) => {
  status = status || 0;
  page = page || "stored_videos"
  commit(types.TOGGLE_LOADING);

  fetch(page, {params: { status }})
    .then((response) => response.json())
    .then((data) => {
      commit(types.TOGGLE_LOADING);
      commit(types.SET_ITEMS, data["hydra:member"]);
      commit(types.SET_VIEW, data["hydra:view"]);
    })
    .catch((e) => {
      commit(types.TOGGLE_LOADING);
      commit(types.SET_ERROR, e.message);
    });
};

export const getSelectItems = (
  { commit },
  { page = "stored_videos", params = { properties: ["@id", "name"] } } = {}
) => {
  commit(types.TOGGLE_LOADING);

  fetch(page, { params })
    .then((response) => response.json())
    .then((data) => {
      commit(types.TOGGLE_LOADING);
      commit(types.SET_SELECT_ITEMS, data["hydra:member"]);
    })
    .catch((e) => {
      commit(types.TOGGLE_LOADING);
      commit(types.SET_ERROR, e.message);
    });
};

export default getItems;
