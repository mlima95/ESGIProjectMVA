<template>
  <!--  <div class="card">-->
  <!--    <div class="">-->
  <!--      <iframe width="300" height="150" :src="'https://www.youtube.com/embed/'+itemCard.youtubeSlug"-->
  <!--              title="YouTube video player" frameborder="0"-->
  <!--              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"-->
  <!--              allowfullscreen></iframe>-->
  <!--      <h3>{{ itemCard.dateOfUpload }}</h3>-->
  <!--      <button class="btn btn-success">Change Status</button>-->
  <!--    </div>-->

  <!--  </div>-->

  <div class="card" style="width: 25rem;">
    <iframe class="card-img-top" width="300" height="150" :src="'https://www.youtube.com/embed/'+itemCard.youtubeSlug"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    <div class="card-body ">
      <template v-if="modifiable()">
        <b-form-datepicker id="planificator_dateOfUpload" v-model="itemCard.dateOfUpload" class="mb-2"></b-form-datepicker>
      </template>
      <template v-else><h5 class="card-title ">{{ itemCard.dateOfUpload | dateFormat }}</h5></template>
      <button class="btn btn-success d-flex justify-content-center" v-on:click="createPlanning()">Proposer le planning</button>
      <button v-if="!modifiable()" class="btn btn-success d-flex justify-content-center" v-on:click="validateHandler()">Valider le planning</button>
    </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex';
import {isCurrentUserHaveRole, ROLE} from '../../../utils/utils.js';

export default {
  name: "Card",
  props: {
    itemCard: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      itemData: this.itemCard,
    }
  },
  methods: {
    ...mapActions('planificator/create', [
      'validHandler',
      'create'
    ]),
    validateHandler() {
      console.log(this.itemCard);
      this.validHandler(this.itemCard);
    },
    createPlanning() {
      this.create(this.itemCard).then(() => {
          this.$router.push({name: "PlanificatorList"});
        }
      );
    },
    modifiable() {
     return isCurrentUserHaveRole(ROLE.validator)
    }
  }
}
</script>

<style scoped>

</style>
