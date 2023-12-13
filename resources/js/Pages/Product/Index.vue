
<script>
import Header from '../../components/dashboard/Header.vue';
import { Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue';
import axios from 'axios';
export default{
    props:{
        category:Object,
        product:Object,
    },
    setup(){
        const number_format=(number, decimals, decPoint, thousandsSep) =>{
            decimals = decimals || 0;
            number = parseFloat(number);

            if (!decPoint || !thousandsSep) {
                decPoint = '.';
                thousandsSep = ',';
            }

            var roundedNumber = Math.round(number * Math.pow(10, decimals)) / Math.pow(10, decimals);
            var formattedNumber = roundedNumber.toLocaleString(undefined, { minimumFractionDigits: decimals, maximumFractionDigits: decimals });

            return formattedNumber;
        }

        let listCart = ref([])
        const getCart = () => {
            axios.get('/api/cart/get')
                .then(response => {
                    listCart.value = response.data.data;
                    console.log(listCart.value)
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }


        const addCart = (id, price) => {
            axios.post('/api/cart/store', { id: id, price: price, qty: 1 })
                .then(response => {
                    getCart();
                    console.log(response.data);
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        };

        return{
            number_format,
            addCart,
            listCart,
            getCart
        }
    },
        components: {
        Header,
        Link
        // Footer,
    },
}
</script>
<template>
    <Header :dataFromParent="listCart"/>
        <div class="container-fluid bg-[#EBEBEB] pt-5">
          <div class="container px-28">
            <div class="flex justify-center gap-5">
              <div class="w-1/4 hidden md:block">
                <nav class="flex mb-4" aria-label="Breadcrumb">
                  <ol
                    class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
                  >
                    <li class="inline-flex items-center">
                      <a
                        href="index.html"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600"
                      >
                        Halaman Utama
                      </a>
                    </li>
                    <li aria-current="page">
                      <div class="flex items-center">
                        <span>
                            >
                        </span>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2"
                          >Produk</span
                        >
                      </div>
                    </li>
                  </ol>
                </nav>
                <div
                  class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg mb-4"
                >
                  <ul class="w-full">
                    <li
                      class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-600 text-white"
                    >
                      Kategori Produk
                    </li>
                    <li class="w-full px-4 py-2 border-b border-gray-200" v-for="(item,index) in category">
                     {{item.name}}
                    </li>
                  </ul>

                  <div class="p-4">
                    <label
                      for="small-input"
                      class="block mb-2 text-sm font-medium text-gray-900"
                      >Produk Tersedia</label
                    >
                    <input
                      type="text"
                      id="small-input"
                      placeholder="Cari Produk..."
                      class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500"
                    />
                  </div>
                  <hr class="h-px my-4 bg-gray-300 border-0" />
                  <div class="p-4">
                    <!-- Dropdown menu -->
                    <div
                      id="dropdownDivider"
                      class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                    >
                      <ul
                        class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownDividerButton"
                      >
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100"
                            >Size 1</a
                          >
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100"
                            >Size 2</a
                          >
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100"
                            >Size 3</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="p-4">
                    <p class="text-sm text-gray-900 mb-2">Harga</p>
                    <!-- Input Range Form -->
                    <div class="grid grid-cols-2 gap-4">
                      <div class="flex flex-col">
                        <label for="minPrice" class="text-sm text-orange-500"
                          >Minimum</label
                        >
                        <input
                          type="number"
                          id="minPrice"
                          name="minPrice"
                          class="border border-gray-300 p-2 mt-1 rounded-md"
                        />
                      </div>
                      <div class="flex flex-col">
                        <label for="maxPrice" class="text-sm text-orange-500"
                          >Maksimum</label
                        >
                        <input
                          type="number"
                          id="maxPrice"
                          name="maxPrice"
                          class="border border-gray-300 p-2 mt-1 rounded-md"
                        />
                      </div>
                    </div>
                    <!-- Progress Bar -->
                    <div class="mt-4">
                      <input
                        type="range"
                        id="priceRange"
                        name="priceRange"
                        min="0"
                        max="100"
                        value="50"
                        class="w-full mt-1"
                      />
                      <div class="flex justify-between text-xs text-gray-600">
                        <span>0</span>
                        <span>50</span>
                        <span>100</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-3/4">
                <div class="py-4 w-full flex flex-row gap-2">
                    <select name="" id="" class="border-0 focus:border-0 text-yellow-300 font-semibold">
                        <option value="">Urutkan Berdasarkan</option>
                        <option value="">Terbaru</option>
                        <option value="">A-Z</option>
                        <option value="">Z-A</option>
                        <option value="">Harga Minimal</option>
                        <option value="">Harga Maksimal</option>
                    </select>
                  <!-- <button
                    id="dropdownDividerButton"
                    data-dropdown-toggle="dropdownDivider"
                    class="button-filter"
                    type="button"
                  >
                    <span>Urutkan Berdasarkan </span
                    ><i class="fa-solid fa-chevron-down"></i>
                  </button> -->
                  <!-- <button
                    id="dropdownDividerButton"
                    data-dropdown-toggle="dropdownDivider"
                    class="button-filter"
                    type="button"
                  >
                    <span>Filter </span><i class="fa-solid fa-chevron-down"></i>
                  </button> -->
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8 mx-1">
                  <!-- Product Card -->
                  <div  class="bg-white p-6 rounded-lg shadow-md text-center" v-for="(item, index) in product">
                      <Link :href="'/product/'+item.id">
                        <img
                          :src="item.image"
                          alt="Product"
                          class="w-full h-32 object-cover mb-4 rounded-md"
                        />
                        <h3 class="text-lg font-semibold mb-2">{{item.name}}</h3>
                        <!-- <p class="text-gray-600 mb-4">Description of Product.</p> -->
                        <p class="text-blue-500 text-lg font-semibold mb-2">
                          Rp. {{number_format(item.price)}}
                        </p>
                    </Link>
                    <button @click="addCart(item.id,item.price)" class="bg-[#2F318B] text-white w-full py-2 rounded-md font-semibold mt-2">
                      + Tambah ke Troli
                    </button>
                  </div>
                </div>
                <nav
                  aria-label="Page navigation example"
                  class="my-4 flex justify-end"
                >
                  <ul class="flex items-center -space-x-px h-8 text-sm">
                    <li>
                      <a
                        href="#"
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700"
                      >
                        <span class="sr-only">Previous</span>
                        <i class="fa-solid fa-chevron-left"></i>
                      </a>
                    </li>
                    <li>
                      <a
                        href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                        >1</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                        >2</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        aria-current="page"
                        class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700"
                        >3</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                        >4</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                        >5</a
                      >
                    </li>
                    <li>
                      <a
                        href="#"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700"
                      >
                        <span class="sr-only">Next</span>
                        <i class="fa-solid fa-chevron-right"></i>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
</template>
