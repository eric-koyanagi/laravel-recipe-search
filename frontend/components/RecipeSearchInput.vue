<template>
  <div>
    <input :id="type"  class="h-3 w-4 rounded text-purple-600 bg-gray-100" v-model="inputEnabled" type="checkbox" value="">
    <label :for="type" class="w-full py-2 ms-1 text-sm">Search {{capitalized(type)}}</label>

    <Transition name="fade">
      <div v-show="inputEnabled" class="">
          <input id="val" class="p-2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" v-model="inputValue" @change="emitValues" :placeholder="type"/>
      </div>
    </Transition>


  </div>
</template>
<script setup>
const capitalized = (str) => str?.charAt(0).toUpperCase() + str?.slice(1);

const inputEnabled = ref(true);
const inputValue = ref('');
const emit = defineEmits(['update']);

const props = defineProps({
  type: String
});

const emitValues = () => {
  emit('update', {
    type: props.type,
    showInput: inputEnabled.value,
    inputValue: inputValue.value,
  });
};

onMounted(() => {
  emitValues();
});

onUpdated(() => {
  emitValues();
});

</script>
<style scoped>
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.5s ease;
  }

  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
</style>