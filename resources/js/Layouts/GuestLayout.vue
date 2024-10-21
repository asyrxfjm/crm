<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ToggleDarkMenu from "@/Components/ToggleDarkMenu.vue";
import { Link } from "@inertiajs/vue3";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
</script>

<template>
    <div
        class="flex relative min-h-screen flex-col items-center bg-gray-100 pt-6 justify-center sm:pt-0 dark:bg-black"
    >
        <div class="absolute top-5 right-5">
            <ToggleDarkMenu />
        </div>

        <div>
            <Link href="/">
                <ApplicationLogo
                    class="h-20 w-20 fill-current dark:text-gray-500"
                />
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden sm:max-w-md px-6">
            <slot />
        </div>
    </div>
</template>
