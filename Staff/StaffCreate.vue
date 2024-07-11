<script setup lang="ts">
//import helpers
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';

//components
import AdminLayout from '@/Layouts/AdminLayout.vue';
import StaffForm from '@/Pages/Admin/Staff/StaffForm.vue';

//import type
import type { StaffInterface } from '@/types/staff';

//value
const newStaff = useForm<StaffInterface>({
    first_name: '',
    last_name: '',
    first_name_kana: '',
    last_name_kana: '',
    phone_number: '',
    email: '',
    password: '',
    role: '',
});
const props= defineProps({
    branchId: {
        type: String,
        required: true,
    },
});
// submit form
const formSubmit = () => {
    newStaff.post(route('admin.branches.staffs.store',{ branch: props.branchId}), { preserveScroll: true });
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
                    <StaffForm :staff="newStaff" />
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped></style>
