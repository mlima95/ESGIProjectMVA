<template>
  <form @submit.prevent="handleSubmit(item)">
    <div class="form-group">
      <label
        for="planificator_youtubeSlug"
        class="form-control-label">youtubeSlug</label>
        <input
          id="planificator_youtubeSlug"
          v-model="item.youtubeSlug"
          :class="['form-control', !isValid('youtubeSlug') ? 'is-invalid' : 'is-valid']"
          type="text"
          placeholder="">
      <div
        v-if="!isValid('youtubeSlug')"
        class="invalid-feedback">{{ violations.youtubeSlug }}</div>
    </div>
<!--    <div class="form-group">-->
<!--      <label-->
<!--        for="planificator_statusId"-->
<!--        class="form-control-label">statusId</label>-->
<!--        <input-->
<!--          id="planificator_statusId"-->
<!--          v-model="item.statusId"-->
<!--          :class="['form-control', !isValid('statusId') ? 'is-invalid' : 'is-valid']"-->
<!--          type="text"-->
<!--          placeholder="">-->
<!--      <div-->
<!--        v-if="!isValid('statusId')"-->
<!--        class="invalid-feedback">{{ violations.statusId }}</div>-->
<!--    </div>-->
    <div class="form-group">
      <label
        for="planificator_dateOfUpload"
        class="form-control-label">dateOfUpload</label>
<!--        <input-->
<!--          id="planificator_dateOfUpload"-->
<!--          v-model="item.dateOfUpload"-->
<!--          :class="['form-control', !isValid('dateOfUpload') ? 'is-invalid' : 'is-valid']"-->
<!--          type="text"-->
<!--          placeholder="">-->
      <b-form-datepicker id="planificator_dateOfUpload" v-model="item.dateOfUpload" class="mb-2"></b-form-datepicker>
      <div
        v-if="!isValid('dateOfUpload')"
        class="invalid-feedback">{{ violations.dateOfUpload }}</div>
    </div>
<!--    <div class="form-group">-->
<!--      <label-->
<!--        for="planificator_userId"-->
<!--        class="form-control-label">userId</label>-->
<!--        <input-->
<!--          id="planificator_userId"-->
<!--          v-model="item.userId"-->
<!--          :class="['form-control', !isValid('userId') ? 'is-invalid' : 'is-valid']"-->
<!--          type="text"-->
<!--          placeholder="">-->
<!--      <div-->
<!--        v-if="!isValid('userId')"-->
<!--        class="invalid-feedback">{{ violations.userId }}</div>-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--      <label-->
<!--        for="planificator_status"-->
<!--        class="form-control-label">status</label>-->
<!--        <input-->
<!--          id="planificator_status"-->
<!--          v-model="item.status"-->
<!--          :class="['form-control', !isValid('status') ? 'is-invalid' : 'is-valid']"-->
<!--          type="text"-->
<!--          placeholder="">-->
<!--      <div-->
<!--        v-if="!isValid('status')"-->
<!--        class="invalid-feedback">{{ violations.status }}</div>-->
<!--    </div>-->

    <button
      type="submit"
      class="btn btn-success">Submit</button>
  </form>
</template>

<script>
  import { find, get, isUndefined } from 'lodash';
  import { mapFields } from 'vuex-map-fields';
  import { mapActions } from 'vuex';

  export default {
  props: {
    handleSubmit: {
      type: Function,
      required: true,
    },

    values: {
      type: Object,
      required: true,
    },

    errors: {
      type: Object,
      default: () => {},
    },

    initialValues: {
      type: Object,
      default: () => {},
    }
  },

  mounted() {
  },

  computed: {

    // eslint-disable-next-line
    item() {
      return this.initialValues || this.values;
    },

    violations() {
      return this.errors || {};
    },
  },

  methods: {
    ...mapActions({
    }),

    isSelected(collection, id) {
      return find(this.item[collection], ['@id', id]) !== undefined;
    },

    isValid(key) {
      return isUndefined(get(this.violations, key));
    },
  },
};
</script>
