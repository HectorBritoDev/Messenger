<template>
  <div>
    <b-list-group class="scroll">
      <contact-component
        v-for="conversation in conversationsFiltered"
        :key="conversation.id"
        :conversation="conversation"
        :selected="isSelected(conversation)"
        @click.native="selectConversation(conversation)"
      ></contact-component>
      <!-- <contact-component variant="dark"></contact-component>
      <contact-component variant></contact-component>
      <contact-component variant="secondary"></contact-component>-->
    </b-list-group>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    selectConversation(conversation) {
      //Se usa dispatch en vez de commit, porque el action getMessages es el que realiza el commit selectConversation
      this.$store.dispatch("getMessages", conversation);
    },

    isSelected(conversation) {
      return conversation
        ? this.selectedConversation.id === conversation.id
        : false;
    }
  },
  computed: {
    selectedConversation() {
      return this.$store.state.selectedConversation;
    },
    conversationsFiltered() {
      return this.$store.getters.conversationsFiltered;
    }
  }
};
</script>

<style>
</style>
