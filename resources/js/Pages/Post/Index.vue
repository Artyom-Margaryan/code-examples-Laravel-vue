<!--<template>-->
<!--    <Head title="Dashboard" />-->

<!--    <BreezeAuthenticatedLayout>-->
<!--        <template #header>-->
<!--            <h2 class="text-xl font-semibold leading-tight text-gray-800">-->
<!--                Post-->
<!--            </h2>-->
<!--        </template>-->

<!--        <div class="py-12">-->
<!--            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">-->
<!--                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">-->
<!--                    <div class="p-6 bg-white border-b border-gray-200">-->
<!--                        <div class="mb-4">-->
<!--                            <Link-->
<!--                                class="-->
<!--                                    px-6-->
<!--                                    py-2-->
<!--                                    mb-2-->
<!--                                    text-green-100-->
<!--                                    bg-green-500-->
<!--                                    rounded-->
<!--                                "-->
<!--                                :href="route('posts.create')"-->
<!--                            >-->
<!--                                Posts Create-->
<!--                            </Link>-->
<!--                        </div>-->
<!--                        <table>-->
<!--                            <thead class="font-bold bg-gray-300 border-b-2">-->
<!--                            <td class="px-4 py-2">ID</td>-->
<!--                            <td class="px-4 py-2">Title</td>-->
<!--                            <td class="px-4 py-2">Description</td>-->
<!--                            <td class="px-4 py-2">Action</td>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr v-for="post in posts.data" :key="post.id">-->
<!--                                <td class="px-4 py-2">{{ post.id }}</td>-->
<!--                                <td class="px-4 py-2">{{ post.title }}</td>-->
<!--                                <td class="px-4 py-2">-->
<!--                                    {{ post.description }}-->
<!--                                </td>-->
<!--                                <td class="px-4 py-2 font-extrabold">-->
<!--                                    <Link-->
<!--                                        class="text-green-700"-->
<!--                                        :href="route('posts.edit', post.id)"-->
<!--                                    >-->
<!--                                        Edit-->
<!--                                    </Link>-->
<!--                                    <Link-->
<!--                                        @click="destroy(post.id)"-->
<!--                                        class="text-red-700"-->
<!--                                    >Delete</Link-->
<!--                                    >-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                        <pagination :links="posts.links" />-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </BreezeAuthenticatedLayout>-->
<!--</template>-->

<!--<script>-->
<!--import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";-->
<!--import BreezeNavLink from "@/Components/NavLink.vue";-->
<!--import { Head } from "@inertiajs/inertia-vue3";-->
<!--import { Link } from "@inertiajs/inertia-vue3";-->
<!--export default {-->
<!--    components: {-->
<!--        BreezeAuthenticatedLayout,-->
<!--        Head,-->
<!--        BreezeNavLink,-->
<!--        Link,-->
<!--    },-->
<!--    props: {-->
<!--        posts: Object,-->
<!--    },-->
<!--    methods: {-->
<!--        destroy(id) {-->
<!--            this.$inertia.delete(route("posts.destroy", id));-->
<!--        },-->
<!--    },-->
<!--};-->
<!--</script>-->


<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                <BreezeInputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
