<template>
  <div class="flex flex-col h-screen justify-between">
    <header class="bg-slate-800 shadow-lg">
      <div class="container mx-auto p-3">
        <h1 class="font-bold text-gray-100 text-lg">Recipe Search 3000</h1>
        <h2 cass="text-stone-100 text-md font-style-italics">Better than Recipe Search 2999</h2>
      </div>
    </header>
    <div class="mb-auto">
      <slot />
    </div>
    <footer class="h-10">
      <div class="text-center bg-blue-600 p-4 text-sm shadow-lg">
        &copy; Major Company, LLC.
      </div>
    </footer>
  </div>
</template>

<script setup>
  useHead({
    bodyAttrs: {
      class: 'from-blue-600 to-purple-500 bg-gradient-to-r'
    }
  });
</script>