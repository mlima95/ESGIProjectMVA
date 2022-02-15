export default [
  {
    name: "SearchThemeList",
    path: "/search_themes/",
    component: () =>
      import(
        /* webpackChunkName: "searchtheme" */ "../components/resources/searchtheme/List"
      ),
  },
  {
    name: "SearchThemeCreate",
    path: "/search_themes/create",
    component: () =>
      import(
        /* webpackChunkName: "searchtheme" */ "../components/resources/searchtheme/Create"
      ),
  },
  {
    name: "SearchThemeUpdate",
    path: "/search_themes/edit/:id",
    component: () =>
      import(
        /* webpackChunkName: "searchtheme" */ "../components/resources/searchtheme/Update"
      ),
  },
  {
    name: "SearchThemeShow",
    path: "/search_themes/show/:id",
    component: () =>
      import(
        /* webpackChunkName: "searchtheme" */ "../components/resources/searchtheme/Show"
      ),
  },
];
