<template>
  <RainbowCard>
    <RecipeSearchInput type="author" @update="updateValues"/>
    <RecipeSearchInput type="keyword" @update="updateValues"/>
    <RecipeSearchInput type="ingredient" @update="updateValues"/>

    <div class="my-2">
      <!--<input v-model.lazy="searchQuery" placeholder="Search Recipes" class="p-2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg">-->
      <button @click="sendSearchToParent" class="bg-stone-300 rounded p-2 text-sm shadow-sm hover:bg-cyan-600">Search</button>
    </div>
  </RainbowCard>
</template>

<script setup>
const emit = defineEmits(['search']);
let searchSettings = {};

const updateValues = (vals) => {
  searchSettings[vals.type] = { enabled: vals?.showInput, val: vals?.inputValue};
  console.log("all vals", searchSettings);
}

const sendSearchToParent = () => {
  emit('search', searchSettings);
};

</script>