<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    bookings: Array,
    waivers: Array,
    activities: Array,
    attractions: Array,
    stats: Object
});

const activeTab = ref('operaciones');

// --- GESTIÓN DE PASES ---
const activityForm = useForm({
    name: '',
    duration: '',
    price: '',
});

const saveActivity = () => {
    activityForm.post(route('admin.activities.store'), {
        onSuccess: () => activityForm.reset(),
    });
};

const toggleActivity = (id) => {
    router.patch(route('admin.activities.toggle', id), {}, { preserveScroll: true });
};

const deleteActivity = (id) => {
    if (confirm('¿Estás seguro de eliminar este pase?')) {
        router.delete(route('admin.activities.destroy', id), { preserveScroll: true });
    }
};

// --- GESTIÓN DE ATRACCIONES ---
const attractionForm = useForm({
    title: '',
    description: '',
    image: null,
});

const saveAttraction = () => {
    attractionForm.post(route('admin.attractions.store'), {
        onSuccess: () => attractionForm.reset(),
    });
};

const deleteAttraction = (id) => {
    if (confirm('¿Quieres eliminar esta atracción de la galería?')) {
        router.delete(route('admin.attractions.destroy', id), { preserveScroll: true });
    }
};

// --- OPERACIONES (CONTROL DE ASISTENCIA) ---
const changeStatus = (bookingId, newStatus) => {
    const labels = { checked_in: 'INGRESO', completed: 'SALIDA (Finalizado)', cancelled: 'CANCELACIÓN' };
    if (!confirm(`¿Confirmar ${labels[newStatus]}?`)) return;
    
    router.patch(route('booking.status', bookingId), { 
        status: newStatus 
    }, { preserveScroll: true });
};

// --- AYUDANTES VISUALES ---
const getActivityName = (duration) => {
    const act = props.activities.find(a => a.duration == duration);
    return act ? act.name : `${duration} min`;
};

const getStatusColor = (status) => {
    const colors = {
        pending: 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20',
        checked_in: 'bg-green-500/10 text-green-500 border-green-500/20',
        completed: 'bg-blue-500/10 text-blue-500 border-blue-500/20',
        cancelled: 'bg-red-500/10 text-red-500 border-red-500/20',
    };
    return colors[status] || 'bg-gray-700 text-gray-400';
};

const getStatusLabel = (status) => {
    const labels = { pending: 'Pendiente', checked_in: 'En Sala', completed: 'Finalizado', cancelled: 'Cancelado' };
    return labels[status] || status;
};
</script>

<template>
    <Head title="Centro de Comando" />

    <AuthenticatedLayout>
        <div class="py-6 bg-gray-900 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                        <p class="text-emerald-400 text-xs font-black uppercase tracking-widest mb-1">Caja del Mes</p>
                        <p class="text-4xl font-black text-white">${{ stats.income }}</p>
                    </div>
                    <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                        <p class="text-blue-400 text-xs font-black uppercase tracking-widest mb-1">Reservas Totales</p>
                        <p class="text-4xl font-black text-white">{{ stats.total_bookings }}</p>
                    </div>
                    <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                        <p class="text-orange-400 text-xs font-black uppercase tracking-widest mb-1">Firmas Waivers</p>
                        <p class="text-4xl font-black text-white">{{ stats.total_waivers }}</p>
                    </div>
                </div>

                <div class="flex gap-4 p-1 bg-gray-800 w-fit rounded-2xl border border-gray-700">
                    <button @click="activeTab = 'operaciones'" :class="activeTab === 'operaciones' ? 'bg-orange-500 text-white' : 'text-gray-400'" class="px-6 py-2 rounded-xl font-black uppercase text-xs transition-all">Operaciones</button>
                    <button @click="activeTab = 'config'" :class="activeTab === 'config' ? 'bg-orange-500 text-white' : 'text-gray-400'" class="px-6 py-2 rounded-xl font-black uppercase text-xs transition-all">Pases y Precios</button>
                    <button @click="activeTab = 'marketing'" :class="activeTab === 'marketing' ? 'bg-orange-500 text-white' : 'text-gray-400'" class="px-6 py-2 rounded-xl font-black uppercase text-xs transition-all">Atracciones</button>
                </div>

                <div v-if="activeTab === 'operaciones'" class="bg-gray-800 rounded-3xl border border-gray-700 shadow-2xl overflow-hidden animate-in fade-in duration-500">
                    <div class="p-6 border-b border-gray-700 bg-gray-800/50">
                        <h3 class="font-bold text-white uppercase tracking-wider flex items-center gap-2">📋 Flujo de Saltadores</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-400">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-900/50">
                                <tr>
                                    <th class="px-6 py-4">Estado</th>
                                    <th class="px-6 py-4">Cliente / Contacto</th>
                                    <th class="px-6 py-4">Validación Legal</th>
                                    <th class="px-6 py-4 text-center">Pax</th>
                                    <th class="px-6 py-4">Turno</th>
                                    <th class="px-6 py-4 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                <tr v-for="booking in bookings" :key="booking.id" class="hover:bg-gray-700/30 transition group">
                                    <td class="px-6 py-4">
                                        <span :class="`px-3 py-1 rounded-full text-[10px] font-black uppercase border ${getStatusColor(booking.status)}`">
                                            {{ getStatusLabel(booking.status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-white font-black uppercase text-xs">{{ booking.customer_name || 'Sin Nombre' }}</div>
                                        <div class="text-[10px] text-gray-500 font-bold tracking-tighter">{{ booking.email_contact }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div v-if="booking.waiver_signed" class="flex flex-col">
                                            <span class="text-green-500 font-black text-[10px] uppercase flex items-center gap-1">
                                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Validado
                                            </span>
                                        </div>
                                        <div v-else class="flex flex-col">
                                            <span class="text-red-500 font-black text-[10px] uppercase flex items-center gap-1">
                                                <span class="w-2 h-2 bg-red-500 rounded-full"></span> Falta Firma
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center font-black text-orange-500">{{ booking.jumpers }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-blue-400 font-mono font-bold">{{ booking.time_slot }}</div>
                                        <div class="text-[10px] text-gray-500 uppercase">{{ booking.date }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button v-if="booking.status === 'pending'" @click="changeStatus(booking.id, 'checked_in')" class="p-2 bg-green-500/20 text-green-500 rounded-lg hover:bg-green-500 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            </button>
                                            <button v-if="booking.status === 'checked_in'" @click="changeStatus(booking.id, 'completed')" class="p-2 bg-blue-500/20 text-blue-500 rounded-lg hover:bg-blue-500 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10l2 2m0 0l2-2m-2 2v-6m0 10a9 9 0 110-18 9 9 0 010 18z" /></svg>
                                            </button>
                                            <button v-if="booking.status !== 'cancelled'" @click="changeStatus(booking.id, 'cancelled')" class="p-2 bg-red-500/20 text-red-500 rounded-lg hover:bg-red-500 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
        </div>
    </AuthenticatedLayout>
</template>