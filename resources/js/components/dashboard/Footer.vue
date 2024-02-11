<script>
import { ref, onMounted,onBeforeMount } from 'vue';
import { Link } from '@inertiajs/vue3'
import axios from 'axios';
export default {
    props: {
        dataNotification: String
    },
    watch: {
        dataNotification(newValue) {
            let filteredNotifications = newValue.filter(notification => notification.is_read === 0);
            this.listNotification = filteredNotifications;
            console.log('listNotification', this.listNotification)
        }
    },
    setup(){
        onBeforeMount(() => {
            getNotification()
        });
        let listNotification = ref([])
        const getNotification = () => {
            axios.get('/api/notification/list')
                .then(response => {
                    console.log(response.data)
                    let data = response.data
                    let filteredNotifications = data.data.filter(notification => notification.is_read === 0);

                    // Simpan hasil filter ke listNotification
                    listNotification.value = filteredNotifications;
                    console.log('notification', listNotification.value);
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }

        return{
            listNotification,
            getNotification
        }
    },
    components: {
        Link,
    },
}
</script>
<template>
        <a href="https://wa.me/6281188812272?text=Halo%20SuperMontir,%20saya%20mau%20service%20kendaraan%20saya%20nih" target="_blank" class="fixed right-10 bottom-24 md:bottom-10">
            <div class="flex flex-col items-center justify-center">
                <img src="@assets/images/wa.svg" class="block h-[50px] w-[50px]" alt="">
                <div class="mt-1 font-semibold">Konsultasi Gratis </div>
            </div>
        </a>
            <footer class="bg-[#D9D9D9] items-center justify-between px-10 py-5 hidden md:flex">
                <div>
                    <img src="@assets/images/logo.png" alt="" />
                    <h1 class="font-bold mt-4 text-center md:text-left">PT. Super Montir Indonesia</h1>
                    <p class=" text-center md:text-left">Ruko Permata Regency blok D no 37,<br>
                        Jl. Haji Kelik, Srengseng, Kembangan<br>
                        JAKARTA BARAT
                    </p>
                    <p class="mt-4  text-center md:text-left">
                        0811 8881 2272
                    </p>
                </div>
                <div class="hidden md:block">
                    <Link class="font-bold block mt-4">Product & Service</Link>
                    <Link class="font-bold block mt-4">FAQ</Link>
                    <Link class="font-bold block mt-4">Kontak Kami</Link>
                </div>
            </footer>
            <footer class="bg-[#D9D9D9] items-center justify-center px-10 py-5 flex md:hidden">
                <div>
                    <img src="@assets/images/logo.png" alt="" />
                    <h1 class="font-bold mt-4 text-center md:text-left">PT. Super Montir Indonesia</h1>
                    <p class=" text-center md:text-left">Ruko Permata Regency blok D no 37,<br>
                        Jl. Haji Kelik, Srengseng, Kembangan<br>
                        JAKARTA BARAT
                    </p>
                    <p class="mt-4  text-center md:text-left">
                        0811 8881 2272
                    </p>
                </div>
                <div class="hidden md:block">
                    <Link href="/product" class="font-bold block mt-4">Product & Service</Link>
                    <Link class="font-bold block mt-4">FAQ</Link>
                    <Link href="/contact" class="font-bold block mt-4">Kontak Kami</Link>
                </div>
            </footer>
    <!-- Bottom Bar -->
<div class="fixed bottom-0 left-0 right-0 bg-white px-4 py-2 text-blue-500 shadow-md flex items-center justify-between md:hidden">
      <Link href="/" class="mx-2 flex-1 flex flex-col items-center">
        <div class="flex justify-center">
            <i class="fa-solid fa-home fa-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#2F318B" height="40" width="30" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
            </i>
        </div>
            <div class="text-center text-[#2F318B]">
                Home
            </div>
      </Link>
      <!-- Icon Menu 2 -->
      <Link href="/user/point" class="mx-2 flex-1 flex flex-col items-center">
        <div class="flex justify-center">
            <i class="fa-solid fa-gift fa-lg">
                <svg fill="#2F318B" xmlns="http://www.w3.org/2000/svg" height="40" width="30" viewBox="0 0 512 512"><path d="M190.5 68.8L225.3 128H224 152c-22.1 0-40-17.9-40-40s17.9-40 40-40h2.2c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H480c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H438.4c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88h-2.2c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0H152C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40H288h-1.3l34.8-59.2C329.1 55.9 342.9 48 357.8 48H360c22.1 0 40 17.9 40 40zM32 288V464c0 26.5 21.5 48 48 48H224V288H32zM288 512H432c26.5 0 48-21.5 48-48V288H288V512z"/></svg>
            </i>
        </div>

             <div class="text-center text-[#2F318B]">
                    Point
                </div>
      </Link>
      <!-- Icon Menu 3 -->
      <Link href="/user/garage" class="mx-2 flex-1 flex flex-col items-center">
        <div class="flex justify-center">
            <i class="fa-solid fa-warehouse fa-lg">
                 <svg fill="#2F318B" xmlns="http://www.w3.org/2000/svg" height="40" width="30" viewBox="0 0 640 512"><path d="M0 488V171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4V488c0 13.3-10.7 24-24 24H568c-13.3 0-24-10.7-24-24V224c0-17.7-14.3-32-32-32H128c-17.7 0-32 14.3-32 32V488c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24zm488 24l-336 0c-13.3 0-24-10.7-24-24V432H512l0 56c0 13.3-10.7 24-24 24zM128 400V336H512v64H128zm0-96V224H512l0 80H128z"/></svg>
                </i>
        </div>
        <div class="text-center text-[#2F318B]">
            Garasi
        </div>
      </Link>
      <!-- Icon Menu 4 -->
      <Link href="/user/notification" class="mx-2 flex-1 flex flex-col items-center relative">
        <div class="flex justify-center">
            <i class="fa-solid fa-bell fa-lg">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="#2F318B" height="40" width="30" viewBox="0 0 448 512"><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"/></svg>
            </i>
        </div>
          <div class="text-center text-[#2F318B]">
            Notifikasi
        </div>
          <div class="absolute bg-yellow-400 w-[20px] text-white h-[20px] flex items-center justify-center right-2 top-[-5px] rounded-[100%] text-xs" v-if="listNotification.length > 0">
            <div v-if="listNotification.length < 10">
                {{ listNotification.length }}
            </div>
            <div v-if="listNotification.length >= 10">
                10+
            </div>
        </div>
      </Link>
      <!-- Icon Menu 5 -->
      <Link href="/user/transaction" class="mx-2 flex-1 flex flex-col items-center">
         <div class="flex justify-center">
             <i class="fa-solid fa-clock-rotate-left fa-lg">
                 <svg fill="#2F318B" xmlns="http://www.w3.org/2000/svg" height="40" width="30" viewBox="0 0 512 512"><path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/></svg>
             </i>
         </div>
         <div class="text-center text-[#2F318B]">
                History
            </div>
      </Link>
    </div>
</template>
