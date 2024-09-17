<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    roles: Object,
    userRoles: Object
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: props.user.password,
    roles: props.userRoles
})

const update = () => form.put(route('users.update', { user: props.user.id }))
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="relative overflow-x-auto">
                            <form @submit.prevent="update">
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label class="label">Name</label>
                                        <input type="text" v-model="form.name" class="input"/>
                                        <InputError :message="form.errors.name"/>
                                    </div>
                                    <div>
                                        <label class="label">Email</label>
                                        <input readonly type="text" v-model="form.email" class="input"/>
                                    </div>
                                    <div>
                                        <label class="label">Password</label>
                                        <input type="password" v-model="form.password" class="input"/>
                                    </div>
                                    <div>
                                        <label class="label">Roles</label>
                                        <select v-model="form.roles" multiple class="input">
                                            <option disabled value="">Please select roles</option>
                                            <option v-for="role in roles.data" :key="role.id">{{ role.name }}</option>
                                        </select>
                                        <InputError :message="form.errors.roles"/>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn-default">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>