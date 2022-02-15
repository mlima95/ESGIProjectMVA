<template>

  <div>
    <h1>Planificator List</h1>

    <div
      v-if="isLoading"
      class="alert alert-info">Loading...
    </div>
    <div
      v-if="error"
      class="alert alert-danger">{{ error }}
    </div>

    <div
      v-for="item in getItemsList()"
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
    ...mapFields('planificator/list', {
      error: 'error',
      isLoading: 'isLoading',
      view: 'view',
    })
  },
  components: {
    Card
  },
  methods: {
    getItemsList(){
      return this.items;
    }
  },
  created(){
    // this.items = JSON.parse(localStorage.getItem("listVideo"));
    // console.log("dfsdgdf",this.items)
  }
};
</script>
