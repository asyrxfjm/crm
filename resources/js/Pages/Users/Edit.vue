<script setup lang="ts">
import {
	Breadcrumb,
	BreadcrumbList,
	BreadcrumbItem,
	BreadcrumbSeparator,
	BreadcrumbLink
} from '@/Components/ui/breadcrumb';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { User } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Toaster } from '@/Components/ui/toast';
import UpdateUserProfile from './Partials/UpdateUserProfile.vue';
import DeleteUser from './Partials/DeleteUser.vue';

defineProps<{
	user: User;
}>();
</script>

<template>
	<Head title="Users" />

	<AuthenticatedLayout :center="true">
		<Toaster />
		<template #header>
			<Breadcrumb>
				<BreadcrumbList>
					<BreadcrumbItem>
						<BreadcrumbLink :href="route('dashboard')"> Dashboard </BreadcrumbLink>
					</BreadcrumbItem>
					<BreadcrumbSeparator />
					<BreadcrumbItem>
						<BreadcrumbLink :href="route('users.index')"> Users </BreadcrumbLink>
					</BreadcrumbItem>
					<BreadcrumbSeparator />
					<BreadcrumbItem>
						<BreadcrumbPage> Edit User </BreadcrumbPage>
					</BreadcrumbItem>
				</BreadcrumbList>
			</Breadcrumb>
		</template>

		<UpdateUserProfile :user="user" />
		<DeleteUser :user="user" />
	</AuthenticatedLayout>
</template>
