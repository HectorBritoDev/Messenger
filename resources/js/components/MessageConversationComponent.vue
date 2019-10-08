<template>
  <b-media :right-align="writtenByMe" vertical-align="center" class="mb-2">
    <b-img :src="avatar" rounded="circle" slot="aside" width="48" height="48" alt="img"></b-img>
    <b-card>
      <slot></slot>
    </b-card>
  </b-media>
</template>

<script>
export default {
  props: { writtenByMe: Boolean, avatar: String },
  data() {
    return {};
  }
};
</script>

<style>
</style>
