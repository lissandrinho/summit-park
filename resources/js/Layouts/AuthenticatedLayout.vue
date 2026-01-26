<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gray-900">
        <nav class="border-b border-gray-800 bg-gray-900/95 backdrop-blur-md sticky top-0 z-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-20 justify-between items-center">
                    
                    <div class="flex items-center gap-8">
                        <Link :href="route('home')" class="hover:drop-shadow-[0_0_10px_rgba(249,115,22,0.4)] transition-all" title="Ir a la Web">
                            <ApplicationLogo class="block h-9 w-auto fill-current text-orange-500" />
                        </Link>

                        <div class="hidden md:flex items-center gap-3 border-l border-gray-800 pl-8">
                            <span class="w-2 h-6 bg-orange-500 rounded-full"></span>
                            <h2 class="font-black text-lg text-white uppercase tracking-tighter">
                                Centro de Comando
                            </h2>
                        </div>
                    </div>

                    <div class="hidden sm:ms-6 sm:flex sm:items-center gap-4">
                        <Link :href="route('home')" class="flex items-center gap-2 px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white rounded-xl border border-gray-700 transition-all text-[10px] font-black uppercase tracking-widest">
                            <span>Ver Sitio Público</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </Link>

                        <div class="relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center rounded-xl border border-gray-700 bg-gray-800 px-4 py-2 text-xs font-black uppercase tracking-widest text-gray-300 transition duration-150 ease-in-out hover:border-orange-500 hover:text-white focus:outline-none"
                                        >
                                            {{ $page.props.auth.user.name }}
                                            <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
                                        <DropdownLink :href="route('profile.edit')" class="text-gray-300 hover:bg-gray-700 hover:text-orange-500 uppercase text-[10px] font-bold"> Perfil </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button" class="text-gray-300 hover:bg-gray-700 hover:text-red-500 uppercase text-[10px] font-bold"> Salir </DropdownLink>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-800 hover:text-orange-500 focus:outline-none"
                        >
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden bg-gray-800 border-b border-gray-700">
                <div class="space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink :href="route('home')" class="text-gray-300"> Ver Sitio Público </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-orange-500"> Centro de Comando </ResponsiveNavLink>
                </div>
                <div class="border-t border-gray-700 pb-1 pt-4">
                    <div class="px-4">
                        <div class="text-base font-bold text-white">{{ $page.props.auth.user.name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')" class="text-gray-300"> Perfil </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="text-red-400"> Salir </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <main class="bg-gray-900">
            <header v-if="$slots.header" class="bg-gray-900 border-b border-gray-800 shadow-xl">
                <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <div class="mx-auto max-w-7xl">
                <slot />
            </div>
        </main>
    </div>
</template>

<style scoped>
:deep(.nav-link-active) {
    border-color: #f97316 !important;
    color: white !important;
}
</style>