<script setup lang="ts">
import {
	Breadcrumb,
	BreadcrumbItem,
	BreadcrumbLink,
	BreadcrumbList,
	BreadcrumbPage,
	BreadcrumbSeparator
} from '@/Components/ui/breadcrumb';
import {
	Card,
	CardContent,
	CardDescription,
	CardFooter,
	CardHeader,
	CardTitle
} from '@/Components/ui/card';
import { FormControl, FormField, FormItem, FormLabel, FormMessage } from '@/Components/ui/form';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useForm as veeForm } from 'vee-validate';
import { toTypedSchema } from '@vee-validate/zod';
import { z } from 'zod';
import { Input } from '@/Components/ui/input';
import { Button } from '@/Components/ui/button';

const formSchema = toTypedSchema(
	z.object({
		name: z.string().max(50),
		email: z.string().max(50).email()
	})
);

const { handleSubmit, setFieldError } = veeForm({
	validationSchema: formSchema
});

const form = useForm({
	name: '',
	email: ''
});

const onSubmit = handleSubmit(() => {
	form.post(route('users.store'), {
		onError: (errors) => {
			for (const [key, value] of Object.entries(errors)) {
				setFieldError(key as 'email' | 'name' | 'verified', value);
			}
		}
	});
});
</script>

<template>
	<Head title="Users" />

	<AuthenticatedLayout :center="true">
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
						<BreadcrumbPage>Create a new User</BreadcrumbPage>
					</BreadcrumbItem>
				</BreadcrumbList>
			</Breadcrumb>
		</template>
		<form
			class="w-full max-w-2xl mx-auto"
			@submit.prevent="onSubmit"
		>
			<Card>
				<CardHeader>
					<CardTitle>
						<h2 class="text-lg">Create a new User</h2>
					</CardTitle>
					<CardDescription> Create a brand new user account. </CardDescription>
				</CardHeader>
				<CardContent class="space-y-4">
					<FormField
						v-slot="{ componentField }"
						name="name"
					>
						<FormItem>
							<FormLabel for="name">Full Name</FormLabel>
							<FormControl>
								<Input
									id="name"
									type="text"
									v-bind="componentField"
									v-model="form.name"
								/>
							</FormControl>
							<FormMessage />
						</FormItem>
					</FormField>
					<FormField
						v-slot="{ componentField }"
						name="email"
					>
						<FormItem>
							<FormLabel for="email">Email</FormLabel>
							<FormControl>
								<Input
									id="email"
									type="email"
									v-bind="componentField"
									v-model="form.email"
								/>
							</FormControl>
							<FormMessage />
						</FormItem>
					</FormField>
				</CardContent>
				<CardFooter>
					<div class="flex items-center gap-4">
						<Button :disabled="form.processing">Save</Button>

						<Transition
							enter-active-class="transition ease-in-out"
							enter-from-class="opacity-0"
							leave-active-class="transition ease-in-out"
							leave-to-class="opacity-0"
						>
							<p
								v-if="form.recentlySuccessful"
								class="text-sm text-gray-600"
							>
								Saved.
							</p>
						</Transition>
					</div>
				</CardFooter>
			</Card>
		</form>
	</AuthenticatedLayout>
</template>
