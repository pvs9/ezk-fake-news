<template>
  <div class="SearcherTemplate min-h-screen">
    <MoscowCityHackLogo class="SearcherTemplate__MoscowCityHackLogo" />
    <div class="SearcherTemplate__content p-2">
      <h1 class="text-5xl text-white text-center">
        EZK
      </h1>
      <h1 class="text-2xl mt-1 mb-10 text-white text-center">
        Сервис проверки поддельных новостей.
      </h1>
      <InputNews />
    </div>
  </div>
</template>

<script>
// Icons
import MoscowCityHackLogo from "../../Icons/MoscowCityHackLogo.vue";
// Components
import InputNews from "./InputNews.vue";

export default {
  name: "Searcher",
  components: {
    MoscowCityHackLogo,
    InputNews,
  },
};
</script>

<style>
.SearcherTemplate {
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.SearcherTemplate__content {
  position: relative;
  max-width: 700px;
  width: 100%;
  z-index: 1;
}

.SearcherTemplate__MoscowCityHackLogo {
  position: absolute;
  left: 20px;
  top: 20px;
  z-index: 1;
  width: 173px;
  height: 61px;
}

.SearcherTemplate::after {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;

  background: rgb(80, 47, 55);
  background: linear-gradient(
    315deg,
    rgba(80, 47, 55, 1) 0%,
    rgba(46, 74, 76, 1) 100%
  );
  background-size: 200% 200%;
  animation: background-waving 4s infinite ease-in-out;
  z-index: 0;
}

@keyframes background-waving {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 50% 75%;
  }
  100% {
    background-position: 0% 50%;
  }
}
</style>