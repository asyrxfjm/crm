<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useForm as veeForm } from 'vee-validate';
import { toTypedSchema } from '@vee-validate/zod';
import * as z from 'zod';
import { FormControl, FormField, FormItem, FormMessage } from '@/Components/ui/form';
import { Card, CardContent, CardDescription, CardHeader } from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Button } from '@/Components/ui/button';
import CardFooter from '@/Components/ui/card/CardFooter.vue';

const formSchema = toTypedSchema(
	z.object({
		password: z.string().min(8).max(50)
	})
);

const { handleSubmit, setFieldError } = veeForm({
	validationSchema: formSchema
});

const form = useForm({
	password: ''
});

const onSubmit = handleSubmit(() => {
	form.post(route('password.confirm'), {
		onError: (errors) => {
			for (const [key, value] of Object.entries(errors)) {
				setFieldError(key as 'password', value);
			}
		}
	});
});
</script>

<template>
	<GuestLayout>
		<Head title="Confirm Password" />

		<form @submit.prevent="onSubmit">
			<CardHeader>
				<CardTitle class="text-2xl"> Confirm Password </CardTitle>
				<CardDescription>
					This is a secure area of the application. Please confirm your password before continuing.
				</CardDescription>
			</CardHeader>
			<CardContent>
				<FormField
					v-slot="{ componentField }"
					name="password"
				>
					<FormItem>
						<FormControl>
							<Input
								id="password"
								type="password"
								v-bind="componentField"
								v-model="form.password"
							/>
						</FormControl>
						<FormMessage />
					</FormItem>
				</FormField>
			</CardContent>
			<CardFooter>
				<Button
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
					:loading="form.processing"
				>
					Confirm
				</Button>
			</CardFooter>
			<!-- <div>
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 flex justify-end">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Confirm
                </PrimaryButton>
            </div> -->
		</form>
	</GuestLayout>
</template>
