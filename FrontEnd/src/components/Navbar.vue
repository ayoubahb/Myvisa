<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top text-center">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="../assets/armoiries.png" alt="logo" style="width: 50px" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item my-sm-2">
            <router-link to="/">Home</router-link>
          </li>
          <li class="nav-item my-sm-2">
            <router-link to="/Form">Reservation</router-link>
          </li>
          <li class="nav-item my-sm-2">
            <router-link to="/track">Track</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavBar",
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
nav {
  background-color: white;
}
nav a {
  font-weight: bold;
  font-size: 20px;
  color: #2c3e50;
  text-decoration: none;
  margin: 0 20px;
}

nav a:hover {
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
@media (max-width: 576px) {
  ul li {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
}
</style>
