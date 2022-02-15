import {validatorGuardOrAdmin} from "./guard/admin.guard";

export default [
  {
    name: "PlanificatorList",
    path: "/planificators/",
    beforeEnter: validatorGuardOrAdmin,
    component: () =>
      import(
        /* webpackChunkName: "planificator" */ "../components/resources/planificator/List"
      ),
  },
  {
    name: "PlanificatorCreate",
    path: "/planificators/create",
    beforeEnter: validatorGuardOrAdmin,
    component: () =>
      import(
        /* webpackChunkName: "planificator" */ "../components/resources/planificator/Create"
      ),
  },
  // {
  //   name: "PlanificatorUpdate",
  //   path: "/planificators/edit/:id",
  //   component: () =>
  //     import(
  //       /* webpackChunkName: "planificator" */ "../components/resources/planificator/Update"
  //     ),
  // },
  // {
  //   name: "PlanificatorShow",
  //   path: "/planificators/show/:id",
  //   component: () =>
  //     import(
  //       /* webpackChunkName: "planificator" */ "../components/resources/planificator/Show"
  //     ),
  // },
];
