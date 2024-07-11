<script setup lang="ts">
//import types
import type { BranchFormInterface } from '@/types/branch';
//import helpers
import { useForm } from '@inertiajs/vue3';

//define props
import { defineProps, ref } from 'vue';
//define vue components watch
import { watch } from 'vue';
//define vue emit
import { defineEmits } from 'vue';
const emit = defineEmits(['formChange', 'form-error', 'form-success']);

//import components
import InputError from '@/Components/Admin/Form/InputError.vue';
import type { PrefectureInterface } from '@/types/prefecture';

const props = defineProps({
    prefectures: {
        type: Object,
        required: true,
    },

    branch: {
        type: Object as () => BranchFormInterface,
        required: true,
    },
});
//setup handle
const branchForm = <BranchFormInterface>props.branch;
</script>

<template>
    <div class="form-group">
        <span>店舗名</span>
        <input type="text" class="form-control" v-model="branchForm.name" />
        <input-error
            v-if="branchForm.errors.name"
            :error="branchForm.errors.name"
        />
    </div>

    <div class="form-group">
        <span>電話番号</span>
        <input
            type="text"
            class="form-control"
            v-model="branchForm.phone_number"
        />
        <input-error
            v-if="branchForm.errors.phone_number"
            :error="branchForm.errors.phone_number"
        />
    </div>
    <div class="form-group">
        <span>住所</span>
        <div class="row">
            <div class="col-6">
                <input
                    type="text"
                    class="form-control"
                    v-model="branchForm.postal_code"
                    placeholder="郵便番号"
                />
                <input-error
                    v-if="branchForm.errors.postal_code"
                    :error="branchForm.errors.postal_code"
                />
            </div>
            <div class="col-6">
                <select class="form-control" v-model="branchForm.prefecture_id">
                    <option value="" disabled>都道府県</option>
                    <option
                        v-for="prefecture in prefectures"
                        :key="prefecture.id"
                        :value="prefecture.id"
                    >
                        {{ prefecture.name }}
                    </option>
                </select>
                <input-error
                    v-if="branchForm.errors.prefecture_id"
                    :error="branchForm.errors.prefecture_id"
                />
            </div>
        </div>
    </div>

    <div class="form-group">
        <span>市町村・番地</span>
        <input type="text" class="form-control" v-model="branchForm.district" />
        <input-error
            v-if="branchForm.errors.district"
            :error="branchForm.errors.district"
        />
    </div>
    <div class="form-group">
        <span>建物名・部屋番号など</span>
        <input type="text" class="form-control" v-model="branchForm.address" />
        <input-error
            v-if="branchForm.errors.address"
            :error="branchForm.errors.address"
        />
    </div>

    <div class="form-group">
        <span>メールアドレス</span>
        <input type="text" class="form-control" v-model="branchForm.email" />
        <input-error
            v-if="branchForm.errors.email"
            :error="branchForm.errors.email"
        />
    </div>

    <button
        type="submit"
        class="btn btn-secondary"
    >
        登録
    </button>
</template>

<style scoped></style>
