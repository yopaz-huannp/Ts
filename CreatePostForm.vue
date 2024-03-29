<script setup lang="ts">
//import types
import { CreatePostInterface } from '@/types/post';
import { useForm } from '@inertiajs/vue3';
//import helpers
//define props
import { defineProps } from 'vue';
//define vue components watch
import { watch } from 'vue';
//define vue emit
import { defineEmits } from 'vue';
const emit = defineEmits(['formChange', 'form-error', 'form-success']);

import InputError from '@/Components/Admin/Form/InputError.vue';

const props = defineProps({
    post: {
        type: Object as () => CreatePostInterface,
        required: true,
    },
    url: {
        type: String,
        required: true,
    },
});
//setup handle
const postForm = useForm<CreatePostInterface>(props.post);
//setup watch
watch(
    () => postForm,
    () => {
        emit('formChange', postForm.data());
    },
    { deep: true },
);
//setup emit

const formSubmit = async () => {
    postForm.post(props.url, {
        onError: (errors: Record<string, string>) => {
            emit('form-error', errors);
            // props.errorHandle(errors);
        },
        onSuccess: () => {
            // emit('form-success');
            postForm.reset()
        },
    });
};
</script>

<template>
    <form @submit.prevent="formSubmit">
        <div class="form-group">
            <!-- Create email field with label and input in inline layout with bootstrap-->
            <label for="name">Name</label>
            <input
                type="text"
                class="form-control"
                id="name"
                v-model="postForm.name"
            />
            <input-error
                v-if="postForm.hasErrors"
                :error="postForm.errors.name"
            />
        </div>
        <button
            :disabled="postForm.processing"
            type="submit"
            class="btn btn-success"
        >
            Create
        </button>
    </form>
</template>

<style scoped></style>
@/types/post