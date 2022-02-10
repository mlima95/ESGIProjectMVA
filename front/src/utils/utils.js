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
  // Redirect the the default home page for the role
  if(getCurrentUserRole(ROLE.admin)) {
    router.push('/users')
  } else /*if(getCurrentUserRole(ROLE.AUTRE_ROLE))*/ {
    // this.$router.push('/autre-url')

  } /*repeat pour les autres rôles */
}
