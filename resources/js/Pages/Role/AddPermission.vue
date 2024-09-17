<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    role: Object,
    permissions: Object,
    rolePermissions: Array
})

const form = useForm({
    permission: props.rolePermissions
})

const addPermission = () => form.put(route('roles.updatePermission', { roleId: props.role.id }))
</script>

<template>
    <Head title="Role Permissions" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="relative overflow-x-auto">
                            <h4 class="mb-6 text-xl">Role: {{ role.name }}</h4>
                            <form @submit.prevent="addPermission">
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="mb-6">
                                        <label v-for="permission in permissions" :key="permission.id">
                                        <input
                                            type="checkbox"
                                            :value="permission.name"
                                            v-model="form.permission"
                                        />
                                        {{ permission.name }}
                                        <br>
                                        </label>
                                        <InputError :message="form.errors.permission"/>
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