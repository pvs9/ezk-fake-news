<template>
  <div class="CurrentArticle flex flex-col pt-10 pb-10 bg-white">
    <div class="divider">
      <h5 class="font-heading text-xl">Предполагаемый первоисточник. {{ article.original_source.title }}</h5>
    </div>
    <section class="relative pb-4 overflow-hidden">
      <div class="py-12">
        <div class="container px-4 mx-auto">
          <div class="flex flex-wrap justify-center -mx-4">
            <ResultCard
              v-if="article.original_source.date"
              :value="`${article.original_source.date}`"
              :title="`Дата публикации`"
              :description="`Lorem ipsum dolor sit amet consectetur adipisicing elit.`"
            />
            <ResultCard
              v-if="article.original_source.similarity_percent"
              :value="article.original_source.similarity_percent"
              :title="`Схожесть с первоисточником`"
              :description="`Lorem ipsum dolor sit amet consectetur adipisicing elit.`"
            />
            <ResultCard
              v-if="article.original_source.tonality"
              :value="article.original_source.tonality"
              :title="`Тональность первоисточника`"
              :description="`Lorem ipsum dolor sit amet consectetur adipisicing elit.`"
            />
          </div>
        </div>
      </div>
    </section>
    <button
      @click="$to(article.original_source.link)"
      class="btn mx-auto btn-outline btn-primary"
    >Перейти на публикацию</button>
  </div>
</template>

<script>
// Components
import ResultCard from "./ResultCard.vue";
// Store
import { useArticleStore } from "../../../store/Article";

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
};
</script>