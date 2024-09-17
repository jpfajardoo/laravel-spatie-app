<template>
    <form @submit.prevent="filter">
        <div class="p-6 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input 
                    v-model.number="filterForm.name"
                    type="text" placeholder="Name"
                    class="input" />
            </div>

            <button type="submit" class="btn-default m-1">Search</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    filters: Object
})

const filterForm = useForm({
    name: props.filters.name ?? null
})

const filter = () => {
    filterForm.get(
        route('roles.index'),
        {
            preserveState: true,
            preserveScroll: true,
        }
    )
}
</script>