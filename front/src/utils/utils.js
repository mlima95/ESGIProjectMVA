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

export function isCurrentUserHaveRole(role) {
  const user = getCurrentUser();
  if (!user) {
    return false;
  }
  return user.roles.includes(role);
}

export function generateRandomStr(length){
  const chars =
    "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz1234567890";
  const randomArray = Array.from(
    { length },
    (v, k) => chars[Math.floor(Math.random() * chars.length)]
  );

  return randomArray.join("");
}

export function redirectOnHomepageByRole(router){
  if(isCurrentUserHaveRole(ROLE.admin)) {
    router.push('/users')
  }else if(isCurrentUserHaveRole(ROLE.validator)) {
    router.push('/search_themes/')
  } else if(isCurrentUserHaveRole(ROLE.submitter)) {
    router.push('/search_themes/create/')
  }else{
    router.push('/login')
  }
}
