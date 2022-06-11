<template>
  <div class="InputNews flex flex-col w-100">
    <input
      type="text"
      placeholder="Ссылка на статью"
      class="input input-bordered w-full"
      v-model="search"
      :disabled="loading"
    />
    <button
      @click="getArticleInfo"
      :class="{'loading': loading, 'visible': isBtnVisible}"
      class="btn btn-primary mx-auto mt-5 btn-wide"
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
    };
  },
  computed: {
    isBtnVisible() {
      return this.search && this.search.length > 0;
    },
  },
  // created() {
  //   this.getArticleInfo();
  // },
  methods: {
    getArticleInfo() {
      this.loading = true;
      const store = useArticleStore();

      store.getArticle(this.search).then((response) => {
        this.loading = false;
        console.log(response);
      });
    },
  },
};
</script>

<style>
.InputNews {
}

.InputNews .input {
}

.InputNews .btn {
  opacity: 0;
  pointer-events: none;
}

.InputNews .btn.visible {
  opacity: 1;
  pointer-events: all;
}
</style>