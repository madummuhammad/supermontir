<script>
import { ref  } from 'vue';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import { Link, useForm } from '@inertiajs/vue3';
export default {
    setup() {
        const togglePassword = ref(false);
        const form = useForm({
            email: '',
            password: '',
        });

          const submit = () => {
            form
                .transform((data) => ({
                    ...data
                }))
                .post(route('login'), {
                    onFinish: () => {
                        // form.reset('password');
                    }
                });
        };

        return{
            togglePassword,
            submit,
            form
        }
    },
    components: {
        Header,
        Footer,
        Link
    }
}
</script>
<template>
    <Header />
    <section class="bg-gray-50 mt-20">
        <div class="flex flex-col items-center justify-center px-6 py-8 lg:py-10">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Login
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="#" @submit.prevent="submit">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                            <input type="email" v-model="form.email" name="email" id="email" :class="{ 'border-red-700': form.errors.email }"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     "
                            placeholder="Email Anda...">
                            <p class="text-red-700 text-sm">{{ form.errors.email }}</p>
                        </div>
                       <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                                <input :type="togglePassword ? 'text' : 'password'" name="password" v-model="form.password"  :class="{ 'border-red-700': form.errors.password }" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                <p class="text-red-700 text-sm">{{ form.errors.password }}</p>
                            </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" aria-describedby="terms" type="checkbox"  v-model="togglePassword"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300  "
                                   >
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-gray-500" >Tampilkan sandi?</label>
                            </div>
                    </div>
                   <button type="submit"
                                class="w-full text-white bg-[#2F318B] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                                Login
                            </button>
                    <p class="text-sm font-light text-gray-500 ">
                        Belum punya akun? <Link href="/register" class="font-medium text-primary-600 hover:underline ">Daftar
                            disini</Link>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<Footer /></template>
