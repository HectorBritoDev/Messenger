<template>
  <b-row class="h-100">
    <b-col cols="8">
      <b-card
        no-body
        footer-bg-variant="light"
        footer-border-variant="dark"
        title="Conversación activa"
        class="h-100"
      >
        <b-card-body class="scroll" id="conversation-card-body">
          <message-conversation-component
            v-for="message in messages"
            :key="message.id"
            :written-by-me="message.written_by_me"
            :avatar="message.written_by_me ? userAvatar : contactAvatar"
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
      <b-img :src="contactAvatar" rounded="circle" width="60" height="60" alt="img" class="mt-1"></b-img>
      <p v-text="contactName"></p>
      <hr />

      <b-form-checkbox>Desactivar notificaciones</b-form-checkbox>
    </b-col>
  </b-row>
</template>

<script>
export default {
  props: {
    contactId: Number,
    contactName: String,
    contactAvatar: String,
    messages: Array
  },
  data() {
    return {
      userAvatar: "/users/" + Laravel.user.avatar, //Property set in app.blade.php
      newMessage: ""
    };
  },
  methods: {
    postMessage() {
      const params = {
        to_id: this.contactId,
        content: this.newMessage
      };
      axios
        .post("/api/message", params)
        .then(response => {
          console.log(response.data);
          this.newMessage = "";
          const message = response.data.message;
          message.written_by_me = true;
          this.$emit("messageCreated", message);
        })
        .catch(error => {
          alert(error);
          console.log(error);
        });
    },
    scrollToBottom() {
      const el = document.querySelector("#conversation-card-body");
      el.scrollTop = el.scrollHeight;
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
