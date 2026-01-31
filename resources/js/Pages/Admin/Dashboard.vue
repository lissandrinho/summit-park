<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    bookings: Array,
    activities: Array,
    attractions: Array,
    stats: Object
});

const activeTab = ref('operaciones');

// --- FUNCIONES DE OPERACIONES ---
const changeStatus = (bookingId, newStatus) => {
    const actions = {
        'checked_in': '¿Confirmar ingreso y cobro?',
        'completed': '¿Confirmar salida del grupo?',
        'cancelled': '¿Cancelar esta reserva?'
    };
    
    if (confirm(actions[newStatus])) {
        router.patch(route('booking.status', bookingId), { status: newStatus }, { preserveScroll: true });
    }
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
    const labels = { pending: 'Pendiente Pago', checked_in: 'EN PISTA', completed: 'Finalizado', cancelled: 'Cancelado' };
    return labels[status] || status;
};

// --- GESTIÓN DE PASES (ACTIVIDADES) ---
const activityForm = useForm({ name: '', duration: '', price: '' });
const saveActivity = () => activityForm.post(route('admin.activities.store'), { onSuccess: () => activityForm.reset() });
const deleteActivity = (id) => { if(confirm('¿Borrar?')) router.delete(route('admin.activities.destroy', id)); };

// --- GESTIÓN DE ATRACCIONES ---
const attractionForm = useForm({ title: '', description: '', image: null });
const saveAttraction = () => attractionForm.post(route('admin.attractions.store'), { onSuccess: () => attractionForm.reset() });
const deleteAttraction = (id) => { if(confirm('¿Borrar?')) router.delete(route('admin.attractions.destroy', id)); };
</script>

