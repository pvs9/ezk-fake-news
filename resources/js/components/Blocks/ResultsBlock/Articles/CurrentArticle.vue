<template>
  <div class="CurrentArticle flex flex-col pt-10 pb-10 bg-grey">
    <div class="divider">
      <h5 class="font-heading text-2xl">{{ article.article.title }}. {{ article.article.author }}</h5>
      <h5 class="font-heading mobile text-2xl">Проверяемая статья</h5>
    </div>
    <section class="relative pb-4 overflow-hidden">
      <div class="py-12">
        <div class="container px-4 mx-auto">
          <div class="flex flex-wrap justify-center -mx-4">
            <ResultCard
              v-if="article.authenticity >= 0"
              :value="article.authenticity"
              :title="`Подлинность`"
              :description="`Ориентировочная подлинность статьи`"
            />
            <ResultCard
              v-if="article.tonality >= 0"
              :value="article.tonality"
              :title="`Тональность`"
              :description="article.tonality_difference"
            />
            <!-- <ResultCard
              v-if="article.source_reliability >= 0"
              :value="article.source_reliability"
              :title="`Достоверность источника`"
              :description="`Lorem ipsum dolor sit amet consectetur adipisicing elit.`"
            /> -->
          </div>
        </div>
      </div>
    </section>
    <!-- <button
      @click="openPage(article.pdf_report)"
      class="btn mx-auto btn-outline btn-secondary"
    >отчёт PDF</button> -->
  </div>
</template>

<script>
// Components
import ResultCard from "../ResultCard.vue";
// Store
import { useArticleStore } from "../../../../store/Article";

export default {
  name: "CurrentArticle",
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