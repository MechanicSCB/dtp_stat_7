<script setup>
import {Bar} from 'vue-chartjs'
import {Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale} from 'chart.js'
import {computed} from "vue";

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

let props = defineProps({
    severitiesChartData: Object,
});

const chartData = computed(function (){
    return {
        labels: props.severitiesChartData.labels,
        datasets: [{
            label: 'Число ДТП по последствиям для здоровья',
            data: props.severitiesChartData.data,
            indexAxis: 'y',
            backgroundColor: props.severitiesChartData.colors,
        }],
    };
})

let chartOptions = {
    responsive: true,
    aspectRatio:1|4,
};
</script>

<template>
    <div class="w-full aspect-[4/1]">
        <Bar :options="chartOptions" :data="chartData"/>
    </div>
</template>
