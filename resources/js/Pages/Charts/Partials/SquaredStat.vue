<script setup>
let props = defineProps({mainStat: Object});
let labels = {
    number_of_points: 'ДТП',
    participants_count: 'чел. участников ДТП',
    dead_count: 'человек погибло',
    injured_count: 'человек пострадало',
}
</script>

<template>
    <div class="w-full grid md:grid-cols-2 grid-cols-1 gap-1">
        <div v-for="(stat, label) in mainStat[0]" class="flex flex-col border w-full items-center justify-center py-10 rounded">
            <p class="lg:text-7xl text-5xl font-bold">{{ Intl.NumberFormat().format(stat) }}</p>
            <p class="font-bold">{{ labels[label] }}</p>
        </div>
    </div>
</template>
