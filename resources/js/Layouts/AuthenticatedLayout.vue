<script setup lang="ts">
defineProps<{
    center: boolean;
}>();

import NavHeader from "@/Components/layout/NavHeader.vue";
import Sidebar from "@/Components/layout/Sidebar.vue";
</script>

<template>
    <div class="flex w-full min-h-screen">
        <Sidebar class="fixed top-0 left-0 z-50" />
        <div class="flex flex-col w-full ml-0 lg:ml-[220px] xl:ml-[280px]">
            <NavHeader />
            <div class="flex flex-col h-full">
                <main class="flex flex-col gap-4 p-4 lg:gap-6 lg:p-6">
                    <div class="flex items-center">
                        <h1 class="text-lg font-semibold md:text-2xl">
                            <slot name="header" />
                        </h1>
                    </div>
                    <div
                        class="flex flex-col"
                        :class="{
                            'items-center justify-center': center,
                            'shadow-sm border rounded-lg p-6': !center,
                        }"
                    >
                        <slot />
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
