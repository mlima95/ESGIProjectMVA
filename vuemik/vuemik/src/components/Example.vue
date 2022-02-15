<template>
  <Vuemik
      :initial-values="initialValues"
      :onSubmit="onSubmit"
  />
</template>

<script>
import Vuemik from './Vuemik.vue';

export default {
  name: 'Example',
  components: {
    Vuemik
  },
  data() {
    return {
      initialValues: [
        {
          fieldTag: "input",
          fieldName: "Simple champs text",
          fieldType: "text",
          placeholder: "Placeholder ici",
          value: "Valeur d'exemple",
          validator: (content, event) => console.log("On récupère la valeur ainsi : " + content + "ou en la cherchant dans event.target.value : " + event.target.value),
        },
        {
          fieldTag: "input",
          fieldName: "Simple champs de Mot de passe",
          fieldType: "password",
          placeholder: "MDP ici",
          value: "Typescript c'est mieux que JS (mais Karl > Adrien)",
          validator: () => console.log("Possibiltié de validé (eventtype = keyup)"),
        },
        {
          fieldTag: "input",
          fieldName: "Simple textarea",
          fieldType: "text",
          placeholder: "Placeholder ici encore...",
          value: "Un très long texte doit être écrit ici",
          validator: () => console.log("Possibiltié de validé ici aussi (eventtype = keyup)"),
        },
        {
          fieldTag: "select",
          fieldName: "Choisir dans la liste",
          fieldType: undefined,
          sub: [{
            fieldTag: "option",
            value: "Option 1"
          },
            {
              fieldTag: "option",
              value: "Option 2"
            },
            {
              fieldTag: "option",
              value: "Option 3"
            }]
        },

      ]
    };
  },
  methods: {
    onSubmit(event) {
      console.log("Submitted ! Voilà un exemple d'event de submission", event);
    }
  }
};
</script>
