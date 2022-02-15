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
  }
];
