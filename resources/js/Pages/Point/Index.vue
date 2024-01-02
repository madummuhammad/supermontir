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

        let form = ref(useForm({
            code: ""
        }))

        // const submit = () => {
        //     form.value.transform((data) => ({
        //         ...data
        //     }))
        //         .post(route('kupon.store'), {
        //             onFinish: () => {
        //                 var status = pageStatus.value;
        //                 getList(status)
        //                 // form.reset('password');
        //             }
        //         });
        // };

        const pageStatus = ref('penukaran');
        const changePageStatus = (type) => {
            pageStatus.value = type;
            getList(type)
        }

        let listNew = ref([])

        const getList = (status = 'unused') => {
            // axios.post('/api/kupon/list', { status: status })
            //     .then(response => {
            //         listNew.value = response.data.data;
            //         console.log('kupon', response.data)
            //     })
            //     .catch(error => {
            //         console.error('Error fetching user data:', error);
            //     });
        }

        onMounted(() => {
            getList();
        })

        return {
            form,
            getList,
            listNew,
            // number_format,
            // submit,
            // page,
            // submit,
            pageStatus,
            changePageStatus,
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
                                <h5 class="text-center">Fitur sedang dalam pengembangan</h5>
                                <div class="flex justify-center">
                                    <img class=" h-8 w-40" src="@assets/images/logo.png" />
                                </div>
                                <!-- <div class="flex flex-row justify-between items-center border-b-2 pb-2">
                                    <a @click="changePageStatus('penukaran')"
                                        class="tab-link cursor-pointer text-center block py-2 w-full border"
                                        :class="{ ' bg-[#2F318B] text-white': pageStatus == 'penukaran' }"
                                        aria-current="page">Penukaran Poin</a>
                                    <a @click="changePageStatus('riwayat')"
                                        class="tab-link cursor-pointer text-center block py-2 w-full border"
                                        :class="{ ' bg-[#2F318B] text-white': pageStatus == 'riwayat' }"
                                        aria-current="page">Riwayat</a>
                                </div>
                                <div class="w-full">
                                    <div class="border-2 mb-2 mt-2 py-2 px-2">
                                       asdf
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
        <Footer/>
</template>
