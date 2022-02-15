<template>
  <div class="vertical-center">
    <div class="inner-block">
      <div class="vue-template">
        <form>
          <h3>Connexion</h3>
          <div class="form-group">
            <label>Identifiant</label>
            <input type="text" name="username" class="form-control form-control-lg" v-model="input.username"
                   placeholder="Username"/>
          </div>
          <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" class="form-control form-control-lg" name="password" v-model="input.password"
                   placeholder="Password"/>
          </div>
          <div class="row">
            <div class="col">
              <hr>
            </div>
            <div class="col-auto">OU</div>
            <div class="col">
              <hr>
            </div>
          </div>
          <div class="form-group">
            <label>Connexion Rapide</label>
            <input type="password" class="form-control form-control-lg" v-model="input.quickSignIn"
                   placeholder="identifiant:motDePasse"/>
          </div>
          <div class="d-grid gap-2 mt-3">
            <button type="button" class="btn btn-dark btn-lg btn-block" :class="{'disabled': !validatedFields}"
                    v-on:click="signIn()">
              <span v-if="this.isLoading">Connexion en cours...</span>
              <span v-else>Se connecter</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</template>
<script>
import {mapActions} from 'vuex';
import {mapState} from 'vuex';
import {isCurrentUserHaveRole, redirectOnHomepageByRole, ROLE} from '../../utils/utils.js';

export default {
  name: "Login",
  data() {
    return {
      input: {
        username: "",
        password: "",
        quickSignIn: ""
      }
    };
  },
  computed: {
    validatedFields: function () {
      return (this.input.username !== "" && this.input.password !== "") || this.input.quickSignIn !== "";
    },
    ...mapState('auth/login', [
      'isLoading'
    ])
  },
  methods: {
    ...mapActions('auth/login', [
      'login',
    ]),
    async signIn() {
      if (!!this.input.quickSignIn) {
        [this.input.username, this.input.password] = this.input.quickSignIn.split(':');
      }
      this.login({
        username: this.input.username,
        password: this.input.password
      }).then(() => {
        redirectOnHomepageByRole(this.$router);
      });
    }
  }
};
</script>
