<template>
  <b-container fluid style="height: calc(100vh - 56px);">
    <b-row no-gutters class="h-100">
      <b-col cols="4">
        <contact-list-component
          @conversationSelected="changeActiveConversation($event)"
          @searchConversation="searchConversation($event)"
          :conversations="conversationsFiltered"
        ></contact-list-component>
      </b-col>
      <b-col cols="8">
        <active-conversation-component
          v-if="selectedConversation"
          :contact-id="selectedConversation.contact_id"
          :contact-name="selectedConversation.contact_name"
          :contact-avatar="selectedConversation.contact_avatar"
          :user-avatar="authUserAvatarUrl"
          :messages="messages"
          @messageCreated="addMessage($event)"
        ></active-conversation-component>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  props: {
    authUser: Object
  },
  data() {
    return {
      selectedConversation: null,
      messages: [],
      conversations: [],
      querySearch: ""
    };
  },
  methods: {
    changeActiveConversation(conversation) {
      this.selectedConversation = conversation;
      this.getMessages();
    },
    getMessages() {
      axios
        .get("/api/message?contact_id=" + this.selectedConversation.contact_id)
        .then(response => {
          this.messages = response.data;
        })
        .catch(error => {
          alert(error);
          console.log(error);
        });
    },
    addMessage(message) {
      // ID de Conversación a actualizar last message y last_time
      // Una donde el yo O ESTE RECIBIENDO UN MENSAJE o UNA DONDE YO SEA QUIEN ENVIA EL MENSAJE
      const conversation = this.conversations.find(conversation => {
        return (
          conversation.contact_id == message.from_id ||
          conversation.contact_id == message.to_id
        );
      });
      const author =
        this.authUser.id == message.from_id ? "Tú" : conversation.contact_name;

      conversation.last_message = author + ":" + message.content;
      conversation.last_time = message.created_at;

      if (
        this.selectedConversation &&
        (this.selectedConversation.contact_id == message.from_id ||
          this.selectedConversation.contact_id == message.to_id)
      ) {
        //El calculo de written_by_me se hace
        //bien sea cuando se recibe un mensaje del canal(Mounted) o cuando se registra un mensaje(PostMessage)
        this.messages.push(message);
      }
    },
    getConversations() {
      axios
        .get("/api/conversation")
        .then(response => {
          this.conversations = response.data;
        })
        .catch(error => {
          alert(error);
          console.log(error);
        });
    },
    changeStatus(user, status) {
      const conversation = this.conversations.find(conversation => {
        return conversation.contact_id == user.id;
      });
      if (typeof conversation != "undefined") {
        this.$set(conversation, "online", status);
      }
    },
    searchConversation(query) {
      this.querySearch = query;
    }
  },

  computed: {
    conversationsFiltered() {
      //Filter es case sensitive
      return this.conversations.filter(conversation =>
        conversation.contact_name
          .toLowerCase()
          .includes(this.querySearch.toLowerCase())
      );
    },
    authUserAvatarUrl() {
      return "/users/" + this.authUser.avatar;
    }
  },

  mounted() {
    this.getConversations();
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
