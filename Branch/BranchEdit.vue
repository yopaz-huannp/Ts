<script setup lang="ts">
//import helpers
import { route } from 'ziggy-js';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

//components
import AdminLayout from '@/Layouts/AdminLayout.vue';
import BranchForm from '@/Pages/Admin/Branch/BranchForm.vue';

//import type
import type { BranchFormInterface } from '@/types/branch';
//define Props
const props = defineProps({
    branch: {
        type: Object as () => BranchFormInterface,
        required: true,
    },
    prefectures: {
        type: Object,
        required: true,
    },
});
//value
const newBranch = useForm<BranchFormInterface>(props.branch);
const formSubmit = () => {
    newBranch.put(route('admin.branches.update', newBranch.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout>
        <!-- use bootstrap card element -->
        <div class="card">
            <!-- Card body to show Create form -->
            <div class="card-body">
                <label>基本情報</label>
                <form @submit.prevent="formSubmit">
                    <BranchForm
                        :prefectures="prefectures"
                        :branch="newBranch"
                    />
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped></style>
