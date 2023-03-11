<template>
  <UpdateForm @submit-form="UpdateDossier" />
</template>

<script>
// @ is an alias to /src
import UpdateForm from "@/components/UpdateForm.vue";
import axios from "axios";
import Cookies from "js-cookie";

export default {
  name: "FORM",
  components: {
    UpdateForm,
  },

  data() {
    return {
      message: "", // add a new data property to hold the message
    };
  },
  methods: {
    UpdateDossier(formData) {
      formData.token = Cookies.get("token");

      axios
        .put("http://localhost/myvisa/dossier/update", formData, {
          withCredentials: false,
        })
        .then((response) => {
          const message = response.data.message; // assign the message to a variable
          this.$router.push({
            name: "reservationPage",
            query: { message }, // pass the message as a query parameter
          });
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
