import {adminGuard} from './guard/admin.guard.js';

export default [
  {
    name: "UserList",
    path: "/users/",
    beforeEnter : adminGuard,
    component: () =>
      import(/* webpackChunkName: "user" */ "../components/resources/user/List")
  }
];
