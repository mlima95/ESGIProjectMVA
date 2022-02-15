<template>
  <div class="vertical-center">
    <div class="inner-block">
      <div>
        <h1>Liste des utilisateurs</h1>
        <div
          v-if="isLoading"
          class="alert alert-info">Chargement en cours...
        </div>
        <div
          v-if="deletedItem"
          class="alert alert-success">L'utilisateur {{ deletedItem['username'] }} a été supprimé.
        </div>
        <div
          v-if="error"
          class="alert alert-danger">Erreur : {{ error }}
        </div>

        <div class="bg-light clearfix">
          <button
            @click="createUser('submitter',1)"
            class="btn btn-info mr1"><i v-if="createIsLoading && pressedCreatedButton === 1"
                                        class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>Générer un
            Submitter
          </button>
          <button
            @click="createUser('validator', 2)"
            class="btn btn-success mr1"><i v-if="createIsLoading && pressedCreatedButton === 2"
                                           class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>Générer un
            Validator
          </button>
          <button
            @click="createUser('admin', 3)"
            class="btn btn-warning mr1"><i v-if="createIsLoading && pressedCreatedButton === 3"
                                           class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>Générer un
            Admin
          </button>
        </div>
        <Modal
          v-show="showCreatedModal"
          @close="toggleModal()"
        >
          <template v-slot:header>
            Utilisateur créé !
          </template>
          <template v-slot:body v-bind:user="user">
            Voici les credentials pour cet utilisateur : {{ user.username + ':' + user.password }}
          </template>
        </Modal>
        <table class="table table-responsive table-striped table-hover">
          <thead>
          <tr>
            <th>UUID</th>
            <th>Username</th>
            <th>Roles</th>
            <th colspan="2"></th>
          </tr>
          </thead>
          <tbody>
          <tr
            v-for="item in items"
            :key="item['@id']">
            <td>
              {{ item['uuid'] }}
            </td>
            <td>
              {{ item['username'] }}
            </td>
            <td>
              <span :class="chooseRoleClass(item.roles)">{{ item['roles'][0] }}</span>
            </td>
            <td>
              <button
                class="btn btn-danger"
                @click="deleteItem(item)">Supprimer <i
                v-if="delIsLoading && item['@id'] === currentlyDeletingItem['@id']" class="fa fa-circle-o-notch fa-spin"
                style="font-size:24px"></i>
              </button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex';
import {mapFields} from 'vuex-map-fields';
import {generateRandomStr, ROLE} from '../../../utils/utils.js';
import Modal from '../../modal/Modal.vue';

export default {
  components: {
    Modal,
  },
  computed: {
    ...mapFields('user/del', {
      deletedItem: 'deleted',
      delIsLoading: 'isLoading'
    }),
    ...mapFields('user/list', {
      error: 'error',
      items: 'items',
      isLoading: 'isLoading',
      view: 'view',
    }),
    ...mapFields('user/create', {
      createIsLoading: 'isLoading'
    })
  },
  data() {
    return {
      currentlyDeletingItem: {
        type: Object
      },
      showCreatedModal: false,
      user: {
        type: Object,
      },
      pressedCreatedButton: 0
    }
  },
  methods: {
    ...mapActions({
      getPage: 'user/list/default',
      create: 'user/create/create',
      del: 'user/del/del'
    }),
    createUser(role, pressedBtn) {
      this.pressedCreatedButton = pressedBtn;
      this.user = {
        "username": generateRandomStr(8),
        "password": generateRandomStr(16),
        "roles": [ROLE[role] || ROLE.submitter]
      };
      this.create(this.user).then(() => {
        this.toggleModal();
        this.pressedCreatedButton = 0;
        this.getPage();
      });
    },
    deleteItem(item) {
      this.currentlyDeletingItem = item;
      if (window.confirm('Voulez-vous supprimer cet utilisateur?')) {
        this.del(item).then(() => this.getPage());
      }
    },
    toggleModal() {
      this.showCreatedModal = !this.showCreatedModal
    },
    chooseRoleClass(roles) {
      switch (roles[0]) {
        case ROLE.submitter:
          return "badge bg-info";
        case ROLE.validator:
          return "badge bg-success";
        case ROLE.admin:
          return "badge bg-warning";
        default:
          return "badge bg-dark";
      }
    }
  },
  mounted() {
    this.getPage();
  },
};
</script>
