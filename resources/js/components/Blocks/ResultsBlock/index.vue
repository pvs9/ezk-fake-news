<template>
  <div class="ArticleDetailsTemplate">
    <div class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
          <h2 class="text-base results__about text-indigo-600 font-semibold tracking-wide uppercase">
            Результаты проверки
          </h2>
          <p class="mt-2 results__title text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            Источнику можно доверять на <span :style="`color: ${getColorByValue(article.overall)}`">
              {{ article.overall }}%
            </span>
          </p>
          <p class="mt-4 results__description max-w-5xl text-xl text-gray-500 lg:mx-auto">
            И ведь это не просто утверждение, потому что <br />
            сейчас мы вам расскажем откуда взялись эти выводы!
          </p>
        </div>
      </div>
    </div>
    <CurrentArticle />
    <OriginalArticle />
  </div>
</template>

<script>
// Helpers
import { getColorByValue } from "../../../helpers/Formatter";
// Store
import { useArticleStore } from "../../../store/Article";
// Components
import CurrentArticle from "./Articles/CurrentArticle.vue";
import OriginalArticle from "./Articles/OriginalArticle.vue";

export default {
  name: "ArticleDetails",
  components: {
    CurrentArticle,
    OriginalArticle,
  },
  methods: {
    getColorByValue(value) {
      return getColorByValue(value);
    },
  },
  computed: {
    article() {
      const store = useArticleStore();
      return store.article || null;
    },
  },
};
</script>

<style lang="scss">
@import "../../../assets/scss/_variables.scss";

.results {
  &__about {
    font-size: $base-size * 1.6;
    line-height: 1.4;
  }

  &__title {
    font-size: $base-size * 3.6;
    line-height: 1.4;
  }

  &__description {
    font-size: $base-size * 2;
    line-height: 1.4;
  }
}

.divider {
  & h5 {
    max-width: 500px;
    width: 100%;
    text-align: center;
    white-space: normal;
    font-size: $base-size * 1.5;
  }

  & .mobile {
    display: none;
  }

  @media screen and (max-width: 960px) {
    & .font-heading {
      display: none;
    }
    & .mobile {
      display: block;
    }
  }
}
</style>