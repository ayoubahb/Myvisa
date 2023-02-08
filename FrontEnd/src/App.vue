<template>
  <NavBar />
  <router-view />
</template>
<script>
// @ is an alias to /src
import NavBar from "@/components/Navbar.vue";

export default {
  name: "HomeView",
  components: {
    NavBar,
  },
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  color: #2c3e50;
}
</style>
