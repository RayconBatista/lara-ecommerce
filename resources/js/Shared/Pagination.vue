<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <nav
    class="border-t border-gray-200 px-4 flex items-center justify-between sm:px-0"
  >
    <div class="-mt-px w-0 flex-1 flex">
      <Link
        v-if="data.prev_page_url"
        :href="data.prev_page_url"
        class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300"
      >
        <!-- Heroicon name: solid/arrow-narrow-left -->
        <svg
          class="mr-3 h-5 w-5 text-gray-400"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          aria-hidden="true">
          <path
            fill-rule="evenodd"
            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
            clip-rule="evenodd" />
        </svg>
        Anterior
      </Link>
    </div>
    <div class="hidden md:-mt-px md:flex">
      <Link
        v-for="link in cleanLinks"
        :key="link.label"
        :href="link.url"
        :class="{ 'border-indigo-500 text-indigo-600': link.active }"
        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"
      >
        {{ link.label }}
      </Link>
    </div>
    <div class="-mt-px w-0 flex-1 flex justify-end">
      <Link
        v-if="data.next_page_url"
        :href="data.next_page_url"
        class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300"
      >
        Próximo
        <!-- Heroicon name: solid/arrow-narrow-right -->
        <svg
          class="ml-3 h-5 w-5 text-gray-400"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          aria-hidden="true"
        >
          <path
            fill-rule="evenodd"
            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
            clip-rule="evenodd"
          />
        </svg>
      </Link>
    </div>
  </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
  name: "Pagination",
  props: {
    data: Object,
  },
  components: {
    Link
  },
  computed: {
    cleanLinks() {
      const cleanLinks = [...this.data.links];
      cleanLinks.shift();
      cleanLinks.pop();
      return cleanLinks;
    },
  },
};
</script>