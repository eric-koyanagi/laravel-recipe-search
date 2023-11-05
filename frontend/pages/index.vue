<template>
  <div class="container mx-auto p-8">
    <SearchRecipes @search="doSearch" />

    <span v-if="recipes">
      <span v-if="recipes?.data">
        <ul>
          <li class="text-cyan-800 font-bold underline" :key="id" v-for="{ id, name } in recipes.data">
            <nuxt-link :to="`/recipes/${id}`">
              {{ name }}
            </nuxt-link>
          </li>
        </ul>

        <ul class="mt-3 bt-1 flex flex-wrap items-center justify-center">
          <li class="text-cyan-800 px-2 font-bold underline" :key="page" v-for="page in recipes.last_page">
            <span v-if="page != recipes.current_page">
              <nuxt-link :to="{ name: 'index', params: { page, recipes }}">
                {{ page }}
              </nuxt-link>
            </span>
            <span v-else class="text-black no-underline">
              {{ page }}
            </span>
          </li>
        </ul>
      </span>
      <span v-else>No Recipes Found.</span>
    </span>

    <span v-else-if="error">Error: {{ error }}</span>

  </div>
</template>

<script setup>
import api from '~/api/repository'
import SearchRecipes from '~/components/SearchRecipes.vue'
import { ref } from 'vue';

const recipes = ref([]);
const error = ref("");

const doSearch = async(query, authors, keywords, ingredients) => {
  await useFetch(api.index('recipes'),
      {
        query: { s: query, authors, keywords, ingredients },
        onResponse({ request, response, options }) {
          recipes.value = response._data.results;
        },
      }
  )
};

</script>

