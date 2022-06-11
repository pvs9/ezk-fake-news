<template>
  <div class="CurrentArticle flex flex-col pt-10 bg-white">
    <div class="divider">
      <h5 class="font-heading text-xl">{{ article.article.title }}. {{ article.article.author }}</h5>
    </div>
    <section class="relative pb-4 overflow-hidden">
      <div class="py-12">
        <div class="container px-4 mx-auto">
          <div class="flex flex-wrap justify-center -mx-4">
            <ResultCard
              v-if="article.authenticity"
              :value="article.authenticity"
              :title="`Подлинность`"
              :description="`Lorem ipsum dolor sit amet consectetur adipisicing elit.`"
            />
            <ResultCard
              v-if="article.tonality"
              :value="article.tonality"
              :title="`Тональность`"
              :description="`Lorem ipsum dolor sit amet consectetur adipisicing elit.`"
            />
            <ResultCard
              v-if="article.source_reliability"
              :value="article.source_reliability"
              :title="`Достоверность источника`"
              :description="`Lorem ipsum dolor sit amet consectetur adipisicing elit.`"
            />
          </div>
        </div>
      </div>
    </section>
    <button
      @click="$to(article.pdf_report)"
      class="btn mx-auto btn-outline btn-secondary"
    >отчёт PDF</button>
  </div>
</template>

<script>
// Components
import ResultCard from "./ResultCard.vue";
// Store
import { useArticleStore } from "../../../store/Article";

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
};
</script>