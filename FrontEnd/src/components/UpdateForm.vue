<!-- eslint-disable vue/no-mutating-props -->
<template>
  <div class="container">
    <h3 class="text-center my-5">Please fill out the form below to continue</h3>
    <form @submit.prevent="handleSubmit">
      <div class="row">
        <div class="mb-3 col-6">
          <label class="form-label">First Name</label>
          <input
            type="text"
            class="form-control"
            v-model="formData.first_name"
          />
        </div>
        <div class="mb-3 col-6">
          <label class="form-label">Last Name</label>
          <input
            type="text"
            class="form-control"
            v-model="formData.last_name"
          />
        </div>
      </div>
      <div class="row">
        <div class="mb-3 col-6">
          <label class="form-label">Date of birth</label>
          <input type="date" class="form-control" v-model="formData.birthday" />
        </div>
        <div class="mb-3 col-6">
          <label class="form-label">Nationality</label>
          <input
            type="text"
            class="form-control"
            v-model="formData.nationalite"
          />
        </div>
      </div>
      <div class="row">
        <div class="mb-3 col-6">
          <label class="form-label">Familial Situation</label>
          <select class="form-select" v-model="formData.situation">
            <option value>Select an option</option>
            <option value="single">Single</option>
            <option value="married">Married</option>
            <option value="divorced">Divorced</option>
            <option value="widowed">Widowed</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="mb-3 col-6">
          <label class="form-label">Adresse</label>
          <input type="text" class="form-control" v-model="formData.adresse" />
        </div>
      </div>

      <div class="row">
        <div class="mb-3 col">
          <label class="form-label">Visa type</label>
          <select class="form-select" v-model="formData.type_visa">
            <option value>Select an option</option>
            <option value="tourist">Tourist visa</option>
            <option value="work">Work visa</option>
            <option value="student">Student visa</option>
            <option value="residence">Residence visa</option>
            <option value="artist_athlete">Artist/Athlete visa</option>
            <option value="diplomatic">Diplomatic visa</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="mb-3 col-6">
          <label class="form-label">Departure date</label>
          <input
            type="date"
            class="form-control"
            v-model="formData.date_depart"
          />
        </div>
        <div class="mb-3 col-6">
          <label class="form-label">Arrival date</label>
          <input
            type="date"
            class="form-control"
            v-model="formData.date_arriver"
          />
        </div>
      </div>

      <div class="row">
        <div class="mb-3 col-6">
          <label class="form-label">Type of document</label>
          <select class="form-select" v-model="formData.type_document">
            <option value>Select an option</option>
            <option value="PASSPORT">Passport</option>
            <option value="CIN">CIN</option>
          </select>
        </div>
        <div class="mb-3 col-6">
          <label class="form-label">N° document</label>
          <input
            type="text"
            class="form-control"
            name="num_document"
            v-model="formData.num_document"
          />
        </div>
      </div>
      <p class="mb-4">Please select an available time</p>
      <!-- calendar component -->
      <CalendarComp
        @time-selected="handleTimeSelected"
        :selected-time="selectedTime"
        :selected-date="selectedDate"
      />
      <div class="row">
        <div class="mb-3 col-6">
          <a href="/reservationPage">
            <button type="button" class="w-100">Cancle</button>
          </a>
        </div>
        <div class="mb-3 col-6">
          <button type="submit" class="w-100">Update</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
// import axios from "axios";
import CalendarComp from "@/components/CalendarComp.vue";
import axios from "axios";
import Cookies from "js-cookie";

export default {
  name: "FormReserve",
  components: {
    CalendarComp,
  },
  data() {
    return {
      formData: {
        first_name: "",
        last_name: "",
        birthday: "",
        nationalite: "",
        situation: "",
        adresse: "",
        type_visa: "",
        date_depart: "",
        date_arriver: "",
        num_document: "",
        type_document: "",
        token: "",
        time: null,
        date: null,
      },
      selectedTime: null,
      selectedDate: null,
    };
  },
  created() {
    this.fetchUserData();
  },
  methods: {
    fetchUserData() {
      const token = Cookies.get("token");
      axios
        .get(`http://localhost/myvisa/dossier/readSingle/${token}`)
        .then((response) => {
          this.formData.first_name = response.data.first_name;
          this.formData.last_name = response.data.last_name;
          this.formData.birthday = response.data.birthday;
          this.formData.nationalite = response.data.nationalite;
          this.formData.situation = response.data.situation;
          this.formData.adresse = response.data.adresse;
          this.formData.type_visa = response.data.type_visa;
          this.formData.date_depart = response.data.date_depart;
          this.formData.date_arriver = response.data.date_arriver;
          this.formData.num_document = response.data.num_document;
          this.formData.type_document = response.data.type_document;
          this.formData.time = response.data.time;
          this.formData.date = response.data.date;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    handleTimeSelected(data) {
      this.selectedTime = data.time;
      this.formData.time = data.time;
      this.selectedDate = data.day;
      this.formData.date = data.day;
    },
    handleSubmit() {
      this.$emit("submit-form", this.formData);
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
</style>
