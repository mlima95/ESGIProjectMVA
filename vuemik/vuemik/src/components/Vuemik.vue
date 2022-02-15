<template>
  <div class="mx-auto" style="width:500px">
    <Form>
      <Field v-for="(field, index) in fields" :key="index" :field="field"/>
      <button type="submit" class="btn btn-primary" @click.prevent="submit">Soumettre</button>
    </Form>
  </div>

</template>

<script>
import Field from './Field.vue';

export default {
  name: 'Vuemik',
  components: {Field},
  props: {
    onSubmit: {
      type: Function,
    },
    initialValues: {
      type: Array,
      required: true,
      default() {
        return [
          {
            fieldTag: String,
            fieldName: String,
            fieldType: String,
            placeholder: String,
            validator: Function,
            value: String,
            sub: Object //Same, fieldtag, name, type, etc
          }
        ];
      }
    }
  },
  data() {
    return {
      fields: this.initialValues
    };
  },
  methods: {
    submit(event) {
      this.onSubmit(event);
    },
  }
};
</script>
