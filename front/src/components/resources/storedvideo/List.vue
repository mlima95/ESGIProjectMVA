<template>
  <div>
    <h1>Etat des vidéos</h1>
    <div class="bg-light clearfix mb3">
      <button
        @click="getVideo(0)"
        class="btn btn-info mr1">Vidéo en cours
      </button>
      <button
        @click="getVideo(1)"
        class="btn btn-success mr1">Vidéo terminée
      </button>
      <button
        @click="getVideo(99)"
        class="btn btn-warning mr1">Vidéo en erreur
      </button>
    <div
      v-if="isLoading"
      class="alert alert-info">Chargement en cours...</div>
    <div
      v-if="error"
      class="alert alert-danger">Erreur : {{ error }}</div>

    </div>
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>Vidéo</th>
          <th>Date d'envoie prévue/passée</th>
          <th>Téléchargement</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in items"
          :key="item['@videoId']">
        <td>
            <a :href="youtubeBaseSlug + item['videoId']" target="_blank"> {{ item['videoId'] }} </a>
        </td>
        <td>
            {{ item['dateOfUpload'] | dateFormat }}
        </td>
        <td>
            {{ item['status'] | resolveStatusStoredVideoFilter }}
        </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import { mapFields } from 'vuex-map-fields';

export default {
  data () {
    return  {
      youtubeBaseSlug: "https://www.youtube.com/watch?v="
    }
  },
  computed: {
      ...mapFields('storedVideo/list', {
          error: 'error',
          items: 'items',
          isLoading: 'isLoading',
          view: 'view',
      }),
  },

  mounted() {
    this.getPage();
  },
  methods: {
    ...mapActions({
      getPage: 'storedVideo/list/default',
    }),
    getVideo(status){
      this.getPage({page: undefined, status})
    }
  },
};
</script>
