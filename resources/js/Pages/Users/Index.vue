<script setup lang="ts">
import { columns } from "@/Components/users/columns";
import DataTable from "@/Components/users/DataTable.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { PaginateMeta, User } from "@/types";
import { Head } from "@inertiajs/vue3";

defineProps<{
    users: PaginateMeta<User>;
    filters: Filters;
}>();
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout :center="false">
        <template #header> Users </template>

        <DataTable
            :columns="columns"
            :data="users.data"
            :links="users.links"
            :filters="filters"
        />
    </AuthenticatedLayout>
</template>
