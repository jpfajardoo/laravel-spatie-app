<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Filter from './Components/Filter.vue';

defineProps({
    permissions: Object,
    filters: Object
})
</script>

<template>
    <Head title="Permissions" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Filter :filters="filters" />
                    <div class="p-6 text-gray-900 text-right">
                        <Link :href="route('permissions.create')" class="btn-default mr-0">Add Permission</Link>
                    </div>
                    <div class="p-6 text-gray-900">
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 border">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Permission Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="permission in permissions.data" :key="permission.id" class="bg-white border">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ permission.name }}
                                        </td>
                                        <td class="px-6 text-right">
                                            <Link v-if="$page.props.authUser.permissions.includes('update permission')" :href="route('permissions.edit', { permission:permission.id })" class="btn-yellow mr-2">Edit</Link>
                                            <Link v-if="$page.props.authUser.permissions.includes('delete permission')" :href="route('permissions.destroy', { permission:permission.id })" method="DELETE" class="btn-red mr-0">Delete</Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="p-6 text-gray-900">
                        <div class="w-full flex justify-center" v-if="permissions.data.length">
                            <Link 
                                v-for="(link, index) in permissions.links" 
                                :key="index" 
                                class="py-2 px-4 rounded-md" 
                                :href="link.url" 
                                :class="{'bg-blue-500 text-gray-300' : link.active}"
                                v-html="link.label"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>