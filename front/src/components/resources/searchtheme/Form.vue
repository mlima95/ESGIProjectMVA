<template>
  <form @submit.prevent="handleSubmit(item)">
    <div class="form-group">
      <label
        for="searchtheme_id"
        class="form-control-label">id</label>
        <input
          id="searchtheme_id"
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
    <div class="form-group">
      <label
        for="searchtheme_statusId"
        class="form-control-label">statusId</label>
        <input
          id="searchtheme_statusId"
          v-model="item.statusId"
          :class="['form-control', !isValid('statusId') ? 'is-invalid' : 'is-valid']"
          type="number"
          placeholder="">
      <div
        v-if="!isValid('statusId')"
        class="invalid-feedback">{{ violations.statusId }}</div>
    </div>
    <div class="form-group">
      <label
        for="searchtheme_youtubeLinkId"
        class="form-control-label">youtubeLinkId</label>
        <input
          id="searchtheme_youtubeLinkId"
          v-model="item.youtubeLinkId"
          :class="['form-control', !isValid('youtubeLinkId') ? 'is-invalid' : 'is-valid']"
          type="number"
          placeholder="">
      <div
        v-if="!isValid('youtubeLinkId')"
        class="invalid-feedback">{{ violations.youtubeLinkId }}</div>
    </div>
    <div class="form-group">
      <label
        for="searchtheme_authorId"
        class="form-control-label">authorId</label>
        <select
          v-model="item.authorId"
          id="searchtheme_authorId"
          class="form-control"
        >
          <option v-for="selectItem in authorIdSelectItems"
                  :key="selectItem['@id']"
                  :value="selectItem['@id']"
                  :selected="isSelected('authorId', selectItem['@id'])">{{ selectItem.name }}
          </option>
        </select>
      <div
        v-if="!isValid('authorId')"
        class="invalid-feedback">{{ violations.authorId }}</div>
    </div>
    <div class="form-group">
      <label
        for="searchtheme_validatorId"
        class="form-control-label">validatorId</label>
        <select
          v-model="item.validatorId"
          id="searchtheme_validatorId"
          class="form-control"
        >
          <option v-for="selectItem in validatorIdSelectItems"
                  :key="selectItem['@id']"
                  :value="selectItem['@id']"
                  :selected="isSelected('validatorId', selectItem['@id'])">{{ selectItem.name }}
          </option>
        </select>
      <div
        v-if="!isValid('validatorId')"
        class="invalid-feedback">{{ violations.validatorId }}</div>
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
