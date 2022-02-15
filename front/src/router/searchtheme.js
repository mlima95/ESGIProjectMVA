import {submitterGuard} from './guard/submitter.guard.js';
import {validatorGuard} from './guard/validator.guard';

export default [
  {
    name: "SearchThemeList",
    path: "/search_themes/",
    beforeEnter: validatorGuard,
    component: () =>
      import(
        /* webpackChunkName: "searchtheme" */ "../components/resources/searchtheme/List"
      ),
  },
  {
    name: "SearchThemeCreate",
    path: "/search_themes/create",
    beforeEnter: submitterGuard,
    component: () =>
      import(
        /* webpackChunkName: "searchtheme" */ "../components/resources/searchtheme/Create"
      ),
  },
];
