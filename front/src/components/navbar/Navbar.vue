<template>
  <nav
    class="navbar shadow  rounded justify-content-between flex-nowrap flex-row fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">LazyTube</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li v-if="!allowedRoutes.rightSide" v-for="allowedRoutes in currentUserNavbar"
              :key="allowedRoutes.allowedRouteName" class="nav-item">
            <router-link :to="{name : allowedRoutes.allowedRouteName }" :class="'nav-link ' + allowedRoutes.className">
              {{ allowedRoutes.libelle }}
            </router-link>
          </li>
        </ul>
        <ul v-if="showDeconnexionBtn" class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item pull-right">
            <button @click="signOut()" class="nav-link btn btn-danger text-white">
              Déconnexion
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import {getCurrentUser, isCurrentUserHaveRole, ROLE} from '../../utils/utils.js';
import {mapActions, mapState} from 'vuex';
import {mapFields} from 'vuex-map-fields';

export default {
  name: "Navbar",
  data: () => {
    return {
      currentUserNavbar: [],
      showDeconnexionBtn: false
    };
  },
  computed: {
    ...mapState('auth/login', [
      'user'
    ]),
  },
  watch: {
    user: {
      deep: true,
      handler(){
        this.resolveNavbarLinksFromRole()
      }
    }
  },
  methods: {
    ...mapActions('auth/login', [
      'logout',
    ]),
    signOut() {
      this.logout().then(() => this.$router.push({name: "login"}));
    },
    resolveNavbarLinksFromRole() {
      console.log(this.user)
      if (this.user && this.user.roles) {
        this.showDeconnexionBtn = true;
        if (this.user.roles.includes(ROLE.submitter)) {
          const className = "btn btn-outline-info";
          this.currentUserNavbar.push({
            allowedRouteName : "SearchThemeCreate",
            libelle : "Liste des mots-clés",
            className
          });
        } else if (this.user.roles.includes(ROLE.validator)) {
          const className = "btn btn-outline-success";
          this.currentUserNavbar.push(            {
            allowedRouteName: "PlanificatorList",
            libelle: "Validation de Planning",
            className
          });
        } else if (this.user.roles.includes(ROLE.admin)) {
          const className = 'btn btn-outline-warning';
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
              allowedRouteName: "PlanificatorList",
              libelle: "Validation de Planning",
              className
            }
          );
        }
      } else {
        this.currentUserNavbar = [];
        this.showDeconnexionBtn = false;
      }
    }
  },
  beforeMount() {
    this.resolveNavbarLinksFromRole();
  }
};
</script>
