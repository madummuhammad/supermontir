<template>
<footer class="bg-gray-300 p-4 flex justify-center md:justify-start py-4">
      <img src="@assets/images/logo.png" alt="" />
    </footer>
    <!-- Bottom Bar -->
<div
      x-data="{ isMobile: window.innerWidth <= 768 }"
      x-init="() => { window.addEventListener('resize', () => { isMobile = window.innerWidth <= 768 }) }"
      class="fixed bottom-0 left-0 right-0 bg-white px-4 py-6 text-blue-500 shadow-md flex items-center justify-between md:hidden"
      x-show="isMobile"
    >
      <!-- Icon Menu 1 -->
      <a href="#" class="flex items-center justify-center mx-2">
        <i class="fa-solid fa-home fa-lg"></i>
      </a>
      <!-- Icon Menu 2 -->
      <a href="#" class="flex items-center justify-center mx-2">
        <i class="fa-solid fa-gift fa-lg"></i>
      </a>
      <!-- Icon Menu 3 -->
      <a href="#" class="flex items-center justify-center mx-2">
        <i class="fa-solid fa-warehouse fa-lg"></i>
      </a>
      <!-- Icon Menu 4 -->
      <a href="#" class="flex items-center justify-center mx-2">
        <i class="fa-solid fa-bell fa-lg"></i>
      </a>
      <!-- Icon Menu 5 -->
      <a href="#" class="flex items-center justify-center mx-2">
        <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
      </a>
    </div>
</template>
