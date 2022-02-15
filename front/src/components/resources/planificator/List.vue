<template>

  <div>
    <h1>Planificator List</h1>

    <div
      v-if="isLoading"
      class="alert alert-info">Loading...</div>
    <div
      v-if="deletedItem"
      class="alert alert-success">{{ deletedItem['@id'] }} deleted.</div>
    <div
      v-if="error"
      class="alert alert-danger">{{ error }}</div>

    <p>
      <router-link
        :to="{ name: 'PlanificatorCreate' }"
        class="btn btn-primary">Create</router-link>
    </p>

<!--    <table class="table table-responsive table-striped table-hover">-->
<!--      <thead>-->
<!--        <tr>-->
<!--          <th>Id</th>-->
<!--          <th>youtubeSlug</th>-->
<!--          <th>statusId</th>-->
<!--          <th>dateOfUpload</th>-->
<!--          <th>userId</th>-->
<!--          <th colspan="2"></th>-->
<!--        </tr>-->
<!--      </thead>-->
<!--      <tbody>-->
        <div
          v-for="item in items"
          :key="item['@id']">
          <Card :itemCard="item"></Card>
        </div>


    <nav aria-label="Page navigation" v-if="view">
      <router-link
        :to="view['hydra:first'] ? view['hydra:first'] : 'PlanificatorContactList'"
        :class="{ disabled: !view['hydra:previous'] }"
        class="btn btn-primary">
        <span aria-hidden="true">&lArr;</span> First
      </router-link>
      &nbsp;
      <router-link
        :to="!view['hydra:previous'] || view['hydra:previous'] === view['hydra:first'] ? 'PlanificatorList' : view['hydra:previous']"
        :class="{ disabled: !view['hydra:previous'] }"
        class="btn btn-primary">
        <span aria-hidden="true">&larr;</span> Previous
      </router-link>

      <router-link
        :to="view['hydra:next'] ? view['hydra:next'] : '#'"
        :class="{ disabled: !view['hydra:next'] }"
        class="btn btn-primary">
        Next <span aria-hidden="true">&rarr;</span>
      </router-link>

      <router-link
        :to="view['hydra:last'] ? view['hydra:last'] : '#'"
        :class="{ disabled: !view['hydra:next'] }"
        class="btn btn-primary">
        Last <span aria-hidden="true">&rArr;</span>
      </router-link>
    </nav>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import { mapFields } from 'vuex-map-fields';
import Card from "./Card";

export default {
  computed: {
      ...mapFields('planificator/del', {
          deletedItem: 'deleted',
      }),
      ...mapFields('planificator/list', {
          error: 'error',
          items: 'items',
          isLoading: 'isLoading',
          view: 'view',
      }),
  },
  components: {
    Card
  },
  mounted() {
    this.getPage();
    console.log("test");
  },

  methods: {
    ...mapActions({
      getPage: 'planificator/list/default',
    }),
  },
};
</script>
