<template>
  <div class="vertical-center">
    <div class="inner-block">
      <div>
        <h1>New SearchTheme</h1>

        <div
          v-if="isLoading"
          class="alert alert-info"
          role="status">Loading...
        </div>
        <div
          v-if="error"
          class="alert alert-danger"
          role="alert">
      <span
        class="fa fa-exclamation-triangle"
        aria-hidden="true">{{ error }}</span>
        </div>
        <SearchThemeForm
          :handle-submit="onSendForm"
          :values="item"
          :errors="violations"/>

        <router-link
          :to="{ name: 'SearchThemeList' }"
          class="btn btn-default">Back to list
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import {createHelpers} from 'vuex-map-fields';
import {mapActions} from 'vuex';
import SearchThemeForm from './Form';


const { mapFields } = createHelpers({
    getterType: 'searchtheme/create/getField',
    mutationType: 'searchtheme/create/updateField',
});

export default {
  components: {
    SearchThemeForm,
  },

  data() {
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
    created: function (created) {
      if (!created) {
        return;
      }

      this.$router.go();
    }
  },

  methods: {
    ...mapActions('searchtheme/create', [
      'create',
    ]),


    onSendForm () {
      this.create(this.item).then(() => {
        this.$router.push({name: "SearchThemeList"});
      }
      );
    },
  },
};
</script>
