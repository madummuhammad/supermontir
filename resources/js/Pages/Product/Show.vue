
<script>
import Header from '../../components/dashboard/Header.vue';
import { Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Footer from '../../components/dashboard/Footer.vue';
export default {
    props: {
        product: Object,
    },
    setup() {
        const number_format = (number, decimals, decPoint, thousandsSep) => {
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

        var qty=ref(1);

        const increase=()=>{
            qty.value=qty.value+1;
            console.log(qty.value)
        }

        const decrease=()=>{
            if(qty.value>1){
                qty.value=qty.value-1;
            }
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

        const addCart = (id,price) => {
            axios.post('/api/cart/store', { id: id,price:price,qty:qty.value })
                .then(response => {
                    getCart();
                    console.log(response.data);
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        };

        return {
            number_format,
            increase,
            listCart,
            getCart,
            parentData: 'Data dari parent',
            qty,
            decrease,
            addCart
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
    <Header :dataFromParent="listCart" />
    <div class="container-fluid bg-slate-300 pt-5 md:pb-0 pb-24 min-h-screen">
        <div class="container mx-auto mt-20 md:mt-5">
            <div class="flex justify-center gap-5">
              <div class="md:w-8/12 w-11/12 mx-auto">
                <nav class="flex mb-4" aria-label="Breadcrumb">
                  <ol
                    class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
                  >
                    <li class="inline-flex items-center">
                      <Link
                        href="/"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600"
                      >
                        Halaman Utama
                      </Link>
                    </li>
                    <li aria-current="page">
                      <Link class="flex items-center" href="/product">
                       >
                        <span
                          class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2"
                          >Produk</span
                        >
                      </Link>
                    </li>
                    <li aria-current="page">
                      <div class="flex items-center">
                       >
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2"
                          >{{product.name}}</span
                        >
                      </div>
                    </li>
                  </ol>
                </nav>
                <div
                  class="bg-white p-6 rounded-lg shadow-md text-center flex justify-center md:flex-row flex-col gap-4"
                >
                  <div
                    class="mb-4 md:w-1/2 w-full"
                  >
                    <!-- Carousel wrapper -->
                    <div class="relative">
                        <img
                          :src="product.image"
                          class="w-full h-full object-cover"
                          alt="Slide Image"
                        />
                    </div>
                  </div>
                  <div class="md:w-1/2 w-full md:text-left text-center">
                    <h2 class="text-2xl font-bold mb-2">{{product.name}}</h2>
                    <h1 class="text-3xl font-bold mb-2 text-[#2F318B]">
                      Rp. {{ number_format(product.price) }}
                    </h1>
                    <!-- counter -->
                    <div class="items-center my-4 flex justify-between">
                      <p class="text-lg text-gray-700 me-2">Jumlah:</p>
                      <div>
                          <button @click="decrease" class="bg-white mx-2 hover:bg-gray-400 text-[#2F318B] w-[40px] h-[40px] border-[#2F318B] border-2 font-bold py-1 px-3 rounded-full">
                            -
                          </button>
                          <input type="number" v-model="qty" value="1" class="w-20 text-center border-0 border-b-2 text-black" readonly/>
                          <button @click="increase" class="bg-white mx-2 hover:bg-gray-400 text-[#2F318B] w-[40px] h-[40px] border-[#2F318B] border-2 font-bold py-1 px-3 rounded-full">
                            +
                          </button>
                      </div>
                    </div>
                    <div class="flex md:justify-start justify-center gap-2 mb-2">
                      <button class="bg-[#2F318B] px-3 py-2 rounded-sm text-white w-full">Beli Sekarang</button>
                      <button class="button-tertiary px-3 py-2 rounded-sm w-full" @click="addCart(product.id,product.price)">
                        <i class="fa-solid fa-cart-plus pe-2"></i>Tambah ke Troli
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="md:w-3/12 pt-9 hidden md:block">
                <div
                  class="w-52 text-sm py-4 font-medium text-gray-900 bg-white border border-gray-200 rounded-lg mb-4"
                >
                  <ul class="">
                    <li
                      class="w-full px-4 py-2 rounded-t-lg bg-white text-blue-500"
                    >
                      Dapatkan Promo Menarik
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="container mx-auto mt-6">
            <div class="md:w-8/12 w-full px-4 md:ms-11">
              <div
                class="bg-white p-6 rounded-lg shadow-md text-center flex justify-center md:flex-row flex-col gap-4"
              >
                <div class="md:w-full w-full md:text-left text-center">
                  <div class="gap-8 border-b-2 pb-2">
                    <div>Deskripsi
                    </div>
                  </div>
                  <!-- content -->
                  <div class="w-full" v-html="product.description"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <Footer/>
</template>