<template>
    <Head title="Centro de Comando" />

    <AuthenticatedLayout>
        <div class="py-6 bg-gray-900 min-h-screen font-sans text-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                        <p class="text-emerald-400 text-xs font-black uppercase tracking-widest mb-1">Caja Total</p>
                        <p class="text-4xl font-black text-white tracking-tighter">${{ props.stats.income }}</p>
                    </div>
                    <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                        <p class="text-blue-400 text-xs font-black uppercase tracking-widest mb-1">Reservas</p>
                        <p class="text-4xl font-black text-white tracking-tighter">{{ props.stats.total_bookings }}</p>
                    </div>
                    <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                        <p class="text-orange-400 text-xs font-black uppercase tracking-widest mb-1">Waivers</p>
                        <p class="text-4xl font-black text-white tracking-tighter">{{ props.stats.total_waivers }}</p>
                    </div>
                    <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                        <p class="text-purple-400 text-xs font-black uppercase tracking-widest mb-1">Saltando Ahora</p>
                        <p class="text-4xl font-black text-white tracking-tighter">{{ props.stats.active_jumpers || 0 }}</p>
                    </div>
                </div>

                <div class="flex gap-2 p-1 bg-gray-800 w-fit rounded-2xl border border-gray-700">
                    <button @click="activeTab = 'operaciones'" :class="activeTab === 'operaciones' ? 'bg-orange-500 text-white shadow-lg' : 'text-gray-400 hover:text-white'" class="px-6 py-2 rounded-xl font-black uppercase text-xs transition-all">Operaciones</button>
                    <button @click="activeTab = 'config'" :class="activeTab === 'config' ? 'bg-orange-500 text-white shadow-lg' : 'text-gray-400 hover:text-white'" class="px-6 py-2 rounded-xl font-black uppercase text-xs transition-all">Pases y Precios</button>
                    <button @click="activeTab = 'marketing'" :class="activeTab === 'marketing' ? 'bg-orange-500 text-white shadow-lg' : 'text-gray-400 hover:text-white'" class="px-6 py-2 rounded-xl font-black uppercase text-xs transition-all">Atracciones</button>
                </div>

                <div v-if="activeTab === 'operaciones'" class="bg-gray-800 rounded-3xl border border-gray-700 shadow-2xl overflow-hidden animate-in fade-in">
                    <div class="p-6 border-b border-gray-700 bg-gray-800/50 flex justify-between items-center">
                        <h3 class="font-bold text-white uppercase tracking-wider flex items-center gap-2">
                            📋 Control de Taquilla
                        </h3>
                        <span class="text-xs text-gray-500 uppercase font-bold">Últimos registros</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-400">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-900/50">
                                <tr>
                                    <th class="px-6 py-4">Estado</th>
                                    <th class="px-6 py-4">Titular (Waiver)</th>
                                    <th class="px-6 py-4">Detalle Venta</th>
                                    <th class="px-6 py-4">Total a Cobrar</th>
                                    <th class="px-6 py-4">Turno Agendado</th>
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
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center text-sm font-black text-white shadow-md">
                                                {{ booking.customer_name.charAt(0) }}
                                            </div>
                                            <div>
                                                <div class="text-white font-bold text-sm">{{ booking.customer_name }}</div>
                                                <div class="text-[10px] text-gray-500">{{ booking.email }}</div>
                                                <div v-if="!booking.waiver_id" class="flex items-center gap-1 text-[10px] text-red-400 font-bold uppercase mt-1 animate-pulse bg-red-500/10 px-2 py-0.5 rounded w-fit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                                    Falta Firmar
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-1">
                                            <div class="flex items-center gap-2 text-white font-bold">
                                                <span class="bg-blue-600/20 text-blue-400 px-2 py-0.5 rounded text-xs">Pax</span>
                                                {{ booking.jumpers }} Personas
                                            </div>
                                            <div class="flex items-center gap-2 text-gray-400 text-xs">
                                                <span class="bg-gray-700 px-2 py-0.5 rounded text-[10px] uppercase">Duración</span>
                                                {{ booking.duration }} Minutos
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-emerald-400 font-black text-xl tracking-tight flex items-center gap-1">
                                            <span>$</span>{{ booking.total_price }}
                                        </div>
                                        <div class="text-[9px] text-gray-500 uppercase font-bold tracking-wide">Monto Final IVA Inc.</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-white font-bold text-lg">{{ booking.time_slot }}</span>
                                            <span class="text-[10px] uppercase text-gray-500 font-bold bg-gray-900 px-2 py-1 rounded w-fit">{{ booking.date }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button v-if="booking.status === 'pending'" @click="changeStatus(booking.id, 'checked_in')" title="Cobrar e Ingresar" class="group bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-xl shadow-lg hover:shadow-green-500/30 transition-all flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                <span class="text-xs font-black uppercase hidden md:inline">Check-In</span>
                                            </button>
                                            
                                            <button v-if="booking.status === 'checked_in'" @click="changeStatus(booking.id, 'completed')" title="Marcar Salida" class="group bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                                <span class="text-xs font-black uppercase hidden md:inline">Salida</span>
                                            </button>
                                            
                                            <button v-if="booking.status !== 'cancelled' && booking.status !== 'completed'" @click="changeStatus(booking.id, 'cancelled')" title="Cancelar Reserva" class="bg-gray-700 hover:bg-red-600 text-gray-400 hover:text-white p-2 rounded-xl transition hover:shadow-red-600/30">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div v-if="activeTab === 'config'" class="grid md:grid-cols-2 gap-8 animate-in fade-in">
                    <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 h-fit">
                        <h3 class="font-bold text-white uppercase mb-4">Crear Nuevo Pase</h3>
                        <form @submit.prevent="saveActivity" class="space-y-4">
                            <div>
                                <label class="text-xs text-gray-500 font-bold uppercase block mb-1">Nombre Comercial</label>
                                <input v-model="activityForm.name" type="text" placeholder="Ej: Pase 1 Hora" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-2 text-white focus:border-orange-500 outline-none">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div><label class="text-xs text-gray-500 font-bold uppercase block mb-1">Minutos</label><input v-model="activityForm.duration" type="number" placeholder="60" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-2 text-white focus:border-orange-500 outline-none"></div>
                                <div><label class="text-xs text-gray-500 font-bold uppercase block mb-1">Precio ($)</label><input v-model="activityForm.price" type="number" placeholder="400" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-2 text-white focus:border-orange-500 outline-none"></div>
                            </div>
                            <button type="submit" :disabled="activityForm.processing" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black uppercase py-3 rounded-xl transition">Guardar Pase</button>
                        </form>
                    </div>
                    <div class="space-y-4">
                        <div v-for="act in props.activities" :key="act.id" class="bg-gray-800 p-4 rounded-2xl border border-gray-700 flex justify-between items-center group">
                            <div><h4 class="text-white font-bold">{{ act.name }}</h4><p class="text-xs text-gray-400">{{ act.duration }} Minutos • <span class="text-green-400">${{ act.price }}</span></p></div>
                            <button @click="deleteActivity(act.id)" class="text-red-500 opacity-0 group-hover:opacity-100 transition hover:bg-red-500/10 p-2 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                        </div>
                    </div>
                </div>

                <div v-if="activeTab === 'marketing'" class="grid md:grid-cols-2 gap-8 animate-in fade-in">
                    <div class="bg-gray-800 p-6 rounded-3xl border border-gray-700 h-fit">
                        <h3 class="font-bold text-white uppercase mb-4">Nueva Atracción</h3>
                        <form @submit.prevent="saveAttraction" class="space-y-4">
                            <div><label class="text-xs text-gray-500 font-bold uppercase block mb-1">Título</label><input v-model="attractionForm.title" type="text" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-2 text-white focus:border-orange-500 outline-none"></div>
                            <div><label class="text-xs text-gray-500 font-bold uppercase block mb-1">Descripción</label><textarea v-model="attractionForm.description" rows="3" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-2 text-white focus:border-orange-500 outline-none"></textarea></div>
                            <div><label class="text-xs text-gray-500 font-bold uppercase block mb-1">Imagen</label><input type="file" @input="attractionForm.image = $event.target.files[0]" class="w-full text-gray-400 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-700 file:text-white hover:file:bg-gray-600"></div>
                            <button type="submit" :disabled="attractionForm.processing" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black uppercase py-3 rounded-xl transition">Subir Atracción</button>
                        </form>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div v-for="att in props.attractions" :key="att.id" class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden group relative">
                            <img :src="`/storage/${att.image_path}`" class="w-full h-32 object-cover opacity-60 group-hover:opacity-100 transition">
                            <div class="p-3"><h4 class="text-white text-xs font-bold truncate">{{ att.title }}</h4></div>
                            <button @click="deleteAttraction(att.id)" class="absolute top-2 right-2 bg-red-600 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition shadow-lg"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>