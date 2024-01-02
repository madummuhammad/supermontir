<script>
import { Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const userData = ref([]);
        const logged = ref(false);
        onMounted(() => {
            fetchUser();
        });

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

        const logout = () => {
            axios.post('/api/auth/logout')
                .then(response => {
                    window.location.assign('/login');
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }

        return {
            userData,
            logout,
            fetchUser
        };
    },
    components: {
        Link,
    },
};
</script>

<template>
    <div class="w-1/4 hidden md:block">
                    <!-- Profile Section -->
                    <div class="mb-4 flex items-center flex-col">
                      <!-- Profile Picture (Circle) -->
                      <img v-if="userData.image==null"
                        src="@assets/images/avatar.png"
                        alt="Profile"
                        class="w-20 h-20 rounded-full mr-2"
                      />
                      <img v-if="userData.image!==null"
                        :src="userData.image"
                        alt="Profile"
                        class="w-20 h-20 rounded-full mr-2"
                      />
                      <div>
                        <p class="text-lg font-medium text-gray-900">{{userData.name}}</p>
                      </div>
                      <!-- <div>
                        <a
                          href="#"
                          class="text-md font-medium text-blue-500"


                          ><i class="fa-solid fa-pen"></i> Sunting Profile</a
                        >
                      </div> -->
                    </div>

                    <!-- menu List -->
                    <div
                      class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg mb-4"
                    >
                      <ul>
                        <li
                          class="w-full p-4 border-gray-200 rounded-t-lg flex items-center"
                        >
                          <Link href="/user/profile" class="flex items-center">
                             <i
                                  class="fa-solid fa-clock-rotate-left fa-lg mr-2 p-1 bg-[#FBF31B] rounded-full w-[30px] h-[30px] flex items-center justify-center"
                                >
                                <svg fill="#fff"  xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>
                            </i>
                            Pengaturan
                          </Link>
                        </li>
                        <li class="w-full p-4 border-gray-200 flex items-center">
                          <Link
                            href="/user/transaction"
                            class="flex items-center"

                          >
                            <i
                              class="fa-solid fa-clock-rotate-left fa-lg mr-2 p-1 bg-[#FBF31B] rounded-full w-[30px] h-[30px] flex items-center justify-center"
                            >
                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/></svg>
                        </i>
                            Riwayat Transaksi
                          </Link>
                        </li>
                        <li class="w-full p-4 border-gray-200 flex items-center">
                          <Link href="/user/garage"

                            class="flex items-center"

                          >
                            <i
                              class="fa-solid fa-warehouse fa-lg mr-2 p-1 bg-[#FBF31B] rounded-full w-[30px] h-[30px] flex items-center justify-center"
                            >
                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><path d="M0 488V171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4V488c0 13.3-10.7 24-24 24H568c-13.3 0-24-10.7-24-24V224c0-17.7-14.3-32-32-32H128c-17.7 0-32 14.3-32 32V488c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24zm488 24l-336 0c-13.3 0-24-10.7-24-24V432H512l0 56c0 13.3-10.7 24-24 24zM128 400V336H512v64H128zm0-96V224H512l0 80H128z"/></svg>
                        </i>
                            Garasi
                          </Link>
                        </li>
                        <li class="w-full p-4 border-gray-200 flex items-center">
                          <Link
                            href="/user/point"
                            class="flex items-center"

                          >
                            <i
                              class="fa-solid fa-gift fa-lg mr-2 p-1 bg-[#FBF31B] rounded-full w-[30px] h-[30px] flex items-center justify-center"
                            >
                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M190.5 68.8L225.3 128H224 152c-22.1 0-40-17.9-40-40s17.9-40 40-40h2.2c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H480c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H438.4c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88h-2.2c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0H152C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40H288h-1.3l34.8-59.2C329.1 55.9 342.9 48 357.8 48H360c22.1 0 40 17.9 40 40zM32 288V464c0 26.5 21.5 48 48 48H224V288H32zM288 512H432c26.5 0 48-21.5 48-48V288H288V512z"/></svg>
                        </i>
                            Penukaran Poin
                          </Link>
                        </li>
                        <li class="w-full p-4 border-gray-200 flex items-center">
                          <Link  href="/user/kupon"

                            class="flex items-center"

                          >
                            <i
                              class="fa-solid fa-ticket-simple fa-lg mr-2 p-1 bg-[#FBF31B] rounded-full w-[30px] h-[30px] flex items-center justify-center"
                            >
                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><path d="M64 64C28.7 64 0 92.7 0 128v64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320v64c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V320c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6V128c0-35.3-28.7-64-64-64H64zm64 112l0 160c0 8.8 7.2 16 16 16H432c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H144c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32H448c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V160z"/></svg>
                        </i>
                            Kupon Saya
                          </Link>
                        </li>
                        <li class="w-full p-4 border-gray-200 flex items-center">
                          <Link
                            href="/user/notification"
                            class="flex items-center"
                          >
                            <i
                              class="fa-solid fa-bell fa-lg mr-2 p-1 bg-[#FBF31B] rounded-full w-[30px] h-[30px] flex items-center justify-center"
                            >
                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"/></svg>
                        </i>
                            Notifikasi
                          </Link>
                        </li>
                        <li class="w-full p-4 border-gray-200 flex items-center">
                          <a class="flex items-center cursor-pointer" @click="logout">
                            <i
                              class="fa-solid fa-right-from-bracket fa-lg mr-2 p-1 bg-[#FBF31B] rounded-full w-[30px] h-[30px] flex items-center justify-center"
                            >
                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg></i>
                            Keluar
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
</template>
