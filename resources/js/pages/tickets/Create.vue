<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { create, index, store } from '@/routes/tickets';
import type { BreadcrumbItem } from '@/types';

defineProps<{
    categories: { id: number; name: string }[];
    priorities: { value: string; label: string }[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Tickets', href: index().url },
    { title: 'New ticket', href: create().url },
];

const form = useForm({
    title: '',
    description: '',
    category_id: '',
    priority: 'p3',
});

const submit = () => {
    form.post(store().url);
};

const fieldClass =
    'w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring';
</script>

<template>
    <Head title="New ticket" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-2xl p-4">
            <h1 class="mb-6 text-2xl font-semibold">New ticket</h1>

            <form class="flex flex-col gap-5" @submit.prevent="submit">
                <div class="grid gap-2">
                    <Label for="title">Title</Label>
                    <Input id="title" v-model="form.title" placeholder="A short summary of the problem" />
                    <InputError :message="form.errors.title" />
                </div>

                <div class="grid gap-2">
                    <Label for="description">Description</Label>
                    <textarea
                        id="description"
                        v-model="form.description"
                        rows="6"
                        :class="fieldClass"
                        placeholder="What happened, and what did you expect to happen?"
                    />
                    <InputError :message="form.errors.description" />
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="grid gap-2">
                        <Label for="category">Category</Label>
                        <select id="category" v-model="form.category_id" :class="fieldClass">
                            <option value="" disabled>Choose a category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <InputError :message="form.errors.category_id" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="priority">Priority</Label>
                        <select id="priority" v-model="form.priority" :class="fieldClass">
                            <option v-for="priority in priorities" :key="priority.value" :value="priority.value">
                                {{ priority.label }}
                            </option>
                        </select>
                        <InputError :message="form.errors.priority" />
                    </div>
                </div>

                <div>
                    <Button type="submit" :disabled="form.processing">Raise ticket</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>