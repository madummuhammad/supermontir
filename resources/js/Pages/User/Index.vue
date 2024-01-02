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
    props:{
        profile:Object,
        success:String
    },
    setup(props){
        const form=useForm({
            name: props.profile.name,
            wa: props.profile.wa,
            email: props.profile.email,
            jenis_kelamin: props.profile.jenis_kelamin,
            tanggal_lahir: props.profile.tanggal_lahir,
            image:props.profile.image
        })

        const handleImageChange=async (event)=>{

            try {
                const file=event.target.files[0];
                const formData=new FormData();
                formData.append('image',file);
                const response=await axios.post('/api/profile/upload',formData);
                const data=response.data;
                form.image=data.data;
                console.log(response.data)
            } catch (error) {
                console.log(error)
            }
        }

        const submit = () => {
            form
                .transform((data) => ({
                    ...data
                }))
                .patch(route('user.update'), {
                    onFinish: (response) => {
                        console.log(page.props.flash)
                    }
                });
        };

        return{
            form,
            submit,
            handleImageChange,
            page
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
    <Header/>
        <div class="container-fluid  bg-slate-300 pt-5 md:pb-0 pb-24">
          <div class="container mx-auto mt-20 md:mt-5">
            <div class="flex justify-center gap-5">
                <Sidebar/>

              <div class="md:w-2/3 w-11/12">
                <div
                  class="bg-white p-6 rounded-lg shadow-md text-center w-full"
                  id="content"
                >
                    <div class="text-left border-b-2 pb-2 mb-6">
                        <div v-if="page.props.flash && page.props.flash.message">
          <!-- Cek apakah status adalah 'success' -->
          <div v-if="page.props.flash.message.status === 'success'" class="bg-green-500 py-2 px-4 text-white font-bold rounded-md mb-2">
            {{ page.props.flash.message.message }}
          </div>
        </div>
                        <h1 class="md:text-xl text-lg font-semibold">Profile Saya</h1>
                        <p class="text-gray-500">
                            Kelola informasi profile and untuk mengontrol, melindungi danmengamankan akun.</p>
        </div>

        <!-- table -->
        <div class="overflow-x-auto w-full">
          <div class="w-full flex md:flex-row flex-col">
             <div class="md:hidden md:w-1/3 w-ful flex justify-center items-center flex-col">
                  <img v-if="form.image == null" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="" class="w-36 h-36 rounded-full object-cover mb-4"/>
                  <img v-if="form.image !== null" :src="form.image" alt="" class="w-36 h-36 rounded-full object-cover mb-4"/>
                  <input type="file" @change="handleImageChange" accept=".png,.jpg,.jpeg" id="gambar" hidden>
                  <label class="button-primary cursor-pointer" for="gambar">Pilih Gambar</label>
                  <p class="text-sm text-gray-500 mt-2">Ukuran gambar: maks 1 MB</p>
                  <p class="text-sm text-gray-500">Format gambar: jpeg, png</p>
                </div>
            <form
             @submit.prevent="submit"
              class="md:w-2/3 w-full px-4 text-left md:border-e-2 mb-4"
            >
              <div class="md:flex flex-row mb-2">
                <label for="name" class="text-gray-500 w-1/3">Nama</label>
                <div class="w-full md:w-2/3">
                    <input v-model="form.name"
                      type="text"
                      name="name"
                      id="name"
                      class="border-2 w-full border-gray-300 rounded-md p-2"
                    />
                    <p class="text-red-700 text-sm">{{ form.errors.name }}</p>
                </div>
            </div>
            <div class="md:flex flex-row mb-2">
                <label for="email" class="text-gray-500 w-1/3">Email</label>
                <div class="w-full md:w-2/3">
                    <input v-model="form.email"
                    type="text"
                      name="email"
                      id="email"
                      class="border-2 w-full border-gray-300 rounded-md p-2"
                      />
                      <p class="text-red-700 text-sm">{{ form.errors.email }}</p>
                </div>
                </div>
                <div class="md:flex flex-row mb-2">
                <label for="telp" class="text-gray-500 w-1/3">No. Telepon</label>
                <div class="w-full md:w-2/3">
                    <input v-model="form.wa"
                      type="text"
                      name="telp"
                      id="telp"
                      class="border-2 border-gray-300 w-full rounded-md p-2"
                      />
                      <p class="text-red-700 text-sm">{{ form.errors.wa }}</p>
                    </div>
                </div>
              <!-- jenis kelamin -->
              <div class="md:flex flex-row mb-2">
                <label for="gender" class="text-gray-500 w-1/3"
                  >Jenis Kelamin</label
                >
                <div class="w-full md:w-2/3">
                    <select
                      name="gender"
                      id="gender"  v-model="form.jenis_kelamin"
                      class="border-2 border-gray-300 w-full rounded-md p-2"
                    >
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <p class="text-red-700 text-sm">{{ form.errors.jenis_kelamin }}</p>
            </div>
        </div>
              <!-- tanggal lahir -->
              <div class="md:flex flex-row mb-2">
                <label for="birthdateDay" class="text-gray-500 w-1/3"
                  >Tgl. Lahir</label
                >
                <div class="w-full md:w-2/3">
                    <input
                         type="date" v-model="form.tanggal_lahir"
                         name="telp"
                         id="telp"
                         class="border-2 border-gray-300 w-full rounded-md p-2"
                         />
                         <p class="text-red-700 text-sm">{{ form.errors.tanggal_lahir }}</p>
                </div>
                <!-- <div class="flex items-center w-2/3 space-x-2">
                  <input
                    type="number"
                    name="birthdateDay"
                    id="birthdateDay"
                    class="border-2 border-gray-300 w-1/3 rounded-md p-2"
                    value="1"
                    min="1"
                    max="31"
                  />
                  <select
                    name="birthdateMonth"
                    id="birthdateMonth"
                    class="border-2 border-gray-300 w-1/3 rounded-md p-2"
                  >
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                  </select>
                  <input
                    type="number"
                    name="birthdateYear"
                    id="birthdateYear"
                    class="border-2 border-gray-300 w-1/3 rounded-md p-2"
                    value="1940"
                    min="1900"
                    max="2100"
                  />
                </div> -->
              </div>

              <div class="md:flex justify-between gap-2 mt-5">
                <button type="submit" class="bg-[#2F318B] px-12 py-4 rounded-md font-bold text-white w-full md:w-auto">Simpan</button>
                <button type="submit" class="button-secondary text-center w-full md:w-auto">
                  Ubah Kata Sandi
                </button>
              </div>
            </form>
            <!-- avatar image upload -->
            <div class="hidden md:w-1/3 w-ful md:flex justify-center items-center flex-col">
              <img v-if="form.image==null" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="" class="w-36 h-36 rounded-full object-cover mb-4"/>
              <img v-if="form.image!==null" :src="form.image" alt="" class="w-36 h-36 rounded-full object-cover mb-4"/>
              <input type="file" @change="handleImageChange" accept=".png,.jpg,.jpeg" id="gambar" hidden>
              <label class="button-primary cursor-pointer" for="gambar">Pilih Gambar</label>
              <p class="text-sm text-gray-500 mt-2">Ukuran gambar: maks 1 MB</p>
              <p class="text-sm text-gray-500">Format gambar: jpeg, png</p>
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
