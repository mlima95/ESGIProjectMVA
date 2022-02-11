import {getCurrentUserRole, ROLE} from '../../utils/utils.js';

export function adminGuard(to, from, next) {

  if(getCurrentUserRole(ROLE.admin)){
    next()
  }
}
