
<script>
import Header from '../../components/dashboard/Header.vue';
import { Link } from '@inertiajs/vue3'
import { ref, onMounted,watch } from 'vue';
import axios from 'axios';
import Footer from '../../components/dashboard/Footer.vue';
export default{
    props:{
        category:Object,
        product:Object,
        keyword:String,
    },
    setup(props){
        let filteredCategory=ref(props.product)
        let productData=ref(props.product)
        console.log('product',props.product)
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

        var filterKeyword = ref(null);
        var filterCategory = ref("");
        var filterMin = ref("");
        var filterMax = ref("");
        var sortBy = ref(""); // Menambahkan sortBy
        var sortOrder = ref("asc"); // Menambahkan sortOrder


        const searchCategory = (id) => {
            filterCategory.value = id;
            applyFilters();
        };

        const search = () => {
            applyFilters();
        };

        const clearFilter=()=>{
            filterKeyword.value="";
            filterCategory.value="";
            filterMin.value="",
            filterMax.value="";
            applyFilters();

            const url = new URL(window.location.href);
            url.searchParams.delete('keyword');
            // url.searchParams.delete('category');
            // url.searchParams.delete('min');
            // url.searchParams.delete('max');

            // Perbarui URL tanpa memuat ulang halaman
            window.history.pushState({}, '', url.toString());
        }

        const applyFilters = () => {
            filteredCategory.value = productData.value.filter(item => {
                const matchesCategory = item.category_id.toLowerCase().includes(filterCategory.value);
                const matchesKeyword = filterKeyword.value === null || filterKeyword.value === "" || item.name.toLowerCase().includes(filterKeyword.value.toLowerCase());
                const withinPriceRange = (
                    (filterMin.value === "" || item.price >= filterMin.value) &&
                    (filterMax.value === "" || item.price <= filterMax.value)
                );

                return matchesCategory && matchesKeyword && withinPriceRange;
            });

            if (sortBy.value === "Terbaru") {
                filteredCategory.value.sort((a, b) => a.date - b.date);
            } else if (sortBy.value === "A-Z") {
                filteredCategory.value.sort((a, b) => a.name.localeCompare(b.name));
            } else if (sortBy.value === "Z-A") {
                filteredCategory.value.sort((a, b) => b.name.localeCompare(a.name));
            } else if (sortBy.value === "Harga Minimal") {
                filteredCategory.value.sort((a, b) => a.price - b.price);
            } else if (sortBy.value === "Harga Maksimal") {
                filteredCategory.value.sort((a, b) => b.price - a.price);
            }
        };

        if (props.keyword) {
            filterKeyword.value = props.keyword;
            applyFilters();
        }
        watch([filterMin, filterMax,sortBy,filterKeyword], () => {
            console.log(filterMin.value)
            console.log(filterMax.value)
            console.log(sortBy.value)
            applyFilters();
        });


        const addCart = (id, price) => {
            axios.post('/api/cart/store', { id: id, price: price, qty: 1 })
                .then(response => {
                    getCart();
                    console.log(response.data);
                })
                .catch(error => {
                    window.location.href='/login'
                    console.error('Error fetching user data:', error);
                });
        };

        var filterStatus=ref(false);

        return{
            number_format,
            productData,
            // Filter
            clearFilter,
            searchCategory,
            filteredCategory,
            filterCategory,
            search,
            filterMin,
            filterMax,
            filterKeyword,
            sortBy,
            sortOrder,

            // Cart
            addCart,
            listCart,
            getCart,

            // Filter
            filterStatus
        }
    },
        components: {
        Header,
        Link,
        Footer,
    },
}
</script>
<template>
                <!-- <div class="container-fluid  bg-slate-300 pt-5 md:pb-0 pb-24 min-h-screen">
                  <div class="container mx-auto mt-20 md:mt-5"> -->
    <Header :dataFromParent="listCart"/>
        <div class="container-fluid bg-[#EBEBEB] pt-5 md:pb-0 pb-24 min-h-screen">
          <div class="container md:px-28 mt-20 md:mt-5">

            <!-- Mobile -->
            <div class=" flex w-full md:hidden justify-center">
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                Halaman Utama
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <span>
                                    >
                                </span>
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Produk</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Mobile Filter -->
                <div class=" bg-white h-screen w-screen fixed top-0" v-if="filterStatus==true">
                    <div class="flex justify-between px-2 items-center py-2 mb-3">
                        <div class="font-bold text-lg">
                            Filter Produk
                        </div>
                        <button @click="filterStatus=false" class="px-4 border text-[#2F318B] border-[#2F318B] font-semibold rounded-md py-1">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg> -->
                            Terapkan
                        </button>
                    </div>
                  <div class="w-full px-2">
                    <div class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg mb-4">
                      <ul class="w-full">
                        <li
                          class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-600 flex justify-between text-white"
                        >
                          Kategori Produk
                        </li>
                        <li class="w-full px-4 py-2 border-b border-gray-200 cursor-pointer" :class="{ 'text-blue-500': item.id == filterCategory }" v-for="(item, index) in category" @click="searchCategory(item.id)">
                         {{ item.name }}
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
                          id="small-input" @keyup="search()" v-model="filterKeyword"
                          placeholder="Cari Produk..."
                          class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500"
                        />
                      </div>
                      <hr class="h-px my-4 bg-gray-300 border-0" />
                      <div class="p-4">
                        <p class="text-sm text-gray-900 mb-2">Rentang Harga</p>
                        <!-- Input Range Form -->
                        <div class="grid grid-cols-2 gap-4">
                          <div class="flex flex-col">
                            <label for="minPrice" class="text-sm text-orange-500"
                              >Minimum</label
                            >
                            <input
                              type="number" v-model="filterMin"
                              id="minPrice"
                              name="minPrice"
                              class="border border-gray-300 p-2 mt-1 rounded-md"
                            />
                          </div>
                          <div class="flex flex-col">
                            <label for="maxPrice" class="text-sm text-orange-500"
                              >Maksimum</label
                            >
                            <input v-model="filterMax"
                              type="number"
                              id="maxPrice"
                              name="maxPrice"
                              class="border border-gray-300 p-2 mt-1 rounded-md"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>


            <!-- Destop Filter -->
            <div class="flex justify-center gap-5">
              <div class="w-1/4 hidden md:block">
                <nav class="flex mb-4" aria-label="Breadcrumb">
                  <ol
                    class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
                  >
                    <li class="inline-flex items-center">
                      <a
                        href="/"
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
                      class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-600 flex justify-between text-white"
                    >
                      Kategori Produk <span class="text-red-500 cursor-pointer" @click="clearFilter">Clear Filter</span>
                    </li>
                    <li class="w-full px-4 py-2 border-b border-gray-200 cursor-pointer" :class="{'text-blue-500':item.id==filterCategory}" v-for="(item,index) in category" @click="searchCategory(item.id)">
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
                      id="small-input" @keyup="search()" v-model="filterKeyword"
                      placeholder="Cari Produk..."
                      class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500"
                    />
                  </div>
                  <hr class="h-px my-4 bg-gray-300 border-0" />
                  <div class="p-4">
                    <p class="text-sm text-gray-900 mb-2">Rentang Harga</p>
                    <!-- Input Range Form -->
                    <div class="grid grid-cols-2 gap-4">
                      <div class="flex flex-col">
                        <label for="minPrice" class="text-sm text-orange-500"
                          >Minimum</label
                        >
                        <input
                          type="number" v-model="filterMin"
                          id="minPrice"
                          name="minPrice"
                          class="border border-gray-300 p-2 mt-1 rounded-md"
                        />
                      </div>
                      <div class="flex flex-col">
                        <label for="maxPrice" class="text-sm text-orange-500"
                          >Maksimum</label
                        >
                        <input v-model="filterMax"
                          type="number"
                          id="maxPrice"
                          name="maxPrice"
                          class="border border-gray-300 p-2 mt-1 rounded-md"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="w-3/4">
                <div class="py-4 w-full flex flex-row gap-2">
                    <select name="" id="" class="border-0 focus:border-0 text-yellow-300 w-full md:w-auto font-semibold" v-model="sortBy">
                        <option value="">Urutkan Berdasarkan</option>
                        <option value="Terbaru">Terbaru</option>
                        <option value="A-Z">A-Z</option>
                        <option value="Z-A">Z-A</option>
                        <option value="Harga Minimal">Harga Minimal</option>
                        <option value="Harga Maksimal">Harga Maksimal</option>
                    </select>
                </div>
                <div class="flex md:hidden gap-2 mb-3">
                    <button class="w-full border text-[#2F318B] border-[#2F318B] font-semibold rounded-md py-1" @click="filterStatus=!filterStatus">Filter</button>
                    <button class="w-full border text-red-600 border-red-600 font-semibold rounded-md py-1" @click="clearFilter">Clear Filter</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:mx-1">
                  <!-- Product Card -->
                  <div  class="bg-white p-6 rounded-lg shadow-md text-center" v-for="(item, index) in filteredCategory">
                      <Link :href="'/product/'+item.id">
                        <img
                          :src="item.image"
                          alt="Product"
                          class="w-full h-32 object-cover mb-4 rounded-md"
                        />
                        <h3 class="text-lg font-semibold mb-2">{{item.name}}</h3>
                        <p class="text-blue-500 text-lg font-semibold mb-2">
                          Rp. {{number_format(item.price)}}
                        </p>
                    </Link>
                    <button @click="addCart(item.id,item.price)" class="bg-[#2F318B] text-white w-full py-2 rounded-md font-semibold mt-2">
                      + Tambah ke Troli
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <Footer/>
</template>
