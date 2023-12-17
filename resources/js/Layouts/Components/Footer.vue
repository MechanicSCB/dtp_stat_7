<script setup>
import TwitterLogo from "../../Svg/TwitterLogo.vue";
import TelegramLogo from "../../Svg/TelegramLogo.vue";
import CityProjectsLogo from "../../Svg/CityProjectsLogo.vue";
import CenterCityProjectsLogo from "../../Svg/CenterCityProjectsLogo.vue";
import CreativeCommonLogo from "../../Svg/CreativeCommonLogo.vue";
import CreativeCommonManLogo from "../../Svg/CreativeCommonManLogo.vue";
import GithubLogo from "../../Svg/GithubLogo.vue";
</script>
<template>
    <div class="mt-12 w-full bg-[#F4F8FA]">
        <div class="mx-auto xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] max-w-[540px] pt-4 text-[#18334A]">
            <div class="mx-4 flex flex-wrap">
                <div class="flex flex-col lg:w-1/2 w-full mb-4">
                    <div class="max-h-[25px]">
                        <img src="/images/logo_full.png" class="h-full">
                    </div>
                    <div class="my-4 font-semibold pr-2">
                        Проект посвящен проблеме дорожно-транспортных происшествий в&nbsp;России. Цель проекта —
                        повышение безопасности дорожного движения и снижение смертности в ДТП.
                    </div>
                </div>
                <div class="lg:w-1/2 w-full mb-4 max-w-[470px]">
                    <h3 class="mt-3 text-[20px] font-bold">Сбор пожертвований на проект</h3>
                    <div class="h-4 mt-5 flex bg-[#e9ecef] rounded-full mb-1">
                        <div class="progress-bar rounded-full" style="width: 88.1428%; background-size: 450px;"></div>
                    </div>
                    <div class="flex items-center text-[13px]">
                        <div>Собрано: 264&nbsp;428р. из 300&nbsp;000р.</div>
                        <div class="flex-1 text-right text-[rgba(24,51,74,0.5)]">До конца сбора 18 дней</div>
                    </div>
                    <div class="my-4 text-right">
                        <a class="inline-block bg-[#18334A] text-white px-5 py-2 rounded-full text-md font-semibold"
                           href="https://dtp-stat.ru/donate/" target="_blank">Поддержать проект
                        </a>
                    </div>
                </div>
            </div>
            <div class="mx-4 flex flex-wrap gap-x-6">
                <div class="mb-5 lg:w-1/2 w-full">
                    <h3 class="mt-3 text-[20px] font-bold">Мы в социальных сетях</h3>
                    <div class="mt-4 flex flex-wrap gap-x-4 gap-y-1">
                        <a href="https://twitter.com/dtp_stat" target="_blank" class="flex items-center bg-[#EBEEF0] rounded-2xl px-4 py-1 hover:bg-gray-300 cursor-pointer">
                            <TwitterLogo class="w-4 h-4 fill-[#18334A]"/>&nbsp;Карта&nbsp;ДТП&nbsp;в&nbsp;Twitter
                        </a>

                        <a href="https://t.me/dtp_stat" target="_blank" class="flex items-center bg-[#EBEEF0] rounded-2xl px-4 py-1 hover:bg-gray-300 cursor-pointer">
                            <TelegramLogo class="w-5 h-5 fill-[#18334A]"/>&nbsp;Карта&nbsp;ДТП&nbsp;в&nbsp;Telegram
                        </a>
                    </div>
                </div>
                <div class="mb-5">
                    <h3 class="mt-3 text-[20px] font-bold">Наши партнёры</h3>
                    <div class="flex items-center gap-6">
                        <a href="https://city4people.ru/" target="_blank">
                            <CityProjectsLogo class="w-36 h-14 grayscale hover:grayscale-0"/>
                        </a>
                        <a href="http://shtab.co/" target="_blank">
                            <CenterCityProjectsLogo class="w-36 h-14"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-8">

        <div class="mx-auto xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] max-w-[540px] py-4 text-[rgba(24,51,74,0.5)]">
            <div class="flex md:flex-row flex-col gap-y-8">
                <div class="flex mx-4 md:w-1/2">
                    <div class="mt-1 flex gap-1.5">
                        <CreativeCommonLogo  class="fill-[rgba(24,51,74,0.5)] w-8 h-8"/>
                        <CreativeCommonManLogo  class="fill-[rgba(24,51,74,0.5)] w-8 h-8"/>
                        <a href="https://github.com/dtpstat" target="_blank">
                            <GithubLogo class="fill-[rgba(24,51,74,0.5)] w-8 h-8 hover:border-b"/>
                        </a>
                    </div>
                    <div class="ml-10 text-sm">
                        Использование материалов возможно с указанием активной ссылки на сайт
                    </div>
                </div>
                <div class="flex flex-wrap mx-4 md:w-1/2 gap-3">
                    <Link class="hover:underline" href="/posts">Что&nbsp;почитать</Link>
                    <Link class="hover:underline" href="/charts">Статистика</Link>
                    <Link class="hover:underline" href="/download">Скачать&nbsp;данные</Link>
                    <Link class="hover:underline" href="/about">О&nbsp;проекте</Link>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.progress-bar {
    background: linear-gradient(to right, red 0%, yellow 50%, green 100%);
    background-color: rgba(0, 0, 0, 0);
    background-position-x: 0%;
    background-position-y: 0%;
    background-repeat: repeat;
    background-attachment: scroll;
    background-image: linear-gradient(to right, red 0%, yellow 50%, green 100%);
    background-size: auto;
    background-origin: padding-box;
    background-clip: border-box;
    background-color: inherit !important;
}
</style>
