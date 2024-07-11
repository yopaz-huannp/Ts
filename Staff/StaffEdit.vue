<script setup lang="ts">
//import helpers
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
//components
import AdminLayout from '@/Layouts/AdminLayout.vue';
import StaffForm from '@/Pages/Admin/Staff/StaffForm.vue';

//import type
import type { StaffFormInterface } from '@/types/staff';

const props = defineProps({
    branchId: {
        type: String,
        required: true,
    },
    staff: {
        type: Object as () => StaffFormInterface,
        required: true,
    },
});
//value
const newStaff = useForm<StaffFormInterface>(props.staff);

// submit form
const formSubmit = () => {
    newStaff.put(route('admin.branches.staffs.update', { branch: props.branchId, staff: newStaff.id}), {
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
                    <StaffForm :staff="newStaff" />
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped></style>
