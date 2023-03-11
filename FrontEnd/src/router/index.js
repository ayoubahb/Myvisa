import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import TrackReserve from "../views/TrackReserve.vue";
import FormView from "../views/FormView.vue";
import reservation from "../views/Confirm.vue";
import Update from "../views/UpdateView.vue";
// import axios from "axios";
// import Cookies from "js-cookie";

import Cookies from "js-cookie";

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/track",
    name: "Track",
    component: TrackReserve,
  },
  {
    path: "/form",
    name: "form",
    component: FormView,
  },
  {
    path: "/reservationPage",
    name: "reservationPage",
    component: reservation,
    meta: { requiresAuth: true },
  },
  {
    path: "/edit",
    name: "update",
    component: Update,
    meta: { requiresAuth: true },
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

// Define the checkAuthentication function
function checkAuthentication(to, from, next) {
  // Check if the user is authenticated
  const isAuthenticated = !!getTokenFromCookies(); // Change this line to check if a user ID exists in cookies

  if (to.meta.requiresAuth && !isAuthenticated) {
    // If the route requires authentication and the user is not authenticated, redirect to the login page
    next("/");
  } else if (to.name === "Track" && isAuthenticated) {
    // If the user is trying to access the Track route and is already authenticated, redirect to the reservation page
    next({ name: "reservationPage" });
  } else {
    // Otherwise, allow the user to access the route
    next();
  }
}
router.beforeEach(checkAuthentication);

function getTokenFromCookies() {
  // Get the user ID from cookies
  const token = Cookies.get("token");
  return token;
}

export default router;
