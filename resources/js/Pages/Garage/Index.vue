<style>
@import url(../../../css/style.css);
</style>
<script>
import Header from '../../components/dashboard/Header.vue';
import Sidebar from '../../components/dashboard/Sidebar.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
const page = usePage()
import { useForm } from '@inertiajs/vue3';
import Footer from '../../components/dashboard/Footer.vue';

export default {
    props: {
        profile: Object,
        success: String
    },
    setup(props) {
        const modalAddGarageShow=ref(false)
        const modalEditGarageShow=ref(false)

        const form=(useForm({
            merk:'',
            type:'',
            plat:'',
            km:'',
            year:'',
            vehicle_type:'Mobil'
        }));

        let formEdit=ref({
            merk: 'asdf',
            type: '',
            plat: '',
            km: '',
            year: '',
            vehicle_type: 'Mobil'
        });

        const listGarage=ref([]);

        const getVehicle = () => {
            axios.get('/api/garage/get')
                .then(response => {
                    console.log(response.data)
                    listGarage.value=response.data.data;
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }



        onMounted(() => {
            getVehicle();
        });

        const submit = () => {
            console.log('form',form)
            form
                .transform((data) => ({
                    ...data
                }))
                .post(route('garage.store'), {
                    onSuccess: (response) => {
                        console.log(page.props.flash)
                        modalAddGarageShow.value=false;
                        getVehicle();
                    }
                });
            };
        const update = () => {
            formEdit.value
                .transform((data) => ({
                    ...data
                }))
                .patch(route('garage.update'), {
                    onSuccess: (response) => {
                        getVehicle();
                        console.log(page.props.flash)
                        modalEditGarageShow.value=false;
                    }
                });
        };


        const deleteGarage = () => {
            formDelete.value
                .transform((data) => ({
                    ...data
                }))
                .post(route('garage.delete'), {
                    onFinish: (response) => {
                        getVehicle();
                        console.log(page.props.flash)
                        modalDeleteShow.value = false;
                    }
                });
        };

        const openModalEdit=(data)=>{
            modalEditGarageShow.value=true;
            console.log('data',data)
            formEdit.value=useForm(data);
            console.log(formEdit)
            console.log('form',form)
        }

        let formDelete = ref({
            id: ''
        });

        const modalDeleteShow=ref(false)
        const openModalDelete=(id)=>{
            modalDeleteShow.value=true;
            formDelete.value=useForm({id:id})
        }

        const addGarageData=ref({
            type:'Mobil'
        });

        const changeType=(type)=>{
            addGarageData.value.type=type
            form.vehicle_type=type;
        }
        const changeEditType =(type)=>{
            formEdit.value.vehicle_type=type
        }

        return {
            form,
            getVehicle,
            formDelete,
            openModalDelete,
            modalDeleteShow,
            submit,
            update,
            page,
            deleteGarage,
            modalAddGarageShow,
            addGarageData,
            modalEditGarageShow,
            changeType,
            changeEditType,
            openModalEdit,
            formEdit,
            listGarage
        }
    },
    mounted() {

    },
    components: {
        Header,
        Sidebar,
        Link,
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
                    <div class="bg-white p-6 rounded-lg shadow-md text-center w-full" id="content">
                        <div class="md:flex flex-row justify-between items-center border-b-2 pb-2">
                            <h1 class="md:text-xl text-lg font-semibold mb-4">
                                Daftar Kendaraan Garasi
                            </h1>
                            <div class="flex justify-center">
                                <button @click="modalAddGarageShow=!modalAddGarageShow" class="px-4 py-2 text-white rounded-md bg-[#2F318B] flex flex-row">
                                    <i class="fa-solid fa-plus fa-lg"></i>
                                    <span class="block">Tambah Kendaraan</span>
                                </button>
                            </div>
                            <div class="modal fixed inset-0 px-2 md:px-0 z-50 overflow-auto bg-gray-500 bg-opacity-50" v-if="modalAddGarageShow">
                                <div class="modal-content bg-white md:mx-auto my-10 p-6 rounded md:w-1/2">
                                    <form @submit.prevent="submit" method="post">
                                        <p class="text-xl font-bold text-[#2F318B] mb-3">PILIH JENIS KENDARAAN ANDA</p>
                                        <div class="flex justify-between text-center">
                                            <div class="w-full cursor-pointer fw-bold" :class="{'border-b-2':addGarageData.type=='Mobil'}" @click="changeType('Mobil')">MOBIL</div>
                                            <div class="w-full cursor-pointer fw-bold" :class="{ 'border-b-2': addGarageData.type == 'Sepeda Motor' }" @click="changeType('Sepeda Motor')">MOTOR</div>
                                        </div>
                                        <div class="p-3" v-if="addGarageData.type=='Mobil'">
                                            <div class="mb-2">
                                            <div for="name" class="text-gray-700 text-left mb-2">Merek Kendaraan</div>
                                        <div>
                            <input type="text" v-model="form.merk" name="name" id="name" placeholder="Contoh: Mitsubishi" class="border-2 w-full border-gray-300 rounded-md " :class="{ 'border-red-700': form.errors.merk }">
                            <p class="text-red-700 text-sm text-left">{{ form.errors.merk }}</p>
                        </div>
                    </div>
                        <div class="mb-2">
                        <div for="name" class="text-gray-700 text-left mb-2">Tipe Kendaraan</div>
                        <div>
                            <input type="text" name="name" v-model="form.type" id="name" placeholder="Contoh: L300" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': form.errors.type }"/>
                            <p class="text-red-700 text-sm text-left">{{ form.errors.type }}</p>

                        </div>
                    </div>
                        <div class="mb-2">
                            <div for="name" class="text-gray-700 text-left mb-2">No Plat</div>
                            <div>
                                <input type="text" name="name" v-model="form.plat" id="name" placeholder="Contoh: B 1234 Z" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': form.errors.plat }"/>
                                <p class="text-red-700 text-sm text-left">{{ form.errors.plat }}</p>

                            </div>
                        </div>
                        <div class="mb-2">
                            <div for="name" class="text-gray-700 text-left mb-2">Tahun</div>
                            <div>
                                <input type="text" name="name" v-model="form.year" id="name" placeholder="Contoh: 2010" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': form.errors.year }"/>
                                <p class="text-red-700 text-sm text-left">{{ form.errors.year }}</p>

                            </div>
                        </div>
                        <div class="mb-2">
                            <div for="name" class="text-gray-700 text-left mb-2">KM</div>
                            <div>
                                <input type="text" name="name" v-model="form.km" id="name" placeholder="Contoh: 10000" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': form.errors.km }"/>
                                <p class="text-red-700 text-sm text-left">{{ form.errors.km }}</p>

                            </div>
                        </div>

                    </div>
                <div class="p-3" v-if="addGarageData.type=='Sepeda Motor'">
                        <div class="mb-2">
                        <div for="name" class="text-gray-700 text-left mb-2">Merek Kendaraan</div>
                        <div>
                            <input type="text" v-model="form.merk" name="name" id="name" placeholder="Contoh: Honda" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': form.errors.merk }"/>

                            <p class="text-red-700 text-sm text-left">{{ form.errors.merk }}</p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div for="name" class="text-gray-700 text-left mb-2">Tipe Kendaraan</div>
                        <div>
                            <input type="text" name="name" v-model="form.type" id="name" placeholder="Contoh: Supra X" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': form.errors.type }"/>
                            <p class="text-red-700 text-sm text-left">{{ form.errors.type }}</p>

                        </div>
                    </div>
                    <div class="mb-2">
                        <div for="name" class="text-gray-700 text-left mb-2">No Plat</div>
                        <div>
                            <input type="text" name="name" v-model="form.plat" id="name" placeholder="Contoh: B 1234 Z" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': form.errors.plat }"/>
                            <p class="text-red-700 text-sm text-left">{{ form.errors.plat }}</p>

                        </div>
                    </div>
                    <div class="mb-2">
                                <div for="name" class="text-gray-700 text-left mb-2">Tahun</div>
                                <div>
                                    <input type="text" name="name" v-model="form.year" id="name" placeholder="Contoh: 2010" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': form.errors.year }"/>
                                    <p class="text-red-700 text-sm text-left">{{ form.errors.year }}</p>

                                </div>
                            </div>
                            <div class="mb-2">
                                <div for="name" class="text-gray-700 text-left mb-2">KM</div>
                                <div>
                                    <input type="text" name="name" v-model="form.km" id="name" placeholder="Contoh: 10000" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': form.errors.km }"/>
                                    <p class="text-red-700 text-sm text-left">{{ form.errors.km }}</p>

                                </div>
                            </div>
                </div>
                <div class="flex justify-between">
                    <button @click="modalAddGarageShow = !modalAddGarageShow" class="px-4 py-2 text-white w-full mx-3 text-center rounded-md bg-gray-500 ">
                  Batal
                 </button>
                    <button class="px-4 py-2 text-white w-full mx-3 rounded-md bg-[#2F318B] text-center"   :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                   Simpan
                 </button>
                </div>
            </form>
            </div>
        </div>
                  <div class="modal fixed inset-0 px-2 md:px-0 z-50 overflow-auto bg-gray-500 bg-opacity-50" v-if="modalDeleteShow">
                <div class="modal-content bg-white md:mx-auto my-10 p-6 rounded mx-2 md:w-1/2">
                    <form @submit.prevent="deleteGarage" method="post">
                    <p class="text-xl font-bold text-[#2F318B] mb-3">Anda yakin akan menghapus?</p>
                    <div class="flex justify-between">
                        <button @click="modalDeleteShow = !modalDeleteShow" class="px-4 py-2 text-white w-full mx-3 text-center rounded-md bg-gray-500 ">
                      Batal
                     </button>
                        <button class="px-4 py-2 text-white w-full mx-3 rounded-md bg-red-700 text-center"   :class="{ 'opacity-50': formDelete.processing }" :disabled="formDelete.processing">
                       DELETE
                     </button>
                    </div>
                </form>
                </div>
            </div>
         <div class="modal fixed inset-0 z-50 px-2 md:px-0 overflow-auto bg-gray-500 bg-opacity-50" v-if="modalEditGarageShow">
                <div class="modal-content bg-white md:mx-auto w-full my-10 p-6 rounded md:w-1/2">
                    <form @submit.prevent="update" method="post">
                    <p class="text-xl font-bold text-[#2F318B] mb-3">UBAH KENDARAAN ANDA</p>
                    <div class="p-3" v-if="formEdit.vehicle_type == 'Mobil'">
                            <div class="mb-2">
                            <div for="name" class="text-gray-700 text-left mb-2">Merek Kendaraan</div>
                            <div>
                                <input type="text" v-model="formEdit.merk" name="name" id="name" placeholder="Contoh: Mitsubishi" class="border-2 w-full border-gray-300 rounded-md " :class="{ 'border-red-700': formEdit.errors.merk }">
                                <p class="text-red-700 text-sm text-left">{{ formEdit.errors.merk }}</p>
                            </div>
                        </div>
                            <div class="mb-2">
                            <div for="name" class="text-gray-700 text-left mb-2">Tipe Kendaraan</div>
                            <div>
                                <input type="text" name="name" v-model="formEdit.type" id="name" placeholder="Contoh: L300" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': formEdit.errors.type }"/>
                                <p class="text-red-700 text-sm text-left">{{ formEdit.errors.type }}</p>

                            </div>
                        </div>
                            <div class="mb-2">
                                <div for="name" class="text-gray-700 text-left mb-2">No Plat</div>
                                <div>
                                    <input type="text" name="name" v-model="formEdit.plat" id="name" placeholder="Contoh: B 1234 Z" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': formEdit.errors.plat }"/>
                                    <p class="text-red-700 text-sm text-left">{{ formEdit.errors.plat }}</p>

                                </div>
                            </div>
                                <div class="mb-2">
                                <div for="name" class="text-gray-700 text-left mb-2">Tahun</div>
                                <div>
                                    <input type="text" name="name" v-model="formEdit.year" id="name" placeholder="Contoh: 2010" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': formEdit.errors.year }"/>
                                    <p class="text-red-700 text-sm text-left">{{ formEdit.errors.year }}</p>

                                </div>
                            </div>
                            <div class="mb-2">
                                <div for="name" class="text-gray-700 text-left mb-2">KM</div>
                                <div>
                                    <input type="text" name="name" v-model="formEdit.km" id="name" placeholder="Contoh: 10000" class="border-2 w-full border-gray-300 rounded-md p-2" :class="{ 'border-red-700': formEdit.errors.km }"/>
                                    <p class="text-red-700 text-sm text-left">{{ formEdit.errors.km }}</p>

                                </div>
                            </div>

                        </div>
                    <div class="flex justify-between">
                        <button @click="modalEditGarageShow = !modalEditGarageShow" class="px-4 py-2 text-white w-full mx-3 text-center rounded-md bg-gray-500 ">
                      Batal
                     </button>
                        <button class="px-4 py-2 text-white w-full mx-3 rounded-md bg-[#2F318B] text-center"   :class="{ 'opacity-50': formEdit.processing }" :disabled="formEdit.processing">
                       Simpan
                     </button>
                    </div>
                </form>
                </div>
            </div>
    </div>
    <div v-if="page.props.flash && page.props.flash.message">
        <div v-if="page.props.flash.message.status === 'success'" class="bg-green-500 py-2 px-4 text-white font-bold rounded-md mb-2">
                    {{ page.props.flash.message.message }}
                  </div>
                </div>
        <!-- table -->
        <div class="overflow-x-auto">
          <div class="w-full">
            <div class="w-full mt-2">
                <div class="py-2 border p-2 mb-3" v-for="(item,index) in listGarage">
                    <div class=" text-left">
                        <div class="font-bold mb-3">{{ item.merk }}</div>
                        <table class="mb-3">
                            <tr>
                                <td>Type</td>
                                <td>: {{item.vehicle_type }}</td>
                            </tr>
                        </table>
                        <div class="block md:flex w-full justify-between">
                            <table class="w-full mb-3">
                                <tr>
                                    <td><span class="font-bold">Tahun : </span>{{ item.year }}</td>
                                </tr>
                            </table>
                            <table class="w-full mb-3">
                                <tr>
                                    <td><span class="font-bold">No Pol : </span>{{ item.plat }}</td>
                                </tr>
                            </table>
                            <table class="w-full mb-3">
                                <tr>
                                    <td><span class="font-bold">Kilometer : </span>{{ item.km }}</td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <Link :href="'garage/show/'+item.id" class="text-[#1c2e96] font-bold">Detail</Link>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <div class="flex ">
                        <a @click="openModalEdit(item)" class="me-5 cursor-pointer"><i class="fa-regular fa-pen-to-square text-orange-500 md:ml-2" ><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></i></a>
                        <a  class="me-2 cursor-pointer" @click="openModalDelete(item.id)"><i class="fa-solid fa-trash-can text-orange-500 md:ml-2"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg></i></a>
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
