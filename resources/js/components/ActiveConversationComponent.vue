<template>
  <b-row class="h-100">
    <b-col cols="8">
      <b-card no-body footer-bg-variant="light" footer-border-variant="dark" class="h-100">
        <b-card-body class="scroll" id="conversation-card-body">
          <message-conversation-component
            v-for="message in messages"
            :key="message.id"
            :written-by-me="message.written_by_me"
            :avatar="message.written_by_me ? userAvatar : selectedConversation.contact_avatar"
          >{{ message.content }}</message-conversation-component>
        </b-card-body>

        <div slot="footer">
          <b-form class="mb-0" @submit.prevent="postMessage" autocomplete="off">
            <b-input-group>
              <b-form-input
                type="text"
                placeholder="Escribe un mensaje"
                class="text-center"
                v-model="newMessage"
              ></b-form-input>
              <b-input-group-append>
                <b-button type="submit" variant="primary">Enviar</b-button>
              </b-input-group-append>
            </b-input-group>
          </b-form>
        </div>
      </b-card>
    </b-col>
    <b-col cols="4">
      <b-img
        :src="selectedConversation.contact_avatar"
        rounded="circle"
        width="60"
        height="60"
        alt="img"
        class="mt-1"
      ></b-img>
      <p v-text="selectedConversation.contact_name"></p>
      <hr />

      <b-form-checkbox>Desactivar notificaciones</b-form-checkbox>
    </b-col>
  </b-row>
</template>

<script>
export default {
  data() {
    return {
      newMessage: ""
    };
  },
  methods: {
    postMessage() {
      this.$store.dispatch("postMessage", this.newMessage);
    },
    scrollToBottom() {
      const el = document.querySelector("#conversation-card-body");
      el.scrollTop = el.scrollHeight;
    }
  },
  computed: {
    messages() {
      return this.$store.state.messages;
    },
    selectedConversation() {
      return this.$store.state.selectedConversation;
    },
    userAvatar() {
      return "/users/" + this.$store.state.user.avatar;
    }
  },
  updated() {
    this.scrollToBottom();
  },
  mounted() {}
};
</script>

<style>
</style>
