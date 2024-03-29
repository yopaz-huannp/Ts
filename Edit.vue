<script setup lang="ts">
//define post props type
import AdminLayout from '@/Layouts/AdminLayout.vue';
//import type
import { EditPostInterface } from '@/types/post';
//import helpers
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';

//define Props
import { defineProps } from 'vue';

const props = defineProps({
    post: {
        type: Object as () => EditPostInterface,
        required: true,
    },
});

//create FormData
const postForm = useForm({
  id: props.post.id,
  name: props.post.name,
});

//Handle functions
const formSubmit = async () => {
    postForm.post(route('admin.post.update',postForm.id));
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
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            v-model="postForm.name"
                        />
                        <!-- <p class="input-error">
                            {{ postForm.errors.name }}
                        </p> -->
                    </div>
                    <!-- Create password and confirm password fields by Element Plus -->
                   
                    <button
                        :disabled="postForm.processing"
                        type="submit"
                        class="btn btn-success"
                    >
                        Update
                    </button>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped></style>
