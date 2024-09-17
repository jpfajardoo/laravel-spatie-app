<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    role: Object
})

const form = useForm({
    name: props.role.name
})

const update = () => form.put(route('roles.update', { role: props.role.id }))
</script>

<template>
    <Head title="Roles" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="relative overflow-x-auto">
                            <form @submit.prevent="update">
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="mb-6">
                                        <label class="label">Role Name</label>
                                        <input type="text" v-model="form.name" class="input"/>
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