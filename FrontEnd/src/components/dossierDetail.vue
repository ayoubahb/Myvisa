<template>
  <div class="container my-5 p-5">
    <p class="">Hi</p>
    <p class="">
      Your reservation token is : <b>{{ token }}</b>
    </p>
    <p class="">status of your reservation</p>
  </div>
</template>

<script>
export default {
  name: "dossierPage",
  props: {
    token: String,
  },
};
</script>

<style scoped>
div {
  background-color: #2c3e50;
  color: white;
}
p {
  margin-left: 18%;
}
</style>
