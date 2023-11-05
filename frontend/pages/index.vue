<template>
  <div class="container mx-auto p-8">
    <span v-if="pending">Loading...</span>

    <span v-else-if="data">
      <ul>
        <li class="text-cyan-800 font-bold underline" :key="id" v-for="{ id, name } in data.results.data">
          <nuxt-link :to="`/recipes/${id}`">
            {{ name }}
          </nuxt-link>
        </li>
      </ul>
    </span>

    <span v-else-if="error">Error: {{ error }}</span>

  </div>
</template>

<script setup>
import api from '~/api/repository'
const { data, error, pending, refresh } = await useFetch(api.index('recipes'),
    {
      query: { search: 'test' },
      onResponse({ request, response, options }) {

      },
    }
)
</script>

