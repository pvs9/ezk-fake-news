<template>
  <div
    :class="{'visible': isNavbarVisible}"
    class="navbar bg-base-100"
  >
    <div class="navbar-start">
      <a class="btn btn-ghost normal-case text-xl">EZK - Fake news</a>
    </div>
    <div class="navbar-end">
      <a
        v-scroll-to="'#Searcher'"
        class="btn"
      >Проверить статью</a>
    </div>
  </div>
</template>

<script>
import { useArticleStore } from "../../store/Article";

export default {
  name: "Navbar",
  data() {
    return {
      windowTop: 0,
    };
  },
  mounted() {
    window.addEventListener("scroll", this.onScroll);
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.onScroll);
  },
  computed: {
    article() {
      const store = useArticleStore();
      return store.article || null;
    },
    isNavbarVisible() {
      return this.article && this.windowTop > 40;
    },
  },
  methods: {
    onScroll(e) {
      this.windowTop = window.top.scrollY || e.target.documentElement.scrollTop;
    },
  },
};
</script>

<style>
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 9;
  transform: translateY(-200%);
  transition: 0.5s ease-out;
}

.navbar.visible {
  transform: translateY(0);
}
</style>