<template>
  <b-form class="my-3 mx-2" @submit.prevent="searchConversation">
    <b-form-input
      v-model="querySearch"
      type="text"
      placeholder="Buscar contacto"
      class="text-center"
    ></b-form-input>
  </b-form>
</template>

<script>
export default {
  computed: {
    querySearch: {
      get() {
        return this.$store.state.querySearch;
      },
      set(value) {
        this.$store.commit("updateQuerySearch", value);
      }
    }
  }
};
</script>

<style>
</style>
