<script setup lang="ts" generic="TData, TValue">
import type { ColumnDef, SortingState } from '@tanstack/vue-table';
import {
	Table,
	TableBody,
	TableCell,
	TableHead,
	TableHeader,
	TableRow
} from '@/Components/ui/table';
import { FlexRender, getCoreRowModel, useVueTable } from '@tanstack/vue-table';
import { valueUpdater } from '@/lib/utils';
import { Link as PaginateLink } from '@/types';
import { Link, router } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { ref, watch } from 'vue';
import { Input } from '@/Components/ui/input';
import { useDebounceFn } from '@vueuse/core';

const props = defineProps<{
	columns: ColumnDef<TData, TValue>[];
	data: TData[];
	links: PaginateLink[];
	filters: Filters;
}>();

const sorting = ref<SortingState>([]);
let search = ref(props.filters.search);
let sort = ref(props.filters.sort);
let sortBy = ref(props.filters.sortBy);

const table = useVueTable({
	get data() {
		return props.data;
	},
	get columns() {
		return props.columns;
	},
	getCoreRowModel: getCoreRowModel(),
	onSortingChange: (updaterOrValue) => valueUpdater(updaterOrValue, sorting),
	state: {
		get sorting() {
			if (sorting.value.length > 0) {
				sortBy.value = sorting.value[0].id;
				sort.value = sorting.value[0].desc ? 'desc' : 'asc';
			} else {
				sort.value = '';
				sortBy.value = '';
			}

			if (sort.value) {
				triggerSearch();
			}

			return sorting.value;
		}
	}
});

const triggerSearch = useDebounceFn(() => {
	router.get(
		route('users.index'),
		{
			search: search.value,
			sort: sort.value,
			sortBy: sortBy.value
		},
		{
			preserveState: true,
			replace: true
		}
	);
}, 500);

watch(search, () => {
	triggerSearch();
});

console.log(props.links);
</script>

<template>
	<div>
		<div
			class="flex flex-col items-start justify-between pb-4 md:flex-row md:items-center gap-y-3 md:gap-y-0"
		>
			<Input
				class="max-w-xs"
				placeholder="Search by email, full name"
				v-model="search"
			/>
			<Button
				as-child
				variant="secondary"
			>
				<Link :href="route('users.create')"> Create a new User</Link>
			</Button>
		</div>
		<div class="border rounded-md">
			<Table>
				<TableHeader>
					<TableRow
						v-for="headerGroup in table.getHeaderGroups()"
						:key="headerGroup.id"
					>
						<TableHead
							v-for="header in headerGroup.headers"
							:key="header.id"
						>
							<FlexRender
								v-if="!header.isPlaceholder"
								:render="header.column.columnDef.header"
								:props="header.getContext()"
							/>
						</TableHead>
					</TableRow>
				</TableHeader>
				<TableBody>
					<template v-if="table.getRowModel().rows?.length">
						<TableRow
							v-for="row in table.getRowModel().rows"
							:key="row.id"
							:data-state="row.getIsSelected() ? 'selected' : undefined"
						>
							<TableCell
								v-for="cell in row.getVisibleCells()"
								:key="cell.id"
								class="text-nowrap"
							>
								<FlexRender
									:render="cell.column.columnDef.cell"
									:props="cell.getContext()"
								/>
							</TableCell>
						</TableRow>
					</template>
					<template v-else>
						<TableRow>
							<TableCell
								:colspan="columns.length"
								class="h-24 text-center"
							>
								No results.
							</TableCell>
						</TableRow>
					</template>
				</TableBody>
			</Table>
		</div>
		<div class="items-center justify-end hidden py-2 space-x-1 md:flex">
			<template
				v-for="link in links"
				:key="link.url"
			>
				<Button
					:size="link.active ? 'sm' : 'xs'"
					v-if="link.url"
					as-child
					:variant="link.active ? 'default' : 'ghost'"
				>
					<Link
						:href="link.url"
						preserve-scroll
						v-html="link.label"
					>
					</Link>
				</Button>
				<Button
					v-else
					v-html="link.label"
					variant="ghost"
					disabled
					size="sm"
				/>
			</template>
		</div>
		<div class="flex items-center justify-between py-2 md:hidden">
			<div>
				<Button
					size="sm"
					as-child
					variant="default"
					v-if="filters.page > 1"
				>
					<Link
						:href="links[0].url"
						preserve-scroll
						v-html="`&laquo; Previous`"
					/>
				</Button>

				<Button
					size="sm"
					v-html="`&laquo; Previous`"
					variant="ghost"
					v-else
					disabled
				>
				</Button>
			</div>
			<div>
				<Button
					size="sm"
					variant="default"
					as-child
					v-if="filters.page >= 1 && filters.page < links.length - 2"
				>
					<Link
						:href="links[Number(filters.page) + 1].url"
						preserve-scroll
						v-html="`Next &raquo;`"
					/>
				</Button>
				<Button
					size="sm"
					v-html="`Next &raquo;`"
					variant="ghost"
					v-else
					disabled
				>
				</Button>
			</div>
		</div>
	</div>
</template>
