<template>
  <div class="container">
    <h3 class="text-center my-5">
      Enter your reservation token to retrieve your booking details
    </h3>
    <form
      @submit.prevent="submitForm"
      class="d-flex flex-column align-items-center"
    >
      <div class="row row justify-content-center w-100">
        <div class="mb-3 col-5 text-center">
          <label class="form-label">TOKEN</label>
          <input type="text" class="form-control" v-model="data.token" />
          <p class="valide my-1">{{ valide }}</p>
        </div>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script>
import Cookies from "js-cookie";
import axios from "axios";

export default {
  data() {
    return {
      data: {
        token: "",
      },
      valide: "",
    };
  },
  methods: {
    submitForm() {
      if (!this.data.token) {
        alert("Please enter a valid token.");
        return;
      }
      axios
        .post(`http://localhost/myvisa/dossier/tokenValid`, this.data, {
          withCredentials: false,
        })
        .then((response) => {
          if (response.data) {
            Cookies.set("token", this.data.token, {
              secure: true,
              sameSite: "strict",
            });
            this.$router.push({ path: "/reservationPage" });
          } else {
            this.valide = "Invalide token";
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
button {
  outline: 0;
  border: 0;
  padding: 10px;
  border-radius: 5px;
}
button[type="submit"] {
  background-color: #2c3e50;
  color: white;
}
.valide {
  color: red;
  height: 20px;
}
</style>
