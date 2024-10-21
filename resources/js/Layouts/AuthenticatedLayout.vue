<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ToggleDarkMenu from "@/Components/ToggleDarkMenu.vue";
import { Button } from "@/Components/ui/button";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu";
import { Sheet, SheetContent, SheetTrigger } from "@/Components/ui/sheet";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/Components/ui/accordion";
import { Link, usePage } from "@inertiajs/vue3";
import { CircleUser, Home, Menu } from "lucide-vue-next";

const page = usePage();

const componentName = page.component;
console.log(componentName);
</script>

<template>
    <div
        class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]"
    >
        <div class="hidden border-r bg-muted/40 md:block">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div
                    class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6"
                >
                    <Link
                        :href="route('dashboard')"
                        class="flex items-center gap-2 font-semibold"
                    >
                        <ApplicationLogo
                            class="h-8 w-8 fill-current dark:text-white"
                        />
                        <span class="">KotakHitam</span>
                    </Link>
                </div>
                <div class="flex-1">
                    <nav
                        class="grid items-start px-2 text-sm font-medium lg:px-4"
                    >
                        <Link
                            :href="route('dashboard')"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all hover:text-primary"
                            :class="{
                                'bg-muted': componentName.includes('Dashboard'),
                                'text-muted-foreground':
                                    !componentName.includes('Dashboard'),
                            }"
                        >
                            <Home class="h-4 w-4" />
                            Dashboard
                        </Link>
                        <Accordion
                            type="single"
                            class="w-full py-2"
                            collapsible
                        >
                            <AccordionItem
                                key="menu-1"
                                value="menu-1"
                                class="border-b-0"
                            >
                                <AccordionTrigger
                                    class="rounded-lg px-3 py-2"
                                    :class="{
                                        'bg-muted':
                                            componentName.includes('Order'),
                                        'text-muted-foreground':
                                            !componentName.includes('Order'),
                                    }"
                                >
                                    Order
                                </AccordionTrigger>
                                <AccordionContent
                                    class="pr-3 pl-5 py-2"
                                    :class="{
                                        'bg-muted':
                                            componentName.includes(
                                                'Order/Menu'
                                            ),
                                        'text-muted-foreground':
                                            !componentName.includes(
                                                'Order/Menu'
                                            ),
                                    }"
                                >
                                    Order Menu
                                </AccordionContent>
                            </AccordionItem>
                        </Accordion>
                    </nav>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <header
                class="flex h-14 items-center gap-1 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6"
            >
                <Sheet>
                    <SheetTrigger as-child>
                        <Button
                            variant="outline"
                            size="icon"
                            class="shrink-0 md:hidden"
                        >
                            <Menu class="h-5 w-5" />
                            <span class="sr-only">Toggle navigation menu</span>
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left" class="flex flex-col">
                        <nav class="grid gap-2 text-lg font-medium">
                            <Link
                                :href="route('dashboard')"
                                class="flex items-center gap-2 text-lg font-semibold"
                            >
                                <ApplicationLogo
                                    class="h-8 w-8 fill-current dark:text-white"
                                />
                                <span>KotakHitam</span>
                            </Link>
                            <a
                                href="#"
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                            >
                                <Home class="h-5 w-5" />
                                Dashboard
                            </a>
                        </nav>
                    </SheetContent>
                </Sheet>
                <div class="w-full flex-1"></div>
                <ToggleDarkMenu />
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button
                            variant="secondary"
                            size="icon"
                            class="rounded-full"
                        >
                            <CircleUser class="h-5 w-5" />
                            <span class="sr-only">Toggle user menu</span>
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuLabel>My Account</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem>Settings</DropdownMenuItem>
                        <DropdownMenuItem>Support</DropdownMenuItem>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem as-child>
                            <Link :href="route('logout')" method="post">
                                Logout</Link
                            >
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </header>
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
                <div class="flex items-center">
                    <h1 class="text-lg font-semibold md:text-2xl">
                        <slot name="header" />
                    </h1>
                </div>
                <div
                    class="flex flex-1 flex-col p-6 rounded-lg border shadow-sm"
                >
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
