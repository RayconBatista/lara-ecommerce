<template>
  <div v-if="openShopCart" class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
  <!--
    Background backdrop, show/hide based on slide-over state.

    Entering: "ease-in-out duration-500"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in-out duration-500"
      From: "opacity-100"
      To: "opacity-0"
  -->
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="absolute top-8 right-10 z-99">
      <toast :message="$page.props.flash.message" />
    </div>
    <div class="fixed inset-0 overflow-hidden">
      <div class="absolute inset-0 overflow-hidden">
        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
          <!--
            Slide-over panel, show/hide based on slide-over state.

            Entering: "transform transition ease-in-out duration-500 sm:duration-700"
              From: "translate-x-full"
              To: "translate-x-0"
            Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
              From: "translate-x-0"
              To: "translate-x-full"
          -->
          <div class="pointer-events-auto w-screen max-w-md">
            <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
              <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
                <div class="flex items-start justify-between">
                  <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping cart</h2>
                  <div class="ml-3 flex h-7 items-center">
                    <Link :href="route('products.index')" class="-m-2 p-2 text-gray-400 hover:text-gray-500" >
                      <span class="sr-only">Close panel</span>
                      <!-- Heroicon name: outline/x -->
                      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </Link>
                  </div>
                </div>

                <div class="mt-8">
                  <div class="flow-root">
                    <ul role="list" class="-my-6 divide-y divide-gray-200">
                      <li v-for="product in $page.props.cart.cart" :key="product.id" class="flex py-6">
                        <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                          <img src="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg" alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." class="h-full w-full object-cover object-center">
                        </div>

                        <div class="ml-4 flex flex-1 flex-col">
                          <div>
                            <div class="flex justify-between text-base font-medium text-gray-900">
                              <h3>
                                <a href="#"> {{ product.name }} </a>
                              </h3>
                              <p class="ml-4"> {{ 'R$' + product.price }}</p>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">{{ product.category.name }}</p>
                          </div>
                          <div class="flex flex-1 items-end justify-between text-sm">
                            <p class="text-gray-500">Qty {{ product.amount }}</p>

                            <div class="flex">
                              <Link :href="(route('cartDestroy', {id: product.id}))" class="font-medium text-indigo-600 hover:text-indigo-500">Remover</Link>
                            </div>
                          </div>
                        </div>
                      </li>
                      <!-- More products... -->
                    </ul>
                  </div>
                </div>
              </div>

              <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                <div class="flex justify-between text-base font-medium text-gray-900">
                  <p>Subtotal</p>
                  <p>$ 0</p>
                </div>
                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                <div class="mt-6">
                  <form @submit.prevent="submit">
                    <input type="submit" value="Checkout" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700"  />
                    <!-- <a href="#" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a> -->
                  </form>
                </div>
                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                  <p>
                    or <Link :href="route('products.index')" class="font-medium text-indigo-600 hover:text-indigo-500">Continue Shopping<span aria-hidden="true"> &rarr;</span></Link>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
import Toast from '@/components/Toast.vue';
export default {
  components: {
    Link,
    Toast
  },
  data() {
    return {
      form: this.$inertia.form({})
    }
  },
  props: { 
    openShopCart: {
      type: Boolean,
      required: true
    },
    closeShopCart: {
      type: Function,
      required: false
    },
  },
  computed: {
    // totalItems() {
    //   let total = [];

    //   Object.entries(this.$page.props.cart.cart).forEach(([key, val]) => total.push(val.price));

    //   return total.reduce((total, num) => total + num, 0);
    // },
  },
  methods: {
    submit() {
      this.form.post(this.route('cartFinish'), { onSuccess: () => form.reset() })
    },
    // cartDestroy(productId) {
    //     if (confirm('Are you sure you want to delete this contact?')) {
    //       this.$inertia.post(route('cartDestroy', productId));
    //     }
    // }
  }
}
</script>