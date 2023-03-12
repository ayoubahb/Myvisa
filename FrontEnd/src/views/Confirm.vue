<template>
  <p class="text-center fw-3">{{ message }}</p>
  <dossierDetail :data="this.data" />
</template>

<script>
// @ is an alias to /src
// import axios from "axios";
import dossierDetail from "@/components/dossierDetail.vue";
import Cookies from "js-cookie";
import axios from "axios";
export default {
  name: "ConfirmCreation",
  components: {
    dossierDetail,
  },
  data() {
    return {
      message: "",
      data: {},
    };
  },
  async beforeRouteEnter(to, from, next) {
    try {
      const token = Cookies.get("token");
      const response = await axios.get(
        `http://localhost/myvisa/dossier/readsingle/${token}`
      );
      next((vm) => {
        vm.data = response.data;
      });
    } catch (error) {
      console.error(error);
    }
  },
  mounted() {
    this.message = this.$route.query.message; // retrieve the message parameter
  },
};
</script>
