<template>
  <form @submit.prevent="handleSubmit(item)">
    <div class="form-group">
      <label
        for="storedvideo_id"
        class="form-control-label">id</label>
        <input
          id="storedvideo_id"
          v-model="item.id"
          :class="['form-control', !isValid('id') ? 'is-invalid' : 'is-valid']"
          type="text"
          placeholder="">
      <div
        v-if="!isValid('id')"
        class="invalid-feedback">{{ violations.id }}</div>
    </div>
    <div class="form-group">
      <label
        for="storedvideo_videoId"
        class="form-control-label">videoId</label>
        <input
          id="storedvideo_videoId"
          v-model="item.videoId"
          :class="['form-control', !isValid('videoId') ? 'is-invalid' : 'is-valid']"
          type="text"
          placeholder="">
      <div
        v-if="!isValid('videoId')"
        class="invalid-feedback">{{ violations.videoId }}</div>
    </div>
    <div class="form-group">
      <label
        for="storedvideo_dateOfUpload"
        class="form-control-label">dateOfUpload</label>
        <input
          id="storedvideo_dateOfUpload"
          v-model="item.dateOfUpload"
          :class="['form-control', !isValid('dateOfUpload') ? 'is-invalid' : 'is-valid']"
          type="text"
          placeholder="">
      <div
        v-if="!isValid('dateOfUpload')"
        class="invalid-feedback">{{ violations.dateOfUpload }}</div>
    </div>
    <div class="form-group">
      <label
        for="storedvideo_status"
        class="form-control-label">status</label>
        <input
          id="storedvideo_status"
          v-model="item.status"
          :class="['form-control', !isValid('status') ? 'is-invalid' : 'is-valid']"
          type="number"
          placeholder="">
      <div
        v-if="!isValid('status')"
        class="invalid-feedback">{{ violations.status }}</div>
    </div>

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
