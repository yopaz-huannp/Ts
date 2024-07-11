<script setup lang="ts">
//import type
import type { StaffInterface } from '@/types/staff';
//import helpers
import { route } from 'ziggy-js';
import { Link, router } from '@inertiajs/vue3';
import { defineProps } from 'vue';

//import components
import AdminLayout from '@/Layouts/AdminLayout.vue';
// import sweat alert
import swal from 'sweetalert';

// define props

const props= defineProps({
    branchId: {
        type: String,
        required: true,
    },
    staff: {
        type: Object as () => StaffInterface,
        required: true,
    },
});
const deleteStaff = (id?: number) => {
    swal({
        title: '削除しますか？',
        icon: 'warning',
        buttons: ['いいえ', 'はい'],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            router.delete(route('admin.branches.staffs.destroy', { branch: props.branchId, staff: id }));
        }
    });
};
function getRoleName(role: string) {
    switch (role) {
        case "editor":
            return '編集者';
        case "manager":
            return '管理者';
        default:
            return 'スタッフ';
    }
}

</script>

<template>
    <AdminLayout>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <label>基本情報</label>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <Link :href="route('admin.branches.staffs.edit',{ branch: props.branchId, staff: staff.id})">
                    <span class="px-4 py-2 btn text-white bg-secondary mr-4"
                        >編集
                    </span>
                </Link>
                <div @click="deleteStaff(staff.id)">
                    <span
                        class="px-4 py-2 btn text-white"
                        style="background-color: #e57373"
                        >削除
                    </span>
                </div>
            </div>
        </div>

        <!-- show infor staff -->
        <div class="card">
            <div class="card-body">
                <!-- table post -->
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>ステータス</th>
                            <td>{{ staff.id }}</td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <td>{{ staff.id }}</td>
                        </tr>
                        <tr>
                            <th>店舗名</th>
                            <td>{{ staff.first_name }}</td>
                        </tr>
                        <tr>
                            <th>氏名</th>
                            <td>{{ staff.last_name }}</td>
                        </tr>
                        <tr>
                            <th>氏名(カナ)</th>
                            <td>{{ staff.first_name_kana }}</td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>{{ staff.phone_number }}</td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>{{ staff.email }}</td>
                        </tr>
                        <tr>
                            <th>管理権限</th>
                            <td>{{ getRoleName(staff.role) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped></style>
