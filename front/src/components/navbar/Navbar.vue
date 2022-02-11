<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">LazyTube</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li v-if="!allowedRoutes.rightSide" v-for="allowedRoutes in currentUserNavbar" :key="allowedRoutes.allowedRouteName" class="nav-item">
            <router-link :to="{name : allowedRoutes.allowedRouteName }" :class="'nav-link ' + allowedRoutes.className">
              {{ allowedRoutes.libelle }}
            </router-link>
          </li>
        </ul>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li v-if="allowedRoutes.rightSide" v-for="allowedRoutes in currentUserNavbar" :key="allowedRoutes.allowedRouteName" class="nav-item pull-right">
            <router-link :to="{name : allowedRoutes.allowedRouteName }" :class="'nav-link ' + allowedRoutes.className">
              {{ allowedRoutes.libelle }}
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import {getCurrentUser, isCurrentUserHaveRole, ROLE} from '../../utils/utils.js';

export default {
  name: "Navbar",
  data: () => {
    return {
      currentUserNavbar: []
    };
  },
  methods: {
    resolveNavbarLinksFromRole() {
      if (!!getCurrentUser()) {
        this.currentUserNavbar.push({
          allowedRouteName: "Logout",
          libelle: "Déconnexion",
          className: "btn btn-danger text-white",
          rightSide: true
        });
      }
      if (isCurrentUserHaveRole(ROLE.submitter)) {
        // className = "btn btn-outline-info";
        // this.currentUserNavbar.push({
        //   allowedRouteName : "",
        //   libelle : "",
        //   className
        // });
      } else if (isCurrentUserHaveRole(ROLE.validator)) {
        // className = "btn btn-outline-success";
        // this.currentUserNavbar.push({
        //   allowedRouteName : "",
        //   libelle : "",
        //   className
        // });
      } else if (isCurrentUserHaveRole(ROLE.admin)) {
        const className = 'btn btn-outline-warning'
        this.currentUserNavbar.push(
          {
            allowedRouteName: "UserList",
            libelle: "Gestion des Utilisateurs",
            className
          },
          {
            allowedRouteName: "StoredVideoList",
            libelle: "Etat des vidéos",
            className
          },
          {
            allowedRouteName: "",
            libelle: "Validation de Planning",
            className
          }
        );
      }
    }
  },
  mounted() {
    this.resolveNavbarLinksFromRole();
  }
};
</script>
