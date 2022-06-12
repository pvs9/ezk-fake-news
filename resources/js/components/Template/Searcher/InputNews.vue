<template>
  <div class="InputNews flex flex-col w-100">
    <input
      v-if="isLinkMode"
      type="text"
      placeholder="Введите ссылку на статью"
      class="input input-bordered w-full"
      v-model="search"
      :disabled="loading"
    />
    <input
      v-if="!isLinkMode"
      type="text"
      placeholder="Введите заголовок статьи"
      class="input input-bordered w-full"
      v-model="article.title"
      :disabled="loading"
    />
    <textarea
      v-if="!isLinkMode"
      v-model="article.text"
      class="textarea input-bordered w-full mt-3"
      placeholder="Введите текст статьи"
    ></textarea>
    <button
      @click="chooseInputMode()"
      v-if="!isBtnVisible"
      class="btn btn-primary btn-outline mx-auto mt-5 btn-wide visible"
    >
      {{ isLinkMode ? 'Текстом' : 'Ссылкой' }}
    </button>
    <button
      v-else
      @click="getArticleInfo"
      :class="{'loading': loading}"
      class="btn btn-accent mx-auto mt-5 btn-wide"
    >
      {{ loading ? '' : 'Определить' }}
    </button>
  </div>
</template>

<script>
import { useArticleStore } from "../../../store/Article";

export default {
  name: "InputNews",
  data() {
    return {
      search: "",
      loading: false,
      isLinkMode: false,
      article: {
        title: "",
        text: "",
      },
    };
  },
  computed: {
    isBtnVisible() {
      if (this.isLinkMode) return this.search;

      return this.article?.title && this.article?.text;
    },
  },
  methods: {
    getArticleInfo() {
      this.loading = true;
      const store = useArticleStore();

      store.getArticle(this.search).then((response) => {
        this.loading = false;
        console.log(response);
      });
    },
    chooseInputMode() {
      this.isLinkMode = !this.isLinkMode;
    },
  },
};
</script>

<style>
/* .InputNews {
}

.InputNews .input {
} */

.InputNews .btn {
  color: #fff;
}

/* .InputNews .btn.visible {
  opacity: 1;
  pointer-events: all;
} */
</style>