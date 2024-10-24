import { User } from "@/types";
import { ColumnDef } from "@tanstack/vue-table";
import { h } from "vue";
import Action from "./Action.vue";
import { ChevronUp, ArrowUpDown, ChevronDown } from "lucide-vue-next";
import { Button } from "../ui/button";

export const columns: ColumnDef<User>[] = [
    {
        accessorKey: "email",
        header: ({ column }) => {
            const sorted = column.getIsSorted();

            let variant = "ghost";
            let icon = ArrowUpDown;

            if (sorted === "asc") {
                variant = "secondary";
                icon = ChevronUp;
            } else if (sorted === "desc") {
                variant = "secondary";
                icon = ChevronDown;
            }

            return h(
                Button,
                {
                    variant: variant as any,
                    onClick: () => column.toggleSorting(),
                },
                () => ["Email", h(icon, { class: "ml-2 h-4 w-4" })]
            );
        },
    },
    {
        accessorKey: "name",
        header: ({ column }) => {
            const sorted = column.getIsSorted();

            let variant = "ghost";
            let icon = ArrowUpDown;

            if (sorted === "asc") {
                variant = "secondary";
                icon = ChevronUp;
            } else if (sorted === "desc") {
                variant = "secondary";
                icon = ChevronDown;
            }

            return h(
                Button,
                {
                    variant: variant as any,
                    onClick: () => column.toggleSorting(),
                },
                () => ["Name", h(icon, { class: "ml-2 h-4 w-4" })]
            );
        },
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
