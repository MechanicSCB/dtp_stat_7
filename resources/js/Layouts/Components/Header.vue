<script setup>
import DropdownMenuIcon from "../../Svg/DropdownMenuIcon.vue";
import {onMounted, ref} from "vue";

let showDropdownMenu = ref(false);

function toggleDropdownMenu(){
    showDropdownMenu.value = !showDropdownMenu.value;
}
</script>
<template>
    <div class="relative z-[100] bg-white flex w-full p-[13px] shadow-lg">
        <a class="mx-[3vw] h-10 flex items-center" href="/">
            <img class="w-44 max-w-[167px]" src="/images/logo.png" alt="">
        </a>
        <div class="lg:flex hidden flex-1 justify-end ml-4 flex space-x-6 pr-10">
            <ul class="flex items-center gap-5 text-[rgba(24,51,74,0.5)]">
                <Link :class="{'text-[#18334A] underline' : $page.url.startsWith('/posts')}"
                      href="/posts">Что почитать
                </Link>
                <Link :class="{'text-[#18334A] underline' : $page.url.startsWith('/charts')}"
                      href="/charts">Статистика
                </Link>
                <Link :class="{'text-[#18334A] underline' : $page.url.startsWith('/download')}"
                      href="/download">Скачать данные
                </Link>
                <Link :class="{'text-[#18334A] underline' : $page.url.startsWith('/about')}"
                      href="/about">О проекте
                </Link>
                <a class="ml-6 inline-block bg-[#18334A] text-white px-5 py-2 rounded-full text-md font-semibold"
                   href="https://dtp-stat.ru/donate/" target="_blank">Поддержать проект
                </a>
            </ul>
        </div>

        <!-- dropdown menu -->
        <div class="lg:hidden flex-1 flex items-center justify-end  text-[rgba(24,51,74,0.5)]">
            <button @click="toggleDropdownMenu" class="border p-1 rounded">
                <DropdownMenuIcon/>
            </button>
            <div class="ml-2 py-2 hidden1 flex flex-col w-full gap-y-2"
                 :class="showDropdownMenu ? 'flex':'hidden'">
                <Link href="/posts" class="block text-center" @click="showDropdownMenu=false"
                      :class="{'text-[#18334A] border-[#18334A] border-b-2' : $page.url.startsWith('/posts')}"
                >Что почитать</Link>
                <Link href="/charts" class="block text-center" @click="showDropdownMenu=false"
                      :class="{'text-[#18334A] border-[#18334A] border-b-2' : $page.url.startsWith('/charts')}"
                >Статистика</Link>
                <Link href="/download" class="block text-center" @click="showDropdownMenu=false"
                      :class="{'text-[#18334A] border-[#18334A] border-b-2' : $page.url.startsWith('/download')}"
                >Скачать данные</Link>
                <Link href="/about" class="block text-center" @click="showDropdownMenu=false"
                      :class="{'text-[#18334A] border-[#18334A] border-b-2' : $page.url.startsWith('/about')}"
                >О проекте</Link>
                <a class="-mt-2 inline-block text-center bg-[#18334A] text-white px-5 py-2 rounded-3xl text-md font-semibold"
                   href="https://dtp-stat.ru/donate/" target="_blank">Поддержать проект
                </a>
            </div>
        </div>
    </div>
</template>
