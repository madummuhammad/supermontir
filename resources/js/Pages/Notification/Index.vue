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
        let listNotification=ref([])
        const getList = () => {
            axios.get('/api/notification/list')
                .then(response => {
                    console.log(response.data)
                    let data=response.data
                    listNotification.value=data.data;
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }

        const read = (id) => {
            axios.post('/api/notification/read/'+id)
                .then(response => {
                    console.log(response.data)
                    getList();
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }

        const destroy=(id)=>{
            axios.delete('/api/notification/destroy/' + id)
                .then(response => {
                    console.log(response.data)
                    getList();
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }

        onMounted(()=>[
            getList()
        ])
        const formatTimestamp=(time)=>{
            const dateObject = new Date(time);
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                // timeZoneName: 'short'
            };

            return dateObject.toLocaleString('id-ID', options);
        }

        console.log(formatTimestamp('2023-12-21 16:21:56'))

        // onMounted(() => {
        //     getList();
        // })

        return {
            formatTimestamp,
            listNotification,
            read,
            destroy
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
    <Header  :dataNotification="listNotification"/>
                <div class="container-fluid  bg-slate-300 pt-5 md:pb-0 pb-24 min-h-screen">
                  <div class="container mx-auto mt-20 md:mt-5">
            <div class="flex justify-center gap-5">
                <Sidebar />

                <div class="md:w-2/3 w-11/12">
                    <div class="bg-white p-6 rounded-lg shadow-md w-full" id="content">
                        <h1 class="text-center mb-3 font-bold text-xl">Notifikasi</h1>
                        <div class="overflow-x-auto">
                            <div class="mb-3" v-for="(item, index) in listNotification">
                                <div class="w-full border p-2 rounded-md" :class="{'cursor-pointer bg-gray-100':item.is_read==0}" @click="read(item.id)">
                                    <h5 class="font-bold uppercase">{{item.title}}</h5>
                                    <p class="text-gray-500" v-html="item.description"></p>
                                    <div class="flex justify-end">
                                        <div class="text-gray-500">
                                            {{formatTimestamp(item.created_at)}}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex mt-2 justify-end">
                                    <div class="me-2 cursor-pointer" @click="destroy(item.id)"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg></div>
                                </div>
                            </div>
                            <div class="text-center" v-if="listNotification.length==0">
                                Tidak adan notifikasi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
            <Footer :dataNotification="listNotification"/>
</template>
