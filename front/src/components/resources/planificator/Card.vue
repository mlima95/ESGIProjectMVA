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
      <h5 class="card-title ">{{ itemCard.dateOfUpload }}</h5>
      <button class="btn btn-success d-flex justify-content-center" v-on:click="validateHandler()">Change Status</button>
    </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex';

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
    ]),
    validateHandler() {
      console.log(this.itemCard);
      this.validHandler(this.itemCard);
    }
  }
}
</script>

<style scoped>

</style>
