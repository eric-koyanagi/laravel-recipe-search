<template>
  <div class="container mx-auto p-8">
    <span v-if="pending">Loading...</span>
    <span v-else-if="data">
      <div class="font-sm my-2 text-cyan-800">
        <nuxt-link :to="`/`">
          Back
        </nuxt-link>
      </div>

      <div class="bg-stone-400 p-4">
        <div class="text-lg text-cyan-800">{{ data.recipe.name }}</div>
        <div class="text-sm">{{ data.recipe.description }}</div>
        <div class="text-sm italic">By {{ data.recipe.author_email }}</div>

        <div class="m-3 bg-stone-300 p-5 rounded">
          <div class="text-lg">Ingredients:</div>
          <ul class="list-disc ml-3">
            <li :key="id" v-for="{ id, name, qty } in data.ingredients">
                {{qty}} {{ name }}
            </li>
          </ul>
        </div>

        <div class="m-3 bg-stone-300 p-5 rounded">
          <div class="text-lg">Steps:</div>
          <ol class="list-decimal ml-3">
            <li :key="id" v-for="{ id, description } in data.steps">
                {{ description }}
            </li>
          </ol>
        </div>
      </div>
    </span>

    <span v-else-if="error">Error: {{ error }}</span>

  </div>
</template>

<script setup>
import api from '~/api/repository'
const router = useRouter();
const currentRoute = router.currentRoute;

const { data, error, pending, refresh } = await useFetch(api.show('recipes', currentRoute._value.params.id),
    {
      onResponse({ request, response, options }) {

      },
    }
)
</script>

