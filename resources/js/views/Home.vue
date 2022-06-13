<template>
  <div class="HomePage">
    <SearchBlock id="SearchBlock" />
    <ResultsBlock
      id="ResultsBlock"
      v-if="article"
    />
  </div>
</template>

<script>
// Page blocks
import SearchBlock from "../components/Blocks/SearchBlock/index.vue";
import ResultsBlock from "../components/Blocks/ResultsBlock/index.vue";

// Store
import { useArticleStore } from "../store/Article";

const animationDuration = 700;

export default {
  name: "Home",
  components: {
    SearchBlock,
    ResultsBlock,
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
          this.$scrollTo("#SearchBlock", animationDuration);
          setTimeout(() => {
            this.isAnimate = false;
          }, animationDuration);
          return;
        }

        this.$nextTick(() => {
          return this.$scrollTo("#ResultsBlock", animationDuration);
        });
      },
      deep: true,
    },
  },
};
</script>