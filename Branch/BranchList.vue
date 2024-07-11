<script setup lang="ts">
//import type
import type { BranchInterface, BranchPaginateInterface } from '@/types/branch';
//import helpers
import { route } from 'ziggy-js';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

//import components
import AdminLayout from '@/Layouts/AdminLayout.vue';
// define props
const props = defineProps({
    branches: {
        type: Object as () => {
            data: BranchInterface[];
            links: BranchPaginateInterface[];
        },
        required: true,
    },
    hasCreatePermission: {
        type: Boolean,
        required: true,
    },
});

const cleanLabel = (label: string) => {
    return label.replace(/&laquo;|&raquo;/g, '');
};
</script>

<template>
    <AdminLayout>
        <!-- header table -->
        <div
            class="mb-3 d-flex justify-content-end align-items-center"
            v-if="hasCreatePermission"
        >
            <Link :href="route('admin.branches.create')">
                <span class="px-4 py-2 btn text-white bg-secondary">追加</span>
            </Link>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- table branch -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>店舗名</th>
                            <th>住所</th>
                            <th>電話番号</th>
                            <th>メールアドレス</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="branch in branches.data" :key="branch.id">
                            <td>{{ branch.uid }}</td>
                            <td>{{ branch.name }}</td>
                            <td>{{ branch.prefecture?.name }}</td>
                            <td>{{ branch.phone_number }}</td>
                            <td>{{ branch.email }}</td>
                            <td>
                                <Link
                                    :href="
                                        route('admin.branches.show', branch.id)
                                    "
                                    class="btn btn-sm btn-secondary mr-1 float-right"
                                    >詳細を見る</Link
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
                    <nav class="mt-2">
                        <ul class="pagination justify-content-end">
                            <li
                                class="page-item"
                                :class="{
                                    disabled: !link.url,
                                    active: link.active,
                                }"
                                v-for="(link, index) in branches.links"
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
