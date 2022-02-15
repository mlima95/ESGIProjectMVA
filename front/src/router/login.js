import { redirectOnHomepageByRole } from '../utils/utils';

export default [
  {
    path: '/login',
    name: 'login',
    component: () => import('../components/login/Login.vue')
  }
];
