<template>
  <Searcher id="Searcher" />
  <ArticleDetails
    id="ArticleDetails"
    v-if="isAnimate || article"
  />
</template>

<script>
// Components
import Searcher from "../components/Template/Searcher/index.vue";
import ArticleDetails from "../components/Template/ArticleDetails/index.vue";
// Store
import { useArticleStore } from "../store/Article";

const animationDuration = 700;

export default {
  name: "Home",
  components: {
    Searcher,
    ArticleDetails,
  },
  data() {
    return {
      isAnimate: false,
    };
  },
  computed: {
    article() {
      const store = useArticleStore();
      return store.article || null;
    },
  },
  watch: {
    article: {
      handler: function (e) {
        if (!e) {
          this.isAnimate = true;
          this.$scrollTo("#Searcher", animationDuration);
          setTimeout(() => {
            this.isAnimate = false;
          }, animationDuration);

          return;
        }

        this.$nextTick(() => {
          return this.$scrollTo("#ArticleDetails", animationDuration);
        });
      },
      deep: true,
    },
  },
};
</script>
