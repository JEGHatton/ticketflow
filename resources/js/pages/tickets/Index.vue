<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import type { BreadcrumbItem } from "@/types";
import { index, show } from "@/routes/tickets";
import { Head, Link, router } from '@inertiajs/vue3';

type Ticket = {
    id: number;
    title: string;
    status: string;
    priority: string;
    created_at: string;
    category: { id: number; name: string } | null;
};

defineProps<{
    tickets: {
        data: Ticket[];
        current_page: number;
        last_page: number;
        prev_page_url: string | null;
        next_page_url: string | null;
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: "Tickets", href: index().url }];

const formatDate = (date: string) => new Date(date).toLocaleDateString("en-GB");

const formatStatus = (status: string) => status.replace("_", " ");
</script>

<template>
    <Head title="Tickets" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 p-4">
            <h1 class="text-2xl font-semibold">Tickets</h1>

            <div
                v-if="tickets.data.length === 0"
                class="rounded-lg border p-8 text-center text-muted-foreground"
            >
                No tickets yet.
            </div>

            <div v-else class="overflow-x-auto rounded-lg border">
                <table class="w-full text-sm">
                    <thead class="border-b bg-muted/50 text-left">
                        <tr>
                            <th class="p-3 font-medium">Title</th>
                            <th class="p-3 font-medium">Category</th>
                            <th class="p-3 font-medium">Status</th>
                            <th class="p-3 font-medium">Priority</th>
                            <th class="p-3 font-medium">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="ticket in tickets.data"
                            :key="ticket.id"
                            class="cursor-pointer border-b transition-colors last:border-0 hover:bg-muted/50"
                            @click="router.visit(show(ticket.id).url)"
                        >
                            <td class="p-3 font-medium">{{ ticket.title }}</td>
                            <td class="p-3">{{ ticket.category?.name }}</td>
                            <td class="p-3 capitalize">
                                {{ formatStatus(ticket.status) }}
                            </td>
                            <td class="p-3 uppercase">{{ ticket.priority }}</td>
                            <td class="p-3 text-muted-foreground">
                                {{ formatDate(ticket.created_at) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
