<template>
  <b-container fluid style="height: calc(100vh - 56px);">
    <b-row no-gutters class="h-100">
      <b-col cols="4">
        <contact-form-component />
        <contact-list-component />
      </b-col>
      <b-col cols="8">
        <active-conversation-component v-if="selectedConversation" />
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  props: {
    authUser: Object
  },

  methods: {
    changeStatus(user, status) {
      const conversation = this.$store.state.conversations.find(
        conversation => {
          return conversation.contact_id == user.id;
        }
      );
      if (typeof conversation != "undefined") {
        this.$set(conversation, "online", status);
      }
    }
  },

  computed: {
    selectedConversation() {
      return this.$store.state.selectedConversation;
    }
  },

  mounted() {
    this.$store.commit("setUser", this.authUser);
    this.$store.dispatch("getConversations").then(() => {
      const conversationId = this.$route.params.conversationId;

      if (conversationId) {
        const conversation = this.$store.getters.getConversationById(
          conversationId
        );
        this.$store.dispatch("getMessages", conversation);
      }
    });

    Echo.private("users." + this.authUser.id).listen("MessageSend", data => {
      const message = data.message;
      message.writte_by_me = false;
      this.addMessage(message);
    });

    Echo.join("messenger")
      .here(users => users.forEach(user => this.changeStatus(user, true)))
      .joining(user => this.changeStatus(user, true))
      .leaving(user => this.changeStatus(user, false));
  }
};
</script>

<style>
.scroll {
  max-height: calc(100vh - 130px);
  overflow-y: auto;
}
</style>
