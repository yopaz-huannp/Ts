<script setup lang="ts">
//define post props type
import AdminLayout from '@/Layouts/AdminLayout.vue';
//import type
import { EditPostInterface } from '@/types/post';
//import helpers
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';
const emit = defineEmits(['formChange', 'form-error', 'form-success']);
import InputError from '@/Components/Admin/Form/InputError.vue';
//define Props
import { defineProps } from 'vue';

const props = defineProps({
    post: {
        type: Object as () => EditPostInterface,
        required: true,
    },

});
// defineProps({ errors: Object })

//create FormData
const postForm = useForm({
    id: props.post.id,
    name: props.post.name,
});

//Handle functions
const formSubmit = async () => {
    postForm.post(route('admin.post.update', postForm.id),
        {
            onError: (errors: Record<string, string>) => {
                emit('form-error', errors);
                // props.errorHandle(errors);
            },
        });
};
</script>

<template>
    <AdminLayout>
        <!-- use bootstrap card element -->
        <div class="card">
            <!-- Card body to show post Create form -->
            <div class="card-body" v-if="postForm.data()">
                <form @submit.prevent="formSubmit">
                    <div class="form-group">
                        <!-- Create email field with label and input in inline layout with bootstrap-->
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" v-model="postForm.name" />
                        <input-error v-if="postForm.hasErrors" :error="postForm.errors.name" />
                    </div>
                    <!-- Create password and confirm password fields by Element Plus -->

                    <button :disabled="postForm.processing" type="submit" class="btn btn-success">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped></style>
