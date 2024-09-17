<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    permission: Object
})

const form = useForm({
    name: props.permission.name
})

const update = () => form.put(route('permissions.update', { permission: props.permission.id }))
</script>

<template>
    <Head title="Permissions" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="relative overflow-x-auto">
                            <form @submit.prevent="update">
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="mb-6">
                                        <label class="label">Permission Name</label>
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