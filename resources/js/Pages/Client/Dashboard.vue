<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'; 
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    my_bookings: Array,
    user: Object
});

// --- LÓGICA DE FILTRADO ---
const upcomingBookings = computed(() => {
    return props.my_bookings.filter(b => b.status === 'pending' || b.status === 'checked_in');
});

const historyBookings = computed(() => {
    return props.my_bookings.filter(b => b.status === 'completed' || b.status === 'cancelled');
});

// --- ESTILOS VISUALES ---
const getStatusColor = (status) => {
    const colors = {
        pending: 'text-yellow-400 bg-yellow-400/10 border-yellow-400/20',
        checked_in: 'text-green-400 bg-green-400/10 border-green-400/20 animate-pulse',
        completed: 'text-blue-400 bg-blue-400/10 border-blue-400/20',
        cancelled: 'text-red-400 bg-red-400/10 border-red-400/20',
    };
    return colors[status] || 'text-gray-400 bg-gray-700';
};

const getStatusLabel = (status) => {
    const labels = { 
        pending: 'Reserva Confirmada', 
        checked_in: '¡EN PISTA AHORA!', 
        completed: 'Finalizada', 
        cancelled: 'Cancelada' 
    };
    return labels[status] || status;
};
</script>

<template>
    <Head title="Mi Cuenta" />

    <AuthenticatedLayout>
        <div class="py-12 bg-gray-900 min-h-screen font-sans text-gray-100">
            
            <div class="absolute top-0 left-0 w-full h-[500px] bg-gradient-to-b from-blue-900/20 to-transparent pointer-events-none"></div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
                
                <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tighter">
                            Hola, <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">{{ user.name }}</span>
                        </h1>
                        <p class="text-gray-400 text-sm mt-1">Bienvenido a tu panel de saltador.</p>
                    </div>
                    
                    <Link :href="route('rules')" class="bg-white text-gray-900 px-8 py-3 rounded-xl font-black uppercase tracking-widest hover:bg-orange-500 hover:text-white transition shadow-lg flex items-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Nueva Reserva
                    </Link>
                </div>

                <div class="mb-16">
                    <h2 class="text-xl font-bold text-white uppercase mb-6 flex items-center gap-2">
                        <span class="w-2 h-8 bg-blue-500 rounded-full"></span>
                        Tus Próximas Visitas
                    </h2>

                    <div v-if="upcomingBookings.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="booking in upcomingBookings" :key="booking.id" 
                            class="bg-gray-800 rounded-3xl p-6 border border-gray-700 hover:border-orange-500 transition-all shadow-xl group relative overflow-hidden">
                            
                            <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>
                            </div>

                            <div class="relative z-10">
                                <span :class="`inline-block px-3 py-1 rounded-full text-[10px] font-black uppercase border mb-4 ${getStatusColor(booking.status)}`">
                                    {{ getStatusLabel(booking.status) }}
                                </span>
                                
                                <div class="flex items-end gap-2 mb-2">
                                    <h3 class="text-4xl font-black text-white tracking-tighter">{{ booking.time }}</h3>
                                </div>
                                <span class="text-sm text-gray-300 font-bold uppercase bg-gray-900 px-3 py-1 rounded-lg border border-gray-700 block w-fit">
                                    📅 {{ booking.date }}
                                </span>

                                <div class="flex items-center gap-4 text-sm text-gray-300 border-t border-gray-700 pt-4 mt-4">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        {{ booking.jumpers }} Pax
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        ${{ booking.total }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else class="bg-gray-800/50 border-2 border-dashed border-gray-700 rounded-3xl p-12 text-center">
                        <div class="text-6xl mb-4">🦘</div>
                        <p class="text-gray-400 mb-4 font-medium">No tienes reservas activas por el momento.</p>
                        <Link :href="route('rules')" class="text-orange-500 hover:text-white font-bold underline transition uppercase tracking-wider text-sm">
                            ¡Haz tu primera reserva aquí!
                        </Link>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-white uppercase mb-6 flex items-center gap-2">
                        <span class="w-2 h-8 bg-gray-600 rounded-full"></span>
                        Historial de Asistencias
                    </h2>
                    
                    <div class="bg-gray-800 rounded-3xl overflow-hidden border border-gray-700 shadow-lg">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-400">
                                <thead class="text-xs text-gray-500 uppercase bg-gray-900/50">
                                    <tr>
                                        <th class="px-6 py-4">Fecha</th>
                                        <th class="px-6 py-4">Hora</th>
                                        <th class="px-6 py-4">Detalle</th>
                                        <th class="px-6 py-4">Estado</th>
                                        <th class="px-6 py-4 text-right">Monto</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    <tr v-for="booking in historyBookings" :key="booking.id" class="hover:bg-gray-700/50 transition">
                                        <td class="px-6 py-4 text-white font-bold whitespace-nowrap">
                                            {{ booking.date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ booking.time }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ booking.jumpers }} Saltadores
                                        </td>
                                        <td class="px-6 py-4">
                                            <span :class="`px-2 py-1 rounded text-[10px] font-bold uppercase border ${getStatusColor(booking.status)}`">
                                                {{ getStatusLabel(booking.status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-mono text-white">
                                            ${{ booking.total }}
                                        </td>
                                    </tr>
                                    <tr v-if="historyBookings.length === 0">
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-xs uppercase tracking-widest">
                                            Aún no tienes historial de visitas pasadas.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>