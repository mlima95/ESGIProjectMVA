import {isCurrentUserHaveRole, ROLE} from '../../utils/utils.js';

export function adminGuard(to, from, next) {

  if(isCurrentUserHaveRole(ROLE.admin)){
    next()
  }
}
