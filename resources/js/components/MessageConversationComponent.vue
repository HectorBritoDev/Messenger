<template>
  <b-media :right-align="writtenByMe" vertical-align="center" class="mb-2">
    <b-img rounded="circle" slot="aside" blank width="48" height="48" blank-color="#ccc" alt="img"></b-img>
    <b-card>
      <slot></slot>
    </b-card>
  </b-media>
</template>

<script>
export default {
  props: { writtenByMe: Boolean },
  data() {
    return {};
  }
};
</script>

<style>
</style>
