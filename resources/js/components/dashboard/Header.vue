<script>
import { Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    props:{
        dataFromParent: String,
    },
     watch: {
        dataFromParent(newValue) {
            // Lakukan sesuatu ketika data berubah
            this.listCart=newValue;
            console.log('listCart',this.listCart)
            console.log('Data di child diperbarui:', newValue);
        },
    },
    setup() {
        const userData = ref([]);
        const logged = ref(false);
        onMounted(() => {
            fetchUser();
        });
        var cartShow=ref(false)
        const openCart=()=>{
            cartShow.value=true;
            console.log('asdf')
        }

        let listCart=ref([])
        const getCart = () => {
            axios.get('/api/cart/get')
            .then(response => {
                listCart.value=response.data.data;
                console.log(listCart.value)
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
            });
        }

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

        onMounted(()=>{
            getCart();
        })

        const closeCartOutside=(event)=>{
            const cartContainer = this.$refs.cartContainer;
            if (cartContainer && !cartContainer.contains(event.target)) {
                this.closeCart();
            }
        }

        const fetchUser = () => {
            axios.get('/api/auth/me')
                .then(response => {
                    userData.value = response.data.data;
                    logged.value = response.data.status
                    // console.log(userData.value)
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }

        return {
            closeCartOutside,
            userData,
            getCart,
            openCart,
            listCart,
            cartShow,
            fetchUser,
            number_format
        };
    },
    components: {
        Link,
    },
};
</script>

<template>
            <!-- nav -->
            <nav class="bg-white border-gray-200">
                <div class=" px-12 flex justify-end">
                    <div
                        class="font-medium hidden md:flex justify-start gap-6 p-4 md:p-0 mt-4 rounded-lg rtl:space-x-reverse items-center"
                      >
                        <div>
                          <p class="text-sm">
                            Pusat Panggilan <span class="font-bold">021–569 49 669</span>
                          </p>
                        </div>

                        <div class="flex items-center gap-2">
                          <a class="flex-grow">
                            <p class="text-sm bg-gray-200">IN</p>
                          </a>

                          <a class="flex-grow">
                            <a href="/"
                              ><i class="fa-solid fa-bell fa-xl text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"/></svg></i
                            ></a>
                          </a>
                        </div>
                      </div>
                </div>
              <div
                class="max-w-screen-xl flex md:flex items-center justify-between mx-auto p-4"
              >
                <div
                  class="flex items-center w-full justify-end space-x-3 rtl:space-x-reverse md:flex-row-reverse"
                >
                  <a href="#" class="flex justify-start items-start gap-2 ps-2">
                    <img src="@assets/images/icon/hamburger-box.svg" alt="" />
                    <span class="text-sm text-gray-600 hidden md:block">MENU</span>
                  </a>
                  <a
                    href="/"
                    class="flex items-center space-x-3 rtl:space-x-reverse me-4 md:border-e-2 pe-2"
                  >
                    <img class="md:w-full md:h-[50px] h-8 w-40" src="@assets/images/logo.png" />
                  </a>
                </div>
                <div class="w-full">
                     <form class="md:me-5 me-2 w-full">
                            <label
                              for="default-search"
                              class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
                              >Search</label
                            >
                            <div class="relative flex items-center">
                              <div
                                class="absolute inset-y-0 md:end-2 end-6 flex items-center ps-3 pointer-events-none"
                              >
                                <svg
                                  class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                  aria-hidden="true"
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 20 20"
                                >
                                  <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                  />
                                </svg>
                              </div>
                              <input
                                type="search"
                                id="default-search"
                                class="block w-full py-2 ps-2 pe-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 0"
                                placeholder="Cari Produk..."
                                required
                              />
                            </div>
                          </form>
                </div>
                <div class="md:flex flex-col" id="navbar-default">
                  <div class="flex justify-between items-center">
                    <div class="flex items-center gap-1 justify-start relative">

                      <Link href="/cart" @mouseover="openCart" class="relative md:ml-2 border-[#2F318B] border-2 rounded-md py-1 px-2 flex items-center justify-center w-[40px] h-[40px]">
                        <i
                          class="fa-solid fa-cart-shopping md:fa-2xl fa-xl text-gray-600"
                        >
                    <svg fill="#2F318B" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                    </i>
                    <div v-if="listCart.length>0" class="absolute bg-yellow-400 w-[30px] text-white h-[30px] flex items-center justify-center top-[-50%] right-[-20%] rounded-[100%]">
                        {{listCart.length}}
                    </div>
                      </Link>
                      <div class="absolute top-[160%] bg-white shadow-lg p-2 right-0 w-[300px]" @mouseleave="cartShow=false" v-if="cartShow==true">
                      <!-- pilih semua -->
                      <div v-for="(item,index) in listCart"
                        class="w-full text-sm py-4 font-medium text-gray-900 bg-white rounded-lg flex justify-between items-top"
                      >
                        <div class="flex items-start gap-2">
                          <img :src="item.product.image" class="w-28 ms-2" alt="" />
                        </div>
                        <div class="flex flex-col text-left ps-6">
                          <h2 class="text-lg font-semibold text-blue-900">{{item.product.name}}</h2>
                          <h2 class="text-lg font-semibold text-blue-900">
                            Rp. {{number_format(item.price)}}
                          </h2>
                        </div>
                      </div>
                      <Link href="/cart" class="py-2 bg-[#F2BA1B] block text-center px-2 w-full text-white font-semibold rounded-sm">TAMPILKAN SEMUA</Link>
                      </div>
                    </div>

                    <div class="md:flex items-center gap-2">
                      <!-- Icon Menu 2 -->
                      <div class="hidden md:block">
                        <a
                          href="#"
                          class="md:ml-2 border-[#2F318B] border-2 rounded-md py-1 px-2 flex items-center justify-center w-[40px] h-[40px]"
                        >
                          <i class="fa-solid fa-gift fa-xl text-[#2F318B]">
                            <svg fill="#2F318B" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M190.5 68.8L225.3 128H224 152c-22.1 0-40-17.9-40-40s17.9-40 40-40h2.2c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H480c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H438.4c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88h-2.2c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0H152C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40H288h-1.3l34.8-59.2C329.1 55.9 342.9 48 357.8 48H360c22.1 0 40 17.9 40 40zM32 288V464c0 26.5 21.5 48 48 48H224V288H32zM288 512H432c26.5 0 48-21.5 48-48V288H288V512z"/></svg>
                          </i>
                        </a>
                      </div>
                      <!-- Icon Menu 3 -->
                      <div class="hidden md:block">
                        <Link
                          href="/user/garage"
                          class="md:ml-2 border-[#2F318B] border-2 rounded-md py-1 px-2  flex items-center justify-center w-[40px] h-[40px]"
                        >
                          <i class="fa-solid fa-warehouse fa-xl text-[#2F318B]">
    <svg fill="#2F318B" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><path d="M0 488V171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4V488c0 13.3-10.7 24-24 24H568c-13.3 0-24-10.7-24-24V224c0-17.7-14.3-32-32-32H128c-17.7 0-32 14.3-32 32V488c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24zm488 24l-336 0c-13.3 0-24-10.7-24-24V432H512l0 56c0 13.3-10.7 24-24 24zM128 400V336H512v64H128zm0-96V224H512l0 80H128z"/></svg>

                          </i>
                        </Link>
                      </div>
                      <div class="flex items-center">
                        <Link
                          href="/user/profile"
                          class="md:ml-2 border-[#2F318B] border-2 rounded-md py-1 px-2  flex items-center justify-center w-[40px] h-[40px]"
                        >
                          <i class="fa-regular fa-user fa-xl text-[#2F318B]">
    <svg fill="#2F318B" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>

                          </i></Link
                        ><span class="hidden md:block ms-2 text-gray-500">{{userData.name}}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
</template>
