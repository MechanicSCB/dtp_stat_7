<script setup>
import Header from "./Components/Header.vue";
import Footer from "./Components/Footer.vue";
</script>

<template>
    <Header/>
    <slot/>
    <Footer v-show="$page.component !== 'Map/Index'"/>
</template>
