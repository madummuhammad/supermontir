<script>
import { Link } from '@inertiajs/vue3'
import { ref, onMounted, onBeforeMount } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const userData = ref([]);
        const logged = ref(false);
        var mobileMenuOpen=ref(false);
        onBeforeMount(() => {
            fetchUser();
        });

        const fetchUser = () => {
            console.log(logged.value)
            axios.get('/api/auth/me')
                .then(response => {
                    userData.value = response.data.data;
                    logged.value=true
                    console.log('userData',response.data)
                })
                .catch(error => {
                    logged.value=false;
                    console.error('Error fetching user data:', error);
                });
        }

        const toggleMobileMenu=()=>{
            mobileMenuOpen.value = !mobileMenuOpen.value;
        };
        return {
            logged,
            userData,
            fetchUser,
            mobileMenuOpen,
            toggleMobileMenu
        };
    },
    components: {
        Link,
    },
};
</script>

<template>
        <nav class="bg-white border-gray-200 fixed top-0 left-0 right-0">
          <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
              <img class="w-full h-8" src="@assets/images/logo.png" />
            </a>
            <button @click="toggleMobileMenu" data-collapse-toggle="navbar-default" type="button" id="toggleButton" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
              <!-- <span class="sr-only">Open main menu</span> -->
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
              </svg>
            </button>
             <div :class="{ 'hidden': !mobileMenuOpen, 'w-full': true, 'md:block': true, 'md:w-auto': true }" id="navbar-default">
              <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white items-center">
                <li class="flex-grow">
                  <a href="#" class="nav-link" aria-current="page">Product & Services</a>
                </li>
                <li class="flex-grow">
                  <a href="#" class="nav-link">FAQ</a>
                </li>
                <li class="flex-grow">
                  <a href="#" class="nav-link">Kontak Kami</a>
                </li>
                <li class="flex-grow">
                  <a href="#" class="nav-link"
                    ><i class="fa-solid fa-cart-shopping"></i
                  ></a>
                </li>
                <li class="flex-grow">
                  <a href="#" class="nav-link"><i class="fa-solid fa-user"></i></a>
                </li>
                <li class="flex-grow">
                  <Link href="/login" v-if="logged==false" class="nav-button">Daftar / Masuk</Link>
                  <Link href="/user/profile" v-if="logged==true" class="nav-button flex items-center"><svg class="me-3" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg> {{ userData.name }}</Link>
                </li>
              </ul>
            </div>
          </div>
        </nav>
</template>
