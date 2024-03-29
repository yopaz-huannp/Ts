<script setup lang="ts">
/****************** Import Types *************/
import { MenuInterface } from '@/types/menu';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { MenuService } from '@/Services/MenuService';
const props = defineProps({
    menus: {
        type: Array as () => MenuInterface[],
        default: () => [],
    },
});

const menuService = new MenuService();
menuService.setMenus(props.menus);
</script>

<template>
    <AdminLayout> </AdminLayout>
    create post
</template>

<style scoped></style>
