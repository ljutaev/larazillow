<template>
    <form>
        <div class="mb-4 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center gap-2">
                <input
                    id="deleted"
                    v-model="filterForm.deleted"
                    type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                />
                <label for="deleted">Deleted</label>
            </div>

            <div class="flex items-center gap-4">
                <select v-model="filterForm.by" class="input-filter-l w-24">
                    <option value="created_at">Added</option>
                    <option value="price">Price</option>
                </select>
                <select v-model="filterForm.order" class="input-filter-r w-32">
                    <option
                        v-for="option in sortOptions"
                        :key="option.value"
                        :value="option.value"
                    >
                        {{ option.label }}
                    </option>
                </select>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm, router } from "@inertiajs/vue3";
import { watch, computed } from "vue";
import { debounce } from "lodash";

const sortLabels = {
    created_at: [
        {
            label: "Latest",
            value: "desc",
        },
        {
            label: "Oldest",
            value: "asc",
        },
    ],
    price: [
        {
            label: "Pricey",
            value: "desc",
        },
        {
            label: "Cheapest",
            value: "asc",
        },
    ],
};

const props = defineProps({
    filters: Object,
});

const sortOptions = computed(() => sortLabels[filterForm.by]);

const filterForm = useForm({
    deleted: props.filters.deleted ?? true,
    by: props.filters.by ?? "created_at",
    order: props.filters.order ?? "desc",
});

console.log("props", filterForm);

watch(
    filterForm,
    debounce(() => {
        router.get(route("realtor.listing.index"), filterForm, {
            preserveState: true,
            preserveScroll: true,
        });
    }, 500)
);
</script>
