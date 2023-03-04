<template>
  <section>
    <div
      class="container d-flex justify-content-center align-items-center flex-column h-100"
    >
      <p class="text-center fw-bold">
        Easily navigate the visa application process for
      </p>
      <h1>{{ header }}</h1>
      <p class="text-center fw-bold">
        and start exploring its rich culture and vibrant cities today!
      </p>
      <a href="/Form">
        <button class="p-3 border-0 outline-0 text-white rounded-5 fw-bold">
          GET YOUR VISA
        </button>
      </a>
    </div>
  </section>
</template>

<script>
export default {
  name: "LandingPage",
  props: {
    header: String,
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
section {
  background-image: url(../assets/bg.jpg);
  height: 100vh;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  backdrop-filter: blur(100px);
  color: white;
  text-align: center;
}
h1 {
  font-size: 500%;
}
p {
  font-size: 200%;
}
button {
  background-color: #2c3e50;
}
</style>
