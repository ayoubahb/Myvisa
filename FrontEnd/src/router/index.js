import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import TrackReserve from "../views/TrackReserve.vue";
import FormView from "../views/FormView.vue";
import reservation from "../views/Confirm.vue";

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
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
