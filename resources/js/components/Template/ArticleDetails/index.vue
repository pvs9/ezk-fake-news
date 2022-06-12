<template>
  <div class="ArticleDetailsTemplate">
    <div class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
          <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">
            Результаты проверки
          </h2>
          <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            Источнику можно доверять на <span :style="`color: ${ParseValueToColor(article.authenticity)}`">
              {{ article.authenticity }}%
            </span>
          </p>
          <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
            Мы проверили статью по 146 параметрам. Сейчас всё расскажем и поделимся подробным отчётом!
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
import { ParseValueToColor } from "../../../helpers/Formatter";
// Store
import { useArticleStore } from "../../../store/Article";
// Components
import CurrentArticle from "./CurrentArticle.vue";
import OriginalArticle from "./OriginalArticle.vue";

export default {
  name: "ArticleDetails",
  components: {
    CurrentArticle,
    OriginalArticle,
  },
  methods: {
    ParseValueToColor(value) {
      return ParseValueToColor(value);
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

<style>
</style>