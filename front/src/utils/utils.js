export function getCurrentUser() {
  return JSON.parse(localStorage.getItem('userData'));
}

export function setCurrentUser(userToken) {
  localStorage.setItem("userData", JSON.stringify(userToken));
}

export function removeCurrentUser() {
  localStorage.removeItem("userData");
}

export const ROLE = {
  admin: 'ROLE_ADMIN',
  validator: 'ROLE_VALIDATOR',
  submitter: 'ROLE_SUBMITTER'
};

export function getCurrentUserRole(role) {
  const user = getCurrentUser();
  if (!user) {
    return false;
  }
  return user.roles.includes(role);
}
