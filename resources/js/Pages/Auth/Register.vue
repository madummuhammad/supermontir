<script>
import { ref } from 'vue';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import { Link, useForm  } from '@inertiajs/vue3';
export default{

    setup(){
        const togglePassword=ref(false);
       const form = useForm({
            name: '',
            wa: '',
            email: '',
            password: '',
            password_confirmation: '',
        });
        const submit = () => {
            form
                .transform((data) => ({
                    ...data
                }))
                .post(route('register'), {
                    onFinish: () => {
                        form.reset('password');
                    }
                });
        };

        return {
            form,
            submit,
            togglePassword
        }
    },
    components:{
        Header,
        Footer,
        Link
    }
}
</script>
<template>
    <Header/>
    <section class="bg-gray-50">
      <div class="flex flex-col items-center justify-center px-6 py-8 lg:py-10">
          <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
              <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                  <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                      Daftar
                  </h1>
                  <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                      <div>
                          <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                          <input type="text" name="email" v-model="form.name" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " :class="{'border-red-700':form.errors.name}" placeholder="Nama Anda...">
                          <p class="text-red-700 text-sm">{{form.errors.name}}</p>
                        </div>
                        <div>
                          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                          <input type="email" name="email" id="email" v-model="form.email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     " :class="{ 'border-red-700': form.errors.email }" placeholder="Email Anda...">
                          <p class="text-red-700 text-sm">{{form.errors.email}}</p>
                        </div>
                        <div>
                          <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">No HP/WA</label>
                          <input type="text" name="email" id="email" v-model="form.wa" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     " :class="{ 'border-red-700': form.errors.wa }" placeholder="No HP/WA Anda...">
                          <p class="text-red-700 text-sm">{{form.errors.wa}}</p>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                            <input :type="togglePassword ? 'text' : 'password'" name="password" v-model="form.password"  :class="{ 'border-red-700': form.errors.password }" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <p class="text-red-700 text-sm">{{form.errors.password}}</p>
                        </div>
                        <div>
                            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm password</label>
                            <input :type="togglePassword ? 'text' : 'password'" name="confirm-password"  :class="{ 'border-red-700': form.errors.password_confirmation }" v-model="form.password_confirmation" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <p class="text-red-700 text-sm">{{form.errors.password_confirmation}}</p>
                      </div>
                      <div class="flex items-start">
                          <div class="flex items-center h-5">
                            <input id="terms" v-model="togglePassword" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300  ">
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500">Tampilkan sandi?</label>
                          </div>
                      </div>
                        <button type="submit"
                            class="w-full text-white bg-[#2F318B] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                            Daftar
                        </button>
                      <p class="text-sm font-light text-gray-500 ">
                          Sudah punya akun? <Link href="/login" class="font-medium text-primary-600 hover:underline ">Login disini</Link>
                      </p>
                  </form>
              </div>
          </div>
      </div>
    </section>
    <Footer/>
</template>
