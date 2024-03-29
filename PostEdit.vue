<script setup lang="ts">
/****************** Import Types  *************/

import { MenuInterface } from '@/types/menu';

/****************** Import Components  *************/
import AdminLayout from '@/Layouts/AdminLayout.vue';

/****************** Import helpers *************/
import { MenuService } from '@/Services/MenuService';

/****************** Define Props *************/
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
    edit post
</template>

<style scoped></style>
