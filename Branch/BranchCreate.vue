<script setup lang="ts">
//import helpers
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

//components
import AdminLayout from '@/Layouts/AdminLayout.vue';
import BranchForm from '@/Pages/Admin/Branch/BranchForm.vue';

//import type
import type { BranchFormInterface } from '@/types/branch';
import { string } from 'yup';
//define Props
const props = defineProps({
    prefectures: {
        type: Object,
        required: true,
    },
});
//value
const newBranch = useForm<BranchFormInterface>({
    name: '',
    phone_number: '',
    address: '',
    prefecture_id: '',
    district: '',
    postal_code: '',
    email: '',
    errors: {
        name: '',
        phone_number: '',
        address: '',
        prefecture_id: '',
        district: '',
        postal_code: '',
        email: '',
    },
});

// submit form
const formSubmit = () => {
    newBranch.post(route('admin.branches.store'), { preserveScroll: true });
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
