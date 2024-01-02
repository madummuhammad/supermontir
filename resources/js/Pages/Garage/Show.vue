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
        id:String,
        garage:Object
    },
    setup(props) {

        const listNew = ref([]);

        const getList = (status = 'baru') => {
            axios.post('/api/garage/detail/'+props.id, { status: status })
                .then(response => {
                    listNew.value = response.data.data;
                    console.log('transaction', response.data)
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



        onMounted(() => {
            getList();
        });

        // const submit = () => {
        //     form
        //         .transform((data) => ({
        //             ...data
        //         }))
        //         .post(route('garage.store'), {
        //             onFinish: (response) => {
        //                 console.log(page.props.flash)
        //                 modalAddGarageShow.value = false;
        //                 getVehicle();
        //             }
        //         });
        // };

        const pageStatus = ref('baru');
        const changePageStatus = (type) => {
            pageStatus.value = type;
            getList(type);
        }
        // const changeEditType = (type) => {
        //     formEdit.value.vehicle_type = type
        // }

        return {
            // form,
            getList,
            number_format,
            // submit,
            page,
            pageStatus,
            changePageStatus,
            listNew
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
                    <div class="bg-white p-6 rounded-lg shadow-md w-full" id="content">
                         <div class=" text-left mb-4 border px-5 py-2 rounded-md border-[#2F318B]">
                            <div class="font-bold mb-3">{{ garage.merk }}</div>
                            <table class="mb-3">
                                <tr>
                                    <td>Type</td>
                                    <td>: {{ garage.vehicle_type }}</td>
                                </tr>
                            </table>
                            <div class="flex w-full justify-between">
                                <table class="w-full mb-3">
                                    <tr>
                                        <td><span class="font-bold">Tahun : </span>{{ garage.year }}</td>
                                    </tr>
                                </table>
                                <table class="w-full mb-3">
                                    <tr>
                                        <td><span class="font-bold">No Pol : </span>{{ garage.plat }}</td>
                                    </tr>
                                </table>
                                <table class="w-full mb-3">
                                    <tr>
                                        <td><span class="font-bold">Kilometer : </span>{{ garage.km }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="font-bold text-[#2F318B]">Riwayat Transaksi</p>
                            <p class="text-xs">Daftar Riwayat Kendaraan Anda</p>
                        </div>
                        <div class="overflow-x-auto">
                            <div class="w-full">
                                <!-- navbar -->
                                <div class="flex flex-row justify-between items-center border-b-2 pb-2">
                                    <a @click="changePageStatus('baru')"
                                        class="tab-link cursor-pointer text-center block py-2 w-full border"
                                        :class="{ ' bg-[#2F318B] text-white': pageStatus == 'baru' }"
                                        aria-current="page">Baru</a>
                                    <a @click="changePageStatus('proses')"
                                        class="tab-link cursor-pointer text-center block py-2 w-full border"
                                        :class="{ ' bg-[#2F318B] text-white': pageStatus == 'proses' }"
                                        aria-current="page">Proses</a>
                                    <a @click="changePageStatus('selesai')"
                                        class="tab-link cursor-pointer text-center block py-2 w-full border"
                                        :class="{ ' bg-[#2F318B] text-white': pageStatus == 'selesai' }"
                                        aria-current="page">Selesai</a>
                                </div>

                                <!-- content -->
                                <div class="w-full">
                                    <div class="border-2 mb-2 mt-2 py-2 px-2" v-for="(item, index) in listNew">
                                        <table class="w-full mb-3">
                                            <tr>
                                                <td class="w-[25%]">Kendaraan</td>
                                                <td>: {{ item.garage.merk }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-[25%]">Plat</td>
                                                <td>: {{ item.garage.plat }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-[25%]">Alamat</td>
                                                <td>: {{ item.address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-[25%]">Total</td>
                                                <td>: Rp. {{ number_format(item.total) }}</td>
                                            </tr>
                                        </table>
                                        <div class="border p-2">
                                            <h5 class="fw-bold">Produk :</h5>
                                            <div v-for="(item, index) in item.item_order">
                                                - {{ item.product.name }}
                                            </div>
                                        </div>
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
