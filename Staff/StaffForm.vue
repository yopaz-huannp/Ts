<script setup lang="ts">
//import types
import type { StaffFormInterface } from '@/types/staff';
import type { UserInterface } from '@/types/user';

//import helpers
import { usePage } from '@inertiajs/vue3';

//define props
import { defineProps } from 'vue';
//define vue components watch

//import components
import InputError from '@/Components/Admin/Form/InputError.vue';

const props = defineProps({
    staff: {
        type: Object,
        required: true,
    },
});
//setup handle
const staffForm = <StaffFormInterface>props.staff;

const user = usePage<{
    auth: {
        user: UserInterface;
    };
}>().props.auth.user;

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
    <div class="form-group">
        <span>氏名</span>
        <div class="row">
            <div class="col-6">
                <input
                    type="text"
                    class="form-control"
                    placeholder="性"
                    v-model="staffForm.first_name"
                />
                <input-error
                    v-if="staffForm.errors.first_name"
                    :error="staffForm.errors.first_name"
                />
            </div>
            <div class="col-6">
                <input
                    type="text"
                    class="form-control"
                    placeholder="名"
                    v-model="staffForm.last_name"
                />
                <input-error
                    v-if="staffForm.errors.last_name"
                    :error="staffForm.errors.last_name"
                />
            </div>
        </div>
    </div>
    <div class="form-group">
        <span>氏名(カナ)</span>
        <div class="row">
            <div class="col-6">
                <input
                    type="text"
                    class="form-control"
                    placeholder="性"
                    v-model="staffForm.first_name_kana"
                />
                <input-error
                    v-if="staffForm.errors.first_name_kana"
                    :error="staffForm.errors.first_name_kana"
                />
            </div>
            <div class="col-6">
                <input
                    type="text"
                    class="form-control"
                    placeholder="名"
                    v-model="staffForm.last_name_kana"
                />
                <input-error
                    v-if="staffForm.errors.last_name_kana"
                    :error="staffForm.errors.last_name_kana"
                />
            </div>
        </div>
    </div>
    <div class="form-group">
        <span>電話番号</span>

        <div>
            <input
                type="text"
                class="form-control"
                v-model="staffForm.phone_number"
            />
        </div>
        <input-error
            v-if="staffForm.errors.phone_number"
            :error="staffForm.errors.phone_number"
        />
    </div>
    <div class="form-group">
        <span>メールアドレス</span>

        <div>
            <input type="text" class="form-control" v-model="staffForm.email" />
        </div>
        <input-error
            v-if="staffForm.errors.email"
            :error="staffForm.errors.email"
        />
    </div>
    <div class="form-group">
        <span>管理権限</span>
        <template v-if="user.id !== staff.id">
            <select class="form-control" v-model="staffForm.role">
            <option value="manager">管理者</option>
            <option value="editor">編集者</option>
        </select>
        <input-error
            v-if="staffForm.errors.role"
            :error="staffForm.errors.role"
        />
        </template>

        <template v-else>

            <input :value="getRoleName(staff.role)" type="text" class="form-control" disabled>
        

        </template>

    </div>
    <button type="submit" class="btn btn-secondary">登録</button>
</template>

<style scoped></style>
