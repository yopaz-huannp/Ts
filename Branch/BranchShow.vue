<script setup lang="ts">
//import type
import type { BranchInterface } from '@/types/branch';
import type { StaffInterface, StaffPaginateInterface } from '@/types/staff';
//import helpers
import { route } from 'ziggy-js';
import { Link, router } from '@inertiajs/vue3';
import { defineProps } from 'vue';

//import components
import AdminLayout from '@/Layouts/AdminLayout.vue';
// import sweat alert
import swal from 'sweetalert';
// define props
const props = defineProps({
    branch: {
        type: Object as () => BranchInterface,
        required: true,
    },
    staffs: {
        type: Object as () => {
            data: StaffInterface[];
            links: StaffPaginateInterface[];
        },
        required: true,
    },
});
const deleteBranch = (id?: number) => {
    swal({
        title: '削除しますか？',
        icon: 'warning',
        buttons: ['いいえ', 'はい'],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            router.delete(route('admin.branches.destroy', id));
        }
    });
};

const cleanLabel = (label: string) => {
    return label.replace(/&laquo;|&raquo;/g, '');
};

const staffRole = (role: string) => {
    switch (role) {
        case 'editor':
            return '編集者';
        case 'manager':
            return '管理者';
        default:
            return 'スタッフ';
    }
};
</script>

<template>
    <AdminLayout>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <label>基本情報</label>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <Link :href="route('admin.branches.edit', branch.id)">
                    <span class="px-4 py-2 btn text-white bg-secondary mr-4"
                        >編集
                    </span>
                </Link>
                <div @click="deleteBranch(branch.id)">
                    <span
                        class="px-4 py-2 btn text-white"
                        style="background-color: #e57373"
                        >削除
                    </span>
                </div>
            </div>
        </div>

        <!-- show infor branch -->
        <div class="card">
            <div class="card-body">
                <!-- table post -->
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ branch.uid }}</td>
                        </tr>
                        <tr>
                            <th>店舗名</th>
                            <td>{{ branch.name }}</td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td>
                                {{
                                    branch.postal_code +
                                    '・' +
                                    branch.prefecture?.name +
                                    '・' +
                                    branch.district +
                                    '・' +
                                    branch.address
                                }}
                            </td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>{{ branch.phone_number }}</td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>{{ branch.email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-5">
            <label>店舗スタッフ一覧</label>
            <div class="mb-3 d-flex justify-content-end align-items-center">
                <Link :href="route('admin.branches.staffs.create', branch.id)">
                    <span class="px-4 py-2 btn text-white bg-secondary"
                        >追加
                    </span>
                </Link>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- table member -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ステータス</th>
                            <th>ID</th>
                            <th>名前</th>
                            <th>電話番号</th>
                            <th>メールアドレス</th>
                            <th>管理権限</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="staff in staffs.data" :key="staff.id">
                            <td>1</td>
                            <td>{{ staff.uid }}</td>
                            <td>{{ staff.first_name }}</td>
                            <td>{{ staff.phone_number }}</td>
                            <td>{{ staff.email }}</td>
                            <td>{{ staffRole(staff.role) }}</td>
                            <td>
                                <Link
                                    :href="
                                        route('admin.branches.staffs.show', {
                                            branch: branch.id,
                                            staff: staff.id,
                                        })
                                    "
                                    class="btn btn-sm btn-secondary mr-1 float-right"
                                    >詳細を見る</Link
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- paginate -->
                <nav class="mt-2">
                    <ul class="pagination justify-content-end">
                        <li
                            class="page-item"
                            :class="{
                                disabled: !link.url,
                                active: link.active,
                            }"
                            v-for="(link, index) in staffs.links"
                            v-bind:key="index"
                        >
                            <Link class="page-link" :href="link.url || '#'"
                                >{{ cleanLabel(link.label) }}
                            </Link>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped></style>
