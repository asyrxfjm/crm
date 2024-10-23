<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Home, Users2 } from "lucide-vue-next";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/Components/ui/accordion";
import { Button } from "../ui/button";
const page = usePage();

const componentName = page.component;
</script>

<template>
    <div
        class="hidden border-r bg-muted/40 lg:block backdrop-blur lg:min-w-[220px] xl:min-w-[280px] min-h-full"
    >
        <div class="flex flex-col h-full max-h-screen gap-2">
            <div
                class="flex h-16 items-center border-b px-4 md:h-[60px] lg:px-6"
            >
                <Link
                    :href="route('dashboard')"
                    class="flex items-center gap-2 font-semibold"
                >
                    <ApplicationLogo
                        class="fill-current w-7 h-7 dark:text-white"
                    />
                    <span class="">KotakHitam</span>
                </Link>
            </div>
            <div class="flex-1">
                <nav class="grid items-start px-2 text-sm font-medium lg:px-4">
                    <Link
                        :href="route('dashboard')"
                        class="flex items-center gap-3 px-3 py-2 transition-all rounded-lg hover:text-primary"
                        :class="{
                            'bg-muted': componentName.includes('Dashboard'),
                            'text-muted-foreground':
                                !componentName.includes('Dashboard'),
                        }"
                    >
                        <Home class="w-4 h-4" />
                        Dashboard
                    </Link>
                    <Link
                        :href="route('users.index')"
                        class="flex items-center gap-3 px-3 py-2 transition-all rounded-lg hover:text-primary"
                        :class="{
                            'bg-muted': componentName.includes('User'),
                            'text-muted-foreground':
                                !componentName.includes('User'),
                        }"
                    >
                        <Users2 class="w-4 h-4" />
                        Users
                    </Link>
                    <!-- <Accordion
                        type="single"
                        class="w-full py-2"
                        default-value="Order"
                        collapsible
                    >
                        <AccordionItem
                            key="Order"
                            value="Order"
                            class="border-b-0"
                        >
                            <AccordionTrigger
                                class="rounded-lg px-3 py-2 [&[data-state=open]]:text-primary"
                                :class="{
                                    'bg-muted': componentName.includes('Order'),
                                    'text-muted-foreground':
                                        !componentName.includes('Order'),
                                }"
                            >
                                <div class="flex items-center gap-3">
                                    <Home class="w-4 h-4" />
                                    Order
                                </div>
                            </AccordionTrigger>
                            <AccordionContent
                                class="py-2 pl-5 pr-3"
                                :class="{
                                    'bg-muted':
                                        componentName.includes('Dashboard'),
                                    'text-muted-foreground':
                                        !componentName.includes('Dashboard'),
                                }"
                            >
                                <Link :href="route('dashboard')">
                                    Order Menu
                                </Link>
                            </AccordionContent>
                        </AccordionItem>
                    </Accordion> -->
                </nav>
            </div>
        </div>
    </div>
</template>
