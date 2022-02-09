<template>
  <div>
    <h1>New StoredVideo</h1>

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

    <StoredVideoForm
      :handle-submit="onSendForm"
      :values="item"
      :errors="violations" />

    <router-link
      :to="{ name: 'StoredVideoList' }"
      class="btn btn-default">Back to list</router-link>
  </div>
</template>

<script>
import { createHelpers } from 'vuex-map-fields';
import { mapActions } from 'vuex';
import StoredVideoForm from './Form.vue';

const { mapFields } = createHelpers({
    getterType: 'storedvideo/create/getField',
    mutationType: 'storedvideo/create/updateField',
});

export default {
  components: {
    StoredVideoForm,
  },

  data () {
    return {
      item: {},
    };
  },

  computed: {
    ...mapFields([
      'error',
      'isLoading',
      'created',
      'violations',
    ]),
  },

  watch: {
    // eslint-disable-next-line object-shorthand,func-names
    created: function(created) {
      if (!created) {
        return;
      }

      this.$router.push({ name: 'StoredVideoUpdate', params: { id: created['@id'] } });
    }
  },

  methods: {
    ...mapActions('storedvideo/create', [
      'create',
    ]),

    onSendForm () {
      this.create(this.item);
    },
  },
};
</script>
