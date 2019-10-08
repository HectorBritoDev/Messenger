<template>
  <div>
    <b-form class="my-3 mx-2" @submit.prevent="searchConversation">
      <b-form-input
        type="text"
        placeholder="Buscar contacto"
        class="text-center"
        v-model="search"
        @keyup="searchConversation"
      ></b-form-input>
    </b-form>
    <b-list-group class="scroll">
      <contact-component
        v-for="conversation in conversations"
        :key="conversation.id"
        :conversation="conversation"
        :selected="selectConversationId === conversation.id"
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
  props: {
    conversations: Array
  },
  data() {
    return {
      selectConversationId: null,
      search: ""
    };
  },
  methods: {
    selectConversation(conversation) {
      this.selectConversationId = conversation.id;
      this.$emit("conversationSelected", conversation);
    },
    searchConversation() {
      this.$emit("searchConversation", this.search);
    }
  },
  mounted() {}
};
</script>

<style>
</style>
