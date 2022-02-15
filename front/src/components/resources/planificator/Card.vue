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
      <button class="btn btn-success d-flex justify-content-center" @click="validHandler">Change Status</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: ['itemCard'],
  methods: {
    ...mapActions('planificator/create', [
      'validHandler',
    ]),
    validateHandler(){
      this.validHandler({itemCard})
    }
  }
}
</script>

<style scoped>

</style>
