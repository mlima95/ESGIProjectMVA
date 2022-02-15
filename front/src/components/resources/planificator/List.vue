<template>

  <div>
    <h1>Planificator List</h1>

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
      <!--      <router-link-->
      <!--        :to="{ name: 'PlanificatorCreate' }"-->
      <!--        class="btn btn-primary">Create</router-link>-->
    </p>
    <div
      v-for="item in items"
      :key="item['@id']">
      <Card :itemCard="item"></Card>
    </div>

  </div>
</template>

<script>
import {mapFields} from 'vuex-map-fields';
import Card from "./Card";

export default {
  data() {
    return {
      items: {
        type: Array
      }
    }
  },
  computed: {
    ...mapFields('planificator/del', {
      deletedItem: 'deleted',
    }),
    ...mapFields('planificator/list', {
      error: 'error',
      isLoading: 'isLoading',
      view: 'view',
    }),
  },
  components: {
    Card
  },
  created(){
    this.items = JSON.parse(localStorage.getItem("listVideo"));
    console.log("dfsdgdf",this.items)
  }
};
</script>
