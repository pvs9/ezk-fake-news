import {createWebHistory, createRouter} from "vue-router";
import Home from "../pages/Home";
import NotFound from "../pages/NotFound";

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        // path: "*",
        path: "/:catchAll(.*)",
        name: "not-found",
        component: NotFound
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
