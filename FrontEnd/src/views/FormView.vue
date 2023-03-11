<template>
  <FormReserve @submit-form="craeteDossier" />
</template>

<script>
// @ is an alias to /src
import FormReserve from "@/components/FormReserve.vue";
import axios from "axios";
import Cookies from "js-cookie";
export default {
  name: "FORM",
  components: {
    FormReserve,
  },
  methods: {
    craeteDossier(formData) {
      axios
        .post("http://localhost/myvisa/dossier/create", formData, {
          withCredentials: false,
        })
        .then((response) => {
          if (response.status === 200) {
            Cookies.set("token", response.data.code, {
              secure: true,
              sameSite: "strict",
            });
            window.location.href = "/reservationPage";
          }
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
