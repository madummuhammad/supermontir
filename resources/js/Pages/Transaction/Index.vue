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
import Footer from '../../components/dashboard/Footer.vue';

export default {
    props: {
    },
    setup(props) {

        const listNew = ref([]);

        const getList = (status='baru') => {
            axios.post('/api/transaction/list',{status:status})
                .then(response => {
                    listNew.value=response.data.data;
                    console.log('transaction',response.data)
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

        const pageStatus=ref('baru');
        const changePageStatus = (type) => {
            pageStatus.value=type;
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
        Footer,
    },
};
</script>
<template>
    <Header />
                <div class="container-fluid  bg-slate-300 pt-5 md:pb-0 pb-24 min-h-screen">
                  <div class="container mx-auto mt-20 md:mt-5">
            <div class="flex justify-center gap-5">
                <Sidebar />

                <div class="md:w-2/3 w-11/12">
                    <div class="bg-white p-6 rounded-lg shadow-md w-full" id="content">
                            <div class="overflow-x-auto">
                                <div class="w-full">
            <!-- navbar -->
            <div class="flex flex-row justify-between items-center border-b-2 pb-2">
              <a @click="changePageStatus('baru')" class="tab-link cursor-pointer text-center block py-2 w-full border" :class="{' bg-[#2F318B] text-white' :pageStatus=='baru'}" aria-current="page">Baru</a>
              <a @click="changePageStatus('proses')" class="tab-link cursor-pointer text-center block py-2 w-full border" :class="{' bg-[#2F318B] text-white' :pageStatus=='proses'}" aria-current="page" >Proses</a>
              <a @click="changePageStatus('selesai')" class="tab-link cursor-pointer text-center block py-2 w-full border" :class="{' bg-[#2F318B] text-white' :pageStatus=='selesai'}" aria-current="page" >Selesai</a>
            </div>

            <!-- content -->
            <div class="w-full">
                <div class="border-2 mb-2 mt-2 py-2 px-2" v-for="(item,index) in listNew">
                    <table class="w-full mb-3">
                        <tr>
                            <td class="w-[25%]">Kendaraan</td>
                            <td>: {{item.garage.merk}}</td>
                        </tr>
                        <tr>
                            <td class="w-[25%]">Plat</td>
                            <td>: {{item.garage.plat}}</td>
                        </tr>
                        <tr>
                            <td class="w-[25%]">Alamat</td>
                            <td>: {{item.address}}</td>
                        </tr>
                        <tr>
                            <td class="w-[25%]">Total</td>
                            <td>: Rp. {{number_format(item.total)}}</td>
                        </tr>
                        <template v-if="item.status=='selesai'">
                             <tr>
                                <td class="w-[25%]">Tanggal Service</td>
                                <td>: {{ item.date_service }}</td>
                            </tr>
                             <tr>
                                <td class="w-[25%]">KM</td>
                                <td>: {{ item.km }}</td>
                            </tr>
                             <tr>
                                <td class="w-[25%]">Part Penggantian</td>
                                <td>: {{ item.part_penggantian }}</td>
                            </tr>
                             <tr>
                                <td class="w-[25%]">Catatan Service</td>
                                <td>: {{ item.note }}</td>
                            </tr>
                        </template>
                    </table>
                    <div class="border p-2">
                        <h5 class="fw-bold">Produk :</h5>
                        <div v-for="(item,index) in item.item_order">
                            - {{item.product.name}}
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
            <Footer/>
</template>
