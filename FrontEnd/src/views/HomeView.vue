<template>
  <div>
    <Landing
      header="Morocco"
      textParaOne="Easily navigate the visa application process for"
      textParaTwo="and start exploring its rich culture and vibrant cities today!"
    />
  </div>
</template>

<script>
// @ is an alias to /src
import Landing from "@/components/LandingPage.vue";

export default {
  name: "HomeView",
  components: {
    Landing,
  },
};
sessionStorage.removeItem("token");
</script>
