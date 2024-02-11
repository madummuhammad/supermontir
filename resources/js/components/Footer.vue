<script>
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Link
    },
};
</script>
<template>
    <a href="https://wa.me/6281188812272?text=Halo%20SuperMontir,%20saya%20mau%20service%20kendaraan%20saya%20nih" target="_blank" class="fixed right-10 bottom-10">
        <img src="@assets/images/wa.svg" class="h-[50px] w-[50px]" alt="">
    </a>
                <footer class="bg-[#D9D9D9] items-center justify-between px-10 py-5 hidden md:flex">
                    <div>
                        <img src="@assets/images/logo.png" alt="" />
                        <h1 class="font-bold mt-4 text-center md:text-left">PT. Super Montir Indonesia</h1>
                        <p class=" text-center md:text-left">Ruko Permata Regency blok D no 37,<br>
                            Jl. Haji Kelik, Srengseng, Kembangan<br>
                            JAKARTA BARAT
                        </p>
                        <p class="mt-4  text-center md:text-left">
                            0811 8881 2272
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <Link class="font-bold block mt-4">Product & Service</Link>
                        <Link class="font-bold block mt-4">FAQ</Link>
                        <Link class="font-bold block mt-4">Kontak Kami</Link>
                    </div>
                </footer>
                <footer class="bg-[#D9D9D9] items-center justify-center px-10 py-5 flex md:hidden">
                    <div>
                        <img src="@assets/images/logo.png" alt="" />
                        <h1 class="font-bold mt-4 text-center md:text-left">PT. Super Montir Indonesia</h1>
                        <p class=" text-center md:text-left">Ruko Permata Regency blok D no 37,<br>
                            Jl. Haji Kelik, Srengseng, Kembangan<br>
                            JAKARTA BARAT
                        </p>
                        <p class="mt-4  text-center md:text-left">
                            0811 8881 2272
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <Link class="font-bold block mt-4">Product & Service</Link>
                        <Link class="font-bold block mt-4">FAQ</Link>
                        <Link class="font-bold block mt-4">Kontak Kami</Link>
                    </div>
                </footer>

</template>
