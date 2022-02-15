<template>
  <component :is="isSub(field.fieldTag) ? 'optgroup' : 'div'" class="mb-3">
    <label v-if="field.fieldName" class="form-label">{{ field.fieldName }}</label>
    <component
        class="form-control"
        :is="field.fieldTag"
        :type="field.fieldType"
        :placeholder="field.placeholder"
        @keyup="(event) => !!field.validator && field.validator(event.target.value, event)"
        :value="field.value">
      <template v-if="!!field.sub">
        <Field v-for="(sub, subIndex) in field.sub" :key="subIndex" :field="sub" />
      </template>
      <template v-else>{{ field.value }}</template>
    </component>
  </component>
</template>

<script>
export default {
  name: "Field",
  props: {
    field: {
      type: Object,
      default() {
        return {
          fieldTag: String,
          fieldName: String,
          fieldType: String,
          placeholder: String,
          validator: Function,
          value: String,
          sub: Object //Same, fieldtag, name, type, etc
        };

      }
    }
  },
  methods: {
    isSub(tag){
      return ["option", "optgroup" ].includes(tag.toLowerCase())
    }
  }
};
</script>

<style scoped>

</style>
