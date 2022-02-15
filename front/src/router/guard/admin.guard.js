import {isCurrentUserHaveRole, ROLE} from '../../utils/utils.js';

export function adminGuard(to, from, next) {

  if(isCurrentUserHaveRole(ROLE.admin)){
    next()
  }
}

export function validatorGuard(to, from, next) {

  if(isCurrentUserHaveRole(ROLE.validator)){
    next()
  }
}

export function validatorGuardOrAdmin(to, from, next) {

  if(isCurrentUserHaveRole(ROLE.validator) || isCurrentUserHaveRole(ROLE.admin)){
    next()
  }
}
