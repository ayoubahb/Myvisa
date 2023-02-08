<template>
  <dossierDetail :token="token" />
</template>

<script>
// @ is an alias to /src

import dossierDetail from "@/components/dossierDetail.vue";

export default {
  name: "ConfirmCreation",
  components: {
    dossierDetail,
  },
  data() {
    return {
      token: "",
    };
  },
  created() {
    const tokenSession = sessionStorage.getItem("responseData");
    if (tokenSession) {
      this.token = tokenSession;
    }
  },
};
</script>
