<template>
  <form @submit.prevent="handleSubmit(item)">
    <div class="form-group">
      <label
        for="searchtheme_keyword"
        class="form-control-label">keyword</label>
        <input
          id="searchtheme_keyword"
          v-model="item.keyword"
          :class="['form-control', !isValid('keyword') ? 'is-invalid' : 'is-valid']"
          type="text"
          placeholder="">
      <div
        v-if="!isValid('keyword')"
        class="invalid-feedback">{{ violations.keyword }}</div>
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
    this.authorIdGetSelectItems();
    this.validatorIdGetSelectItems();
  },

  computed: {
    ...mapFields('authorId/list', {
      'authorIdSelectItems': 'selectItems',
    }),
    ...mapFields('validatorId/list', {
      'validatorIdSelectItems': 'selectItems',
    }),

    // eslint-disable-next-line
    item() {
      console.log('eee')
      return this.initialValues || this.values;
    },

    violations() {
      return this.errors || {};
    },
  },

  methods: {
    ...mapActions({
        authorIdGetSelectItems: 'authorId/list/getSelectItems',
        validatorIdGetSelectItems: 'validatorId/list/getSelectItems',
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
