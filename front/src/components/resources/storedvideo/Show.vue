<template>
  <div>
    <h1>Show {{ item && item['@id'] }}</h1>

    <div
      v-if="isLoading"
      class="alert alert-info"
      role="status">Loading...</div>
    <div
      v-if="error"
      class="alert alert-danger"
      role="alert">
      <span
        class="fa fa-exclamation-triangle"
        aria-hidden="true">{{ error }}</span>
    </div>
    <div
      v-if="deleteError"
      class="alert alert-danger"
      role="alert">
      <span
        class="fa fa-exclamation-triangle"
        aria-hidden="true">{{ deleteError }}</span>
    </div>
    <div
      v-if="item"
      class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Field</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">id</th>
            <td>{{ item['id'] }}</td>
          </tr>
          <tr>
            <th scope="row">videoId</th>
            <td>{{ item['videoId'] }}</td>
          </tr>
          <tr>
            <th scope="row">dateOfUpload</th>
            <td>{{ item['dateOfUpload'] }}</td>
          </tr>
          <tr>
            <th scope="row">status</th>
            <td>{{ item['status'] }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <router-link
      :to="{ name: 'StoredVideoList' }"
      class="btn btn-primary">
      Back to list
    </router-link>
    <router-link
      v-if="item"
      :to="{ name: 'StoredVideoUpdate', params: { id: item['@id'] } }"
      class="btn btn-warning">
      Edit
    </router-link>
    <button
      class="btn btn-danger"
      @click="deleteItem(item)">Delete</button>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import { mapFields } from 'vuex-map-fields';

export default {
  computed: {
    ...mapFields('storedvideo/del', {
      deleteError: 'error',
    }),
    ...mapFields('storedvideo/show', {
      error: 'error',
      isLoading: 'isLoading',
      item: 'retrieved',
    }),
  },

  beforeDestroy () {
    this.reset();
  },

  created () {
    this.retrieve(decodeURIComponent(this.$route.params.id));
  },

  methods: {
    ...mapActions({
      del: 'storedvideo/del/del',
      reset: 'storedvideo/show/reset',
      retrieve: 'storedvideo/show/retrieve',
    }),

    deleteItem (item) {
      if (window.confirm('Are you sure you want to delete this item?')) {
        this.del(item).then(() => this.$router.push({ name: 'StoredVideoList' }));
      }
    },
  },
};
</script>
