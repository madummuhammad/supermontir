<style>
@import url(../../../css/style.css);
</style>
<script>
import Header from '../../components/dashboard/Header.vue';
import Sidebar from '../../components/dashboard/Sidebar.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3'
const page = usePage()
import { useForm } from '@inertiajs/vue3';
// import Footer from '../../components/Footer.vue';

export default {
    props: {
    },
    setup(props) {

        let form=ref(useForm({
            code:""
        }))

        const submit = () => {
            form.value.transform((data) => ({
                    ...data
                }))
                .post(route('kupon.store'), {
                    onFinish: () => {
                        var status=pageStatus.value;
                        getList(status)
                        // form.reset('password');
                    }
                });
        };

        const pageStatus = ref('unused');
        const changePageStatus = (type) => {
            pageStatus.value = type;
            getList(type)
        }

        let listNew=ref([])

        const getList = (status = 'unused') => {
            axios.post('/api/kupon/list', { status: status })
                .then(response => {
                    listNew.value = response.data.data;
                    console.log('kupon', response.data)
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }

        onMounted(()=>{
            getList();
        })

        return {
            form,
            getList,
            listNew,
            // number_format,
            // submit,
            // page,
            submit,
            pageStatus,
            changePageStatus,
        }
    },
    mounted() {

    },
    components: {
        Header,
        Sidebar,
        // Footer,
    },
};
</script>
<template>
    <Header />
    <div class="container-fluid bg-slate-300 pt-5">
        <div class="container mx-auto">
            <div class="flex justify-center gap-5">
                <Sidebar />

                <div class="md:w-2/3 w-11/12">
                    <form @submit.prevent="submit">
                     <div class="bg-white p-6 rounded-lg shadow-md w-full mb-3 flex items-center justify-between" id="content">
                            <div class="w-2/3">
                                <input
                                  type="text" :class="{ 'border-red-700': form.errors.code }"
                                  name="name" v-model="form.code"
                                  id="name" placeholder="Masukan kode kupon"
                                  class="border-2 mb-1 w-full border-gray-300 rounded-md p-2"
                                />
                                <p class="text-red-700 text-sm">{{ form.errors.code }}</p>
                            </div>
                            <button class="bg-[#2F318B] px-12 rounded-md font-bold py-2 text-white">Simpan</button>
                        </div>
                    </form>
                    <div class="bg-white p-6 rounded-lg shadow-md w-full" id="content">
                        <div class="overflow-x-auto">
                            <div class="w-full">
                                <!-- navbar -->
                                <div class="flex flex-row justify-between items-center border-b-2 pb-2">
                                    <a @click="changePageStatus('unused')"
                                        class="tab-link cursor-pointer text-center block py-2 w-full border"
                                        :class="{ ' bg-[#2F318B] text-white': pageStatus == 'unused' }"
                                        aria-current="page">Belum Dipakai</a>
                                    <a @click="changePageStatus('used')"
                                        class="tab-link cursor-pointer text-center block py-2 w-full border"
                                        :class="{ ' bg-[#2F318B] text-white': pageStatus == 'used' }"
                                        aria-current="page">Terpakai</a>
                                    <a @click="changePageStatus('expired')"
                                        class="tab-link cursor-pointer text-center block py-2 w-full border"
                                        :class="{ ' bg-[#2F318B] text-white': pageStatus == 'expired' }"
                                        aria-current="page">Tidak Berlaku</a>
                                </div>

                                <!-- content -->
                                <div class="w-full">
                                    <div class="border-2 mb-2 mt-2 py-2 px-2"  v-if="listNew.length > 0" v-for="(item, index) in listNew">
                                        <table class="w-full mb-3 ">
                                            <tr>
                                                <td class="w-[25%]">Kode Kupon</td>
                                                <td>:{{item.kupon.code}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="text-center" v-if="listNew.length==0">
                                        Data tidak ditemukan
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- isi content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="bg-gray-300 p-4 flex justify-center md:justify-start py-4">
        <img src="@assets/images/logo.png" alt="" />
    </footer>
    <!-- Bottom Bar -->
    <div x-data="{ isMobile: window.innerWidth <= 768 }"
        x-init="() => { window.addEventListener('resize', () => { isMobile = window.innerWidth <= 768 }) }"
        class="fixed bottom-0 left-0 right-0 bg-white px-4 py-6 text-blue-500 shadow-md flex items-center justify-between md:hidden"
        x-show="isMobile">
        <!-- Icon Menu 1 -->
        <a href="#" class="flex items-center justify-center mx-2">
            <i class="fa-solid fa-home fa-lg"></i>
        </a>
        <!-- Icon Menu 2 -->
        <a href="#" class="flex items-center justify-center mx-2">
            <i class="fa-solid fa-gift fa-lg"></i>
        </a>
        <!-- Icon Menu 3 -->
        <a href="#" class="flex items-center justify-center mx-2">
            <i class="fa-solid fa-warehouse fa-lg"></i>
        </a>
        <!-- Icon Menu 4 -->
        <a href="#" class="flex items-center justify-center mx-2">
            <i class="fa-solid fa-bell fa-lg"></i>
        </a>
    <!-- Icon Menu 5 -->
    <a href="#" class="flex items-center justify-center mx-2">
        <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
    </a>
</div></template>
