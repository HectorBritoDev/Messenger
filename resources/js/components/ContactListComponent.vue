<template>
  <div>
    <b-form class="my-3 mx-2">
      <b-form-input type="text" placeholder="Buscar contacto" class="text-center"></b-form-input>
    </b-form>
    <b-list-group>
      <contact-component
        v-for="conversation in conversations"
        :key="conversation.id"
        :conversation="conversation"
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
    return {
      conversations: []
    };
  },
  methods: {
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
    }
  },
  mounted() {
    this.getConversations();
  }
};
</script>

<style>
</style>
