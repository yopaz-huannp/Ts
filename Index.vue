<script setup lang="ts">
import CreatePostForm from './CreatePostForm.vue'
import { CreatePostInterface, PostInterface } from '@/types/post';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from 'ziggy-js';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    posts: {
        type: Object as () => {
            data: PostInterface[]
        },
        required: true
    }
});
const newPost = ref<CreatePostInterface>({
    name: ''
});
// const createUserSuccessHandle = () => {
//     userService.store().setUsers(props.posts.data);
//     // router.reload({
//     //     only: ['users'],
//     // });
// };
const createUserErrorHandle = () => {
    console.log('User Created');
};
const formChange = (data: CreatePostInterface) => {
    newPost.value = data;
};
/***************** Define Data *****************/
</script>
<template>
    <div>
        <AdminLayout>
            <create-post-form :url="route('admin.post.store')" 
            @form-change="formChange"
            @form-error="createUserErrorHandle" 
            @form-success=""
            :post="newPost" />
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="post in posts.data" :key="post.id">
                                <td>{{ post.id }}</td>
                                <td>{{ post.name }}</td>
                                <td class="col-sm-2 text-right">
                                    <Link :href="route('admin.post.edit', post.id)" class="btn btn-sm btn-primary mr-1">
                                    Edit
                                    </Link>
                                    <Link :href="route('admin.post.destroy',post.id)" class="btn btn-sm btn-danger">Delete</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <nav>
                                <ul class="pagination">    
                                    <li v-for="link in posts.links" :key="link.id" class="page-item">
                                        <Link v-if="link.url" :href="link.url" class="page-link" v-html="link.label"></Link>
                                        <!-- <div v-else="" v-html="link.label"></div> -->
                                        <li v-else=""  class="page-item"><a class="page-link" v-html="link.label"></a></li>
                                    </li> 
                                </ul>
                            </nav>
        </AdminLayout>
    </div>
</template>

@/types/post
