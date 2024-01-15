<style>
@import url(../../../css/style.css);
</style>
<script>
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
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
        <div class="container-fluid md:mx-auto mb-24 mt-20">
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
            <h2 class="text-3xl md:hidden font-bold mt-6">
              Kenapa harus SuperMontir
            </h2>
            <h2 class="text-2xl md:text-3xl font-bold mt-6">
             Kenapa harus SuperMontir
            </h2>
            <p class="mt-6">
             Karena SuperMontir hadir untuk memberikan service berdasarkan dari kebutuhan dari pelanggan kami
            </p>
            <div class="mt-6 flex gap-4 justify-between flex-col md:flex-row">
              <div class="md:w-1/4 border border-gray-700 md:border-0 p-2">
                <img src="@assets/images/feature.png" class="md:mx-auto" alt="" />
              </div>
              <div class="md:w-1/4 border border-gray-700 md:border-0 p-2">
                <img src="@assets/images/feature.png" class="md:mx-auto" alt="" />
              </div>
              <div class="md:w-1/4 border border-gray-700 md:border-0 p-2">
                <img src="@assets/images/feature.png" class="md:mx-auto" alt="" />
              </div>
              <div class="md:w-1/4 border border-gray-700 md:border-0 p-2">
                <img src="@assets/images/feature.png" class="md:mx-auto" alt="" />
              </div>
            </div>
          </div>
        </div>

        <!-- testimonials -->
        <div class="container-fluid md:mx-auto mb-24">
          <div class="container mx-auto w-10/12 text-center">
            <p class="mt-6 font-bold">TESTIMONIALS</p>
            <h2 class="text-3xl font-bold mt-6">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bibendum amet
              at molestie mattis.
            </h2>
            <div
              class="hidden mt-6 md:flex gap-4 justify-around flex-auto flex-wrap"
            >
              <img src="@assets/images/feature.png" class="md:w-1/3 h-32" alt="" />
              <img src="@assets/images/feature.png" class="md:w-1/3 h-32" alt="" />
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
              <div class="grid mt-8 px-20 text-center">
                <p class="mt-6 font-bold text-blue-700">CAPTION</p>
                <h2 class="text-3xl font-bold mt-6">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </h2>
              </div>
              <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mt-8 px-6">
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
              </div>
            </div>

            <!-- ... -->
            <div>
              <div class="grid mt-8 px-20 text-center">
                <p class="mt-6">Parts yang kami gunakan</p>
                <h2 class="text-3xl font-bold mt-6">
                  Bibendum amet at molestie mattis.
                </h2>
              </div>

              <div class="flex justify-center items-center gap-1 my-6">
                <hr class="w-1/3 border-t-2 border-black" />
                <p class="text-xl">OLI</p>
                <hr class="w-1/3 border-t-2 border-black" />
              </div>

              <div class="grid grid-cols-3 gap-4 mt-8 px-6">
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
              </div>

              <div class="flex justify-center items-center gap-1 my-6">
                <hr class="w-1/3 border-t-2 border-black" />
                <p class="text-xl">PARTS</p>
                <hr class="w-1/3 border-t-2 border-black" />
              </div>
              <div class="grid grid-cols-3 gap-2 mt-8 px-6">
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
                <img src="@assets/images/feature.png" class="mx-auto" alt="" />
              </div>
            </div>
          </div>
        </div>

        <!-- cta -->
        <div class="container-fluid md:mx-auto my-8">
          <div class="grid grid-cols-1 md:grid-cols-2 py-6">
            <div class="px-6">
              <h2 class="text-3xl font-bold mt-6">
                Bibendum amet at molestie mattis.
              </h2>
              <p class="mt-6">
                Rhoncus morbi et augue nec, in id ullamcorper at sit.
              </p>
            </div>
            <div class="flex gap-6 mt-6 justify-evenly h-2/3 md:h-1/2">
              <button type="button" class="hero-button">
                <span class="px-1"
                  ><i class="fa-regular fa-circle fa-2xl" style="color: #303030"></i
                ></span>
                <span>Home Services</span>
              </button>
              <button type="button" class="hero-button">
                <span class="px-1"
                  ><i class="fa-regular fa-circle fa-2xl" style="color: #303030"></i
                ></span>
                <span>Layanan Darurat</span>
              </button>
            </div>
          </div>
        </div>

        <Footer />
    </div>
</template>
