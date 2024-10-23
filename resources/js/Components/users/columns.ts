import { User } from "@/types";
import { ColumnDef } from "@tanstack/vue-table";
import { h } from "vue";
import Action from "./Action.vue";
import { ArrowUpDown, ChevronDown } from "lucide-vue-next";
import { Button } from "../ui/button";

export const columns: ColumnDef<User>[] = [
    {
        accessorKey: "email",
        header: ({ column }) => {
            return h(
                Button,
                {
                    variant: "ghost",
                    onClick: () =>
                        column.toggleSorting(column.getIsSorted() === "asc"),
                },
                () => ["Email", h(ArrowUpDown, { class: "ml-2 h-4 w-4" })]
            );
        },
    },
    {
        accessorKey: "name",
        header: () => h("div", "Full Name"),
    },
    {
        accessorKey: "email_verified_at",
        header: () => h("div", "Verified At"),
        cell: ({ row }) => {
            const user = row.original;

            return h("div", user.email_verified_at);
        },
    },
    {
        id: "actions",
        enableHiding: false,
        cell: ({ row }) => {
            const user = row.original;

            return h(
                "div",
                { class: "relative" },
                h(Action, {
                    user,
                })
            );
        },
    },
];
