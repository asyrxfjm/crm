<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :center="false">
        <template #header> Dashboard </template>
    </AuthenticatedLayout>
</template>
