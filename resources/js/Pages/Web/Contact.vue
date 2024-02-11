<script>
import { ref } from 'vue';
import Header from '../../components/Header.vue';
import Footer from '../../components/dashboard/Footer.vue';
import { Link, useForm } from '@inertiajs/vue3';
export default {
    setup() {


        return {

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
        <section class=" mt-20 w-full my-10">
            <h1 class="font-bold text-center text-xl mb-8">Kontak Kami</h1>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="me-5 flex justify-center">
                    <img class="h-[300px]" src="@assets/images/feature.png" alt="" />
                </div>
                    <div>
                        <h1 class="font-bold mt-4 text-center md:text-left text-[#2F318B]">JAKARTA BARAT</h1>
                        <p class=" text-center md:text-left font-semibold">Ruko Permata Regency blok D no 37,<br>
                            Jl. Haji Kelik, Srengseng, Kembangan<br>
                            JAKARTA BARAT
                        </p>
                        <p class="mt-4  text-center md:text-left">
                            Telepon: +6281188812272
                        </p>
                        <p class="text-center md:text-left">
                            Email: example@gmail.com
                        </p>
                    </div>
            </div>
    </section>
<Footer />
</template>
