<style>
@import url(../../../css/style.css);
</style>
<script>
import Header from '../../components/Header.vue';
import Footer from '../../components/dashboard/Footer.vue';
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Header,
        Footer,
        Link
    },
};
</script>

<template>
    <div>
        <Header />
            <!-- hero section -->
        <div class="container-fluid md:mx-auto mb-24 mt-20 bg-[#F6FCB0] py-4">
          <div class="flex flex-col md:flex-row items-center justify-between">
            <div
              class="w-full text-center md:text-start md:w-1/2 px-4 my-8 md:my-0"
            >
              <h1 class="text-3xl md:text-5xl font-bold text-[#2F318B]">
                Service Kendaraan dirumah aja, biar kami yang datang.
              </h1>
              <p class="mt-6">
              SuperMontir hadir untuk memberikan layanan service yang lebih dari sekedar service, karena kami akan memberikan service yang Nyaman, Tanpa Antri, Transparant, Parts yang Original, Saran Perbaikan yang Jujur dan Montir yang berpengalaman.
              </p>
              <div class="flex gap-6 mt-6 justify-evenly">
                <Link href="/product" class="text-white py-2 px-5 bg-[#2F318B] flex items-center justify-center rounded-2xl">
                  <span>Home Services</span>
                </Link>
                <Link class="text-white py-2 px-5 bg-[#2F318B] flex items-center justify-center rounded-2xl">
                  <span>Layanan Darurat</span>
                </Link>
              </div>
            </div>
            <div class="w-full md:w-1/2 mt-4 md:mt-0 px-4 md:px-0">
              <img
                class="w-full h-1/2 rounded-2xl md:rounded-none"
                src="@assets/images/hero.png"
                alt=""
              />
            </div>
          </div>
        </div>

        <!-- feature -->
        <div class="container-fluid md:mx-auto mb-24">
          <div class="container mx-auto w-10/12 text-center">
            <h2 class="text-3xl font-bold text-[#2F318B] mt-6 hidden md:block">
              Kenapa harus SuperMontir
            </h2>
            <h2 class="text-2xl md:text-3xl font-bold text-[#2F318B] mt-6 block md:hidden">
             Kenapa harus SuperMontir
            </h2>
            <p class="mt-6">
             Karena SuperMontir hadir untuk memberikan service berdasarkan dari kebutuhan dari pelanggan kami
            </p>
            <div class="mt-6 flex gap-4 justify-between flex-col md:flex-row">
              <div class="md:w-1/4 border border-gray-700 md:border-0 p-2 md:block flex items-center">
                <img src="@assets/images/mudah.svg" class="md:mx-auto h-[60px] md:h-[100px] " alt="" />
                <p class="ms-2 md:ms-0 md:mt-4 text-sm text-[#2F318B] font-semibold">Mudah</p>
                <p  class="mt-4 text-[#2F318B] text-sm hidden md:block">Anda cukup menunggu dirumah, semua layanan perawatan terbaik kami bawa pada anda tanpa antri dan keluar rumah.</p>
              </div>
              <div class="md:w-1/4 border border-gray-700 md:border-0 p-2  md:block flex items-center">
                <img src="@assets/images/transparant.svg" class="md:mx-auto h-[60px] md:h-[100px] " alt="" />
                <p class="ms-2 md:ms-0 md:mt-4 text-sm text-[#2F318B] font-semibold">Transparan</p>
                <p  class="mt-4 text-[#2F318B] text-sm hidden md:block">Seluruh biaya, saran pergantian dan perbaikan jujur tanpa ada yang disembunyikan.</p>
              </div>
              <div class="md:w-1/4 border border-gray-700 md:border-0 p-2  md:block flex items-center">
                <img src="@assets/images/jaminan.svg" class="md:mx-auto h-[60px] md:h-[100px] " alt="" />
                <p class="ms-2 md:ms-0 md:mt-4 text-sm text-[#2F318B] font-semibold">Jaminan Original</p>
                <p  class="mt-4 text-[#2F318B] text-sm hidden md:block">Suku Cadang, OLI dan semua pergantian yang kami gunakan 100% original.</p>
              </div>
              <div class="md:w-1/4 border border-gray-700 md:border-0 p-2  md:block flex items-center">
                <img src="@assets/images/montir.svg" class="md:mx-auto h-[60px] md:h-[100px] " alt="" />
                <p class="ms-2 md:ms-0 md:mt-4 text-sm text-[#2F318B] font-semibold">Montir Berpengalaman</p>
                <p  class="mt-4 text-[#2F318B] text-sm hidden md:block">Untuk memastikan anda mendaptakan layanan yang memuaskan, semua montir kami memiliki pengaman > 5 tahun sebagai montir dan bersertifikasi.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- testimonials -->
        <div class="container-fluid md:mx-auto mb-24 bg-[#F6FCB0] py-4">
          <div class="container mx-auto w-10/12 text-center">
            <p class="mt-6 font-bold text-[#2F318B]">TESTIMONI</p>
            <h2 class="text-3xl font-bold mt-6 text-[#2F318B]">
              Kami memberikan lebih dari sekedar service
            </h2>
            <div class="mt-6 md:flex gap-4 justify-around">
                <div class="bg-white md:mt-0 mt-4 md:w-1/3 py-8 px-4 rounded-xl">
                    <div class="flex justify-center">
                        <div class="border border-[#000] p-4 rounded-full">
                            <img class="h-[100px] w-[100px]" src="@assets/images/user.svg" alt="">
                        </div>
                    </div>
                    <div>
                        <h1 class="font-bold">Alvin</h1>
                        <h1 class="font-bold">Jakarta Timur</h1>
                        <h1 class="font-bold">Mobil - Toyota Veloz 2017</h1>
                    </div>
                    <div class="mt-5 italic">
                        “Pesan service di supermontir gampang banget, ga perlu repot tinggal tunggu dirumah montir datang, pengerjaan nya juga rapih dan bersih”
                    </div>
                </div>
                <div class="bg-white md:mt-0 mt-4 md:w-1/3 py-8 px-4 rounded-xl">
                    <div class="flex justify-center">
                        <div class="border border-[#000] p-4 rounded-full">
                            <img class="h-[100px] w-[100px]" src="@assets/images/user.svg" alt="">
                        </div>
                    </div>
                    <div>
                        <h1 class="font-bold">Rangga</h1>
                        <h1 class="font-bold">Tanggerang Selatan</h1>
                        <h1 class="font-bold"> Mobil - Suzuki Ertiga 2016</h1>
                    </div>
                    <div class="mt-5 italic">
                       “Montir nya mas madun, kerjanya cepet, rapih dan sangat informatif banget.”
                    </div>
                </div>
              <!-- <img src="@assets/images/feature.png" class="md:w-1/3 h-32" alt="" />
              <img src="@assets/images/feature.png" class="md:w-1/3 h-32" alt="" /> -->
            </div>
            <div
              x-data="{ activeSlide: 0, images: ['@assets/images/feature.png', '@assets/images/logo.png'] }"
              class="mt-6 md:hidden"
            >
              <!-- Carousel wrapper -->
              <div class="relative">
                <!-- Slides -->
                <template x-for="(image, index) in images" :key="index">
                  <img
                    x-show="activeSlide === index"
                    :src="image"
                    class="w-full h-full object-cover"
                    alt="Slide Image"
                  />
                </template>

                <!-- Controls -->
                <button
                  @click="activeSlide = (activeSlide - 1 + images.length) % images.length"
                  class="absolute top-1/2 left-1 transform -translate-y-1/2 text-slate-800 px-4 py-2 rounded-full"
                >
                  <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button
                  @click="activeSlide = (activeSlide + 1) % images.length"
                  class="absolute top-1/2 right-1 transform -translate-y-1/2 text-slate-800 px-4 py-2 rounded-full"
                >
                  <i class="fa-solid fa-chevron-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- brand -->
        <div class="container-fluid md:mx-auto mb-24">
          <div class="grid md:grid-cols-2 grid-cols-1">
            <div>
              <div class="grid mt-8 md:px-20 text-left">
                <h2 class="text-2xl font-bold mt-2 text-[#2F318B] text-center md:text-left">
                 Layanan Perbaikan SuperMontir
                </h2>
              </div>
              <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mt-8 px-6">
                <div>
                    <img src="@assets/images/oli.svg" class="mx-auto h-[100px] mb-3" alt="" />
                    <p class="text-center font-semibold">Oli</p>
                </div>
                <div>
                    <img src="@assets/images/mesin.svg" class="mx-auto h-[100px] mb-3" alt="" />
                    <p class="text-center font-semibold">Mesin</p>
                </div>
                <div>
                    <img src="@assets/images/elektrikal.svg" class="mx-auto h-[100px] mb-3" alt="" />
                    <p class="text-center font-semibold">Elektrikal</p>
                </div>
                <div>
                   <img src="@assets/images/pengereman.svg" class="mx-auto h-[100px] mb-3" alt="" />
                    <p class="text-center font-semibold">SIstem Pengereman</p>
                </div>
                <div>
                    <img src="@assets/images/filter.svg" class="mx-auto h-[100px] mb-3" alt="" />
                    <p class="text-center font-semibold">Filter</p>
                </div>
                <div>
                    <img src="@assets/images/suspensi.svg" class="mx-auto h-[100px] mb-3" alt="" />
                    <p class="text-center font-semibold">Suspensi</p>
                </div>
              </div>
            </div>

            <!-- ... -->
            <div>
              <div class="grid mt-5 md:px-20 text-center">
                <h2 class="text-2xl font-bold mt-6 mb-2 text-[#2F318B]">
                 Kami menggunakan parts 100% Original
                </h2>
              </div>

              <div class="flex justify-center items-center gap-1 my-6">
                <hr class="w-1/3 border-t-2 border-black" />
                <p class="text-xl">OLI</p>
                <hr class="w-1/3 border-t-2 border-black" />
              </div>

              <div class="grid grid-cols-3 gap-4 mt-8 px-6">
                <img src="@assets/images/satu.png" class="mx-auto" alt="" />
                <img src="@assets/images/dua.png" class="mx-auto" alt="" />
                <img src="@assets/images/tiga.png" class="mx-auto" alt="" />
              </div>

              <div class="flex justify-center items-center gap-1 my-6">
                <hr class="w-1/3 border-t-2 border-black" />
                <p class="text-xl">PARTS</p>
                <hr class="w-1/3 border-t-2 border-black" />
              </div>
              <div class="grid grid-cols-3 gap-2 mt-8 px-6">
                <img src="@assets/images/empat.png" class="mx-auto" alt="" />
                <img src="@assets/images/lima.png" class="mx-auto" alt="" />
                <img src="@assets/images/enam.png" class="mx-auto" alt="" />
                <img src="@assets/images/tujuh.png" class="mx-auto" alt="" />
                <img src="@assets/images/delapan.png" class="mx-auto" alt="" />
              </div>
            </div>
          </div>
        </div>

        <!-- cta -->
        <div class="container-fluid md:mx-auto mt-8 bg-[#F6FCB0]">
          <div class="grid grid-cols-1 md:grid-cols-2 py-6">
            <div class="px-6">
              <h2 class="text-3xl font-bold mt-6 text-[#2F318B]">
               Segera pesanan layanan Kami
              </h2>
              <p class="mt-6 text-[#2F318B]">
                Dapatkan semua Layanan Service kami hanya dalam satu kali klik
              </p>
            </div>
    <div class="flex flex-wrap gap-6 px-5 md:px-0 mt-6 justify-evenly items-center h-2/3 md:h-1/2">
        <Link href="/product" class="text-white py-2 w-[160px] text-center px-5 md:mb-0 mb-3 bg-[#2F318B] block md:flex items-center justify-center rounded-2xl">
            <span>Home Service</span>
        </Link>
        <Link class="text-white py-2 px-5 md:mb-0 mb-3  w-[160px] text-center block bg-[#2F318B] md:flex items-center justify-center rounded-2xl">
            <span>Layanan Darurat</span>
        </Link>
    </div>

          </div>
        </div>
        <Footer />
    </div>
</template>
