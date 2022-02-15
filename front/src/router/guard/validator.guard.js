import {isCurrentUserHaveRole, ROLE} from '../../utils/utils.js';

export function validatorGuard(to, from, next) {

  if(isCurrentUserHaveRole(ROLE.validator)) {
    next()
  }
}
