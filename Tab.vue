<script setup lang="ts">
const tab = ref<string>('tab1');
// define method
const changeTab = (value: string) => {
    tab.value = value
}
</script>
<template>
    
    <div class=" flex py-3 flex-wrap">
        <div class="detail_tour mr-2 sm:mr-7 p-2" @click="changeTab('tab1')">
            Thông tin
        </div>
        <div class=" detail_tour mr-2 sm:mr-7 px-2 p-2" @click="changeTab('tab2')">
            Tổng quan
        </div>
    </div>
    <div class="content_tab hidden animate-overlay" :class="{ active: tab === 'tab1' }">
        <div>tab 1</div>
    </div>
    <div class="content_tab hidden animate-overlay" :class="{ active: tab === 'tab2' }">
        <div>tab 2</div>
    </div>
    <!-- end form edit name -->
</template>
<style scoped>
.bg-statistic {
    background: #F7F6F1;
}

.content_tab.active {
    display: block;
}
</style>
