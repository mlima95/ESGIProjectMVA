import {isCurrentUserHaveRole, ROLE} from '../../utils/utils.js';

export function submitterGuard(to, from, next) {

  if(isCurrentUserHaveRole(ROLE.submitter)){
    next()
  }
}
