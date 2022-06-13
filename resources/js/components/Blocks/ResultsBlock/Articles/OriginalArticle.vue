<template>
  <div
    v-if="article.original_source"
    class="CurrentArticle flex flex-col pt-20 pb-10 bg-white"
  >
    <div class="divider">
      <h5 class="font-heading text-2xl">Предполагаемый первоисточник: {{ article.original_source.title }}</h5>
      <h5 class="font-heading mobile text-2xl">Предполагаемый первоисточник</h5>
    </div>
    <section class="relative pb-4 overflow-hidden">
      <div class="py-12">
        <div class="container px-4 mx-auto">
          <div class="flex flex-wrap justify-center -mx-4">
            <ResultCard
              v-if="article.original_source.date"
              :value="`${article.original_source.date}`"
              :title="`Дата публикации`"
              :description="``"
            />
            <ResultCard
              v-if="article.original_source.similarity >= 0"
              :value="article.original_source.similarity"
              :title="`Схожесть с проверяемой статьей`"
              :description="``"
            />
            <ResultCard
              v-if="article.original_source.tonality >= 0"
              :value="article.original_source.tonality"
              :title="`Тональность первоисточника`"
              :description="``"
            />
          </div>
        </div>
      </div>
    </section>
    <button
      @click="openPage(article.original_source.link)"
      class="btn btn-openPage mx-auto btn-outline btn-primary"
    >Перейти на публикацию</button>
  </div>
  <div
    v-else
    class="CurrentArticle flex flex-col pt-10 pb-10 bg-white"
  >
    <div class="divider"></div>
    <div class="container px-4 mx-auto">
      <div class="alert shadow-lg">
        <div>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            class="stroke-info flex-shrink-0 w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            ></path>
          </svg>
          <span class="text-5xl font-medium">Первоисточник в WHITE-LIST'е не найден</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// Components
import ResultCard from "../ResultCard.vue";
// Store
import { useArticleStore } from "../../../../store/Article";

export default {
  name: "OriginalArticle",
  components: {
    ResultCard,
  },
  computed: {
    article() {
      const store = useArticleStore();
      return store.article || null;
    },
  },
  methods: {
    openPage(link) {
      window.open(link);
    },
  },
};
</script>

<style lang="scss">
@import "../../../../assets/scss/_variables.scss";

.CurrentArticle {
  & .btn-openPage {
    font-size: $base-size * 1.4;
  }
}
</style>