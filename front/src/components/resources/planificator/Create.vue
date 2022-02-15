<template>
  <div>
    <h1>New Planificator</h1>

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

    <PlanificatorForm
      :handle-submit="onSendForm"
      :values="item"
      :errors="violations" />

    <router-link
      :to="{ name: 'PlanificatorList' }"
      class="btn btn-default">Back to list</router-link>
  </div>
</template>

<script>
import { createHelpers } from 'vuex-map-fields';
import { mapActions } from 'vuex';
import PlanificatorForm from './Form';

const { mapFields } = createHelpers({
    getterType: 'planificator/create/getField',
    mutationType: 'planificator/create/updateField',
});

export default {
  components: {
    PlanificatorForm,
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

      this.$router.push({ name: 'PlanificatorUpdate', params: { id: created['@id'] } });
    }
  },

  methods: {
    ...mapActions('planificator/create', [
      'create',
    ]),

    onSendForm () {
      this.create(this.item).then(() => {
        this.$router.push({name: "PlanificatorList"});
      }
      );
    },
  },
};
</script>
