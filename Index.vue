<script setup lang="ts">

//import component
import CreateCommentForm from '../Comment/CreateCommentForm.vue'
import CreatePostForm from './CreatePostForm.vue'
import AdminLayout from '@/Layouts/AdminLayout.vue';
//import type
import { PostInterface, CreatePostInterface } from '@/types/post';
import { CreateCommentInterface } from '@/types/comment';
//import helper
import { Link, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { ref } from 'vue';

//define prop
const props = defineProps({
    posts: {
        type: Object as () => {
            data: PostInterface[],
            links:PostInterface
        },
        required: true
    },
    user: Object
});
//form post
const newPost = ref<CreatePostInterface>({
    name: '',
    user_id: props.user
});
const formPost = (data: CreatePostInterface) => {
    newPost.value = data;
};

//form comment
// const newComment = ref<CreateCommentInterface>({
//     comment: '',
//     post_id: '20',
//     user_id: props.user
// });

function getNewComment(postId: any) {
    return <CreateCommentInterface> {
        comment: '',
        post_id: postId,
        user_id: props.user
    }
}

//delete post
function deletePost(postId:any) {
    if (confirm('Delete Post')) {
        router.delete(route('admin.post.destroy', postId))
        alert('ss')
    }
}

// const formComment = (data: CreateCommentInterface) => {
//     newComment.value = data;
// };
/***************** Define Data *****************/

</script>
<template>
    <div>
        <AdminLayout>
            <create-post-form :url="route('admin.post.store')" @form-change="formPost" :post="newPost" />
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
                                    <button
                                        class="btn btn-sm btn-danger mr-1" @click="deletePost(post.id)">
                                    Delete
                                    </button>
                                </td>
                            </tr>
                            <ul class="pagination mt-2">
                                <li v-for="link in posts.links" :key="link.id" class="page-item">
                                    <Link v-if="link.url" :href="link.url" class="page-link" v-html="link.label">
                                    </Link>
                                    <!-- <div v-else="" v-html="link.label"></div> -->
                                <li style="cursor: no-drop;" v-else="" class="page-item"><a class="page-link" v-html="link.label"></a></li>
                                </li>
                            </ul>
                        </tbody>
                    </table>
                </div>
            </div>
            <section style="background-color: #eee;">
                <div class="container my-5 py-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-10 col-xl-8">

                            <!-- list post and comment -->
                            <div scroll-region class="card overflow-y-auto" v-for="post in posts.data" :key="post.id">
                                <div class="card-body">
                                    <div class="d-flex flex-start align-items-center">
                                        <img class="rounded-circle shadow-1-strong me-3"
                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp"
                                            alt="avatar" width="60" height="60" />
                                        <div>
                                            <h6 class="fw-bold text-primary mb-1">{{ post.name }}</h6>
                                            <p class="text-muted small mb-0">
                                                {{ post.user.name }}
                                            </p>
                                        </div>
                                    </div>

                                    <p class="mt-3 mb-4 pb-2" v-for="comment in post.comments">
                                        {{ comment.comment }}
                                    </p>
                                    <!-- form comment -->
                                    <create-comment-form :url="route('admin.comment.store')"
                                        :comment="getNewComment(post.id)" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </AdminLayout>
    </div>
</template>
