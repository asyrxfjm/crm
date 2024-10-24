<script setup lang="ts">
import { columns } from '@/Components/users/columns';
import DataTable from '@/Components/users/DataTable.vue';
import {
	Breadcrumb,
	BreadcrumbList,
	BreadcrumbItem,
	BreadcrumbSeparator,
	BreadcrumbLink
} from '@/Components/ui/breadcrumb';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { PaginateMeta, User } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Toaster } from '@/Components/ui/toast';
import { useToast } from '@/Components/ui/toast';

const props = defineProps<{
	users: PaginateMeta<User>;
	filters: Filters;
	message?: string;
	error?: string;
}>();

const { toast } = useToast();

if (props.message) {
	toast({
		title: 'Success!',
		description: props.message,
		variant: 'success'
	});
}

if (props.error) {
	toast({
		title: 'Error!',
		description: props.error,
		variant: 'destructive'
	});
}
</script>

<template>
	<Head title="Users" />

	<AuthenticatedLayout :center="false">
		<Toaster />
		<template #header>
			<Breadcrumb>
				<BreadcrumbList>
					<BreadcrumbItem>
						<BreadcrumbLink :href="route('dashboard')"> Dashboard </BreadcrumbLink>
					</BreadcrumbItem>
					<BreadcrumbSeparator />
					<BreadcrumbItem>
						<BreadcrumbPage>Users</BreadcrumbPage>
					</BreadcrumbItem>
				</BreadcrumbList>
			</Breadcrumb>
		</template>

		<DataTable
			:columns="columns"
			:data="users.data"
			:links="users.links"
			:filters="filters"
		/>
	</AuthenticatedLayout>
</template>
