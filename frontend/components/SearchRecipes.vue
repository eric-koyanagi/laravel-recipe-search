<template>
  <div class="bg-stone-500 p-3 my-3">
    <div>
      <input id="authors" v-model="authors" type="checkbox" checked>
      <label for="authors">Search Authors</label>
    </div>

    <div>
      <input id="keywords" v-model="keywords" type="checkbox">
      <label for="keywords">Search Keywords</label>
    </div>

    <div>
      <input id="ingredients" v-model="ingredients" type="checkbox">
      <label for="ingredients">Search Ingredients</label>
    </div>

    <div class="my-2">
      <input v-model.lazy="searchQuery" placeholder="Search Recipes">
      <button @click="sendSearchToParent" class="bg-stone-300 ml-1 rounded px-2">Search</button>
    </div>
  </div>
</template>

<script setup>

const emit = defineEmits(['search']);
const searchQuery = ref('');
const authors = ref('');
const keywords = ref('');
const ingredients = ref('');

const sendSearchToParent = () => {
  emit('search', searchQuery, authors, keywords, ingredients);
};

</script>