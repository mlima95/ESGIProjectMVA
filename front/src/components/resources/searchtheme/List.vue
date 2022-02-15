<template>
  <div class="vertical-center">
    <div class="inner-block">
      <div>
        <h1>SearchTheme List</h1>

        <div
          v-if="isLoading"
          class="alert alert-info">Loading...
        </div>
        <div
          v-if="deletedItem"
          class="alert alert-success">{{ deletedItem['@id'] }} deleted.
        </div>
        <div
          v-if="error"
          class="alert alert-danger">{{ error }}
        </div>

        <p>
          <router-link
            :to="{ name: 'SearchThemeCreate' }"
            class="btn btn-primary">Create
          </router-link>
        </p>


        <div>
          Keywords :
          <div>
            <button @click="goToPlanificatorList(item['youtubeLinkId'])" class="badge bg-info text-dark" v-for="item in items" :key="item['@id']" >
              {{ item['keyword'] }} &nbsp;&nbsp;
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>


</template>

<script>
import {mapActions} from 'vuex';
import {mapFields} from 'vuex-map-fields';
import * as types from "../../../store/modules/planificator/list/mutation_types.js";

export default {
  computed: {
    ...mapFields('searchtheme/del', {
      deletedItem: 'deleted',
    }),
    ...mapFields('searchtheme/list', {
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
      getPage: 'searchtheme/list/default',
      setIdList: 'planif'
    }),
    goToPlanificatorList(idList){
      const list = [];
      for (const id of idList){
        list.push({
          youtubeSlug: id,
          dateOfUpload: new Date().toISOString()
        })
      }
      localStorage.setItem("listVideo", JSON.stringify(list));
      this.$router.push({name: "PlanificatorList"})
    }
  },
};
</script>
