<template>
  <div>
    <b-form class="my-3 mx-2">
      <b-form-input type="text" placeholder="Buscar contacto" class="text-center"></b-form-input>
    </b-form>
    <b-list-group>
      <contact-component variant="dark"></contact-component>
      <contact-component variant></contact-component>
      <contact-component variant="secondary"></contact-component>
    </b-list-group>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
