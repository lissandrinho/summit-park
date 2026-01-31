<script setup>
import { Head, useForm, usePage } from '@inertiajs/vue3';
// 1. CORRECCIÓN: Usar MainLayout (el público) en lugar de AuthenticatedLayout
import MainLayout from '@/Layouts/MainLayout.vue'; 
import { computed, onMounted, watch } from 'vue';

const props = defineProps({
    prefilled: {
        type: Object,
        default: () => ({ waiver_id: null, jumpers: 1 })
    },
    activities: {
        type: Array,
        default: () => [] 
    }
});

// 2. CORRECCIÓN: Obtener el usuario globalmente de forma segura
const page = usePage();
const user = computed(() => page.props.auth.user);

const timeSlots = ['14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00'];

const form = useForm({
    waiver_id: props.prefilled.waiver_id,
    date: '',
    jumpers: props.prefilled.jumpers, 
    duration: 60,
    time_slot: '',
    email_contact: '', 
    total_price: 0,
});

const isWaiverLocked = computed(() => !!form.waiver_id);

onMounted(() => {
    if (props.activities.length > 0) {
        const defaultActivity = props.activities.sort((a,b) => a.price - b.price)[0];
        form.duration = defaultActivity.duration;
    }
    
    // Autocompletar SOLO si el usuario existe
    if (user.value) {
        form.email_contact = user.value.email;
    }

    updateTotal();
});

// ... (El resto de tus funciones: availableDates, updateTotal, watch, etc. se mantienen igual)
// Solo asegúrate de copiar el resto de la lógica que ya tenías aquí abajo.
const availableDates = computed(() => {
    const dates = [];
    const today = new Date();
    for (let i = 0; i < 7; i++) {
        const d = new Date(today);
        d.setDate(today.getDate() + i);
        dates.push({
            value: d.toLocaleDateString('en-CA'), 
            label: d.toLocaleDateString('es-UY', { weekday: 'short', day: 'numeric' }),
        });
    }
    return dates;
});

const updateTotal = () => {
    const activity = props.activities.find(a => a.duration === form.duration);
    const pricePerPerson = activity ? parseFloat(activity.price) : 0;
    form.total_price = form.jumpers * pricePerPerson;
};

watch(() => [form.jumpers, form.duration], () => updateTotal());

const selectDate = (dateValue) => form.date = dateValue;
const selectSlot = (time) => form.time_slot = time;
const selectDuration = (minutes) => form.duration = minutes;

const updateJumpers = (val) => {
    if (isWaiverLocked.value) return; 
    if (val < 1 || val > 50) return;
    form.jumpers = val;
};

const submitBooking = () => {
    if (!form.date || !form.time_slot || !form.email_contact) {
        alert("⚠️ Faltan datos: Selecciona fecha, hora y email.");
        return;
    }
    form.post(route('booking.store'), { preserveScroll: true });
};
</script>

<template>
    <MainLayout>
        <Head title="Finalizar Reserva" />

        <div class="bg-gray-900 min-h-screen pt-24 pb-32 relative font-sans text-gray-100 overflow-x-hidden">
            <div class="absolute top-0 left-0 w-[300px] md:w-[500px] h-[300px] md:h-[500px] bg-blue-600/10 rounded-full blur-[80px] md:blur-[120px] pointer-events-none"></div>

            <div class="max-w-6xl mx-auto px-4 md:px-6 relative z-10">
                
                <div class="text-center mb-8 md:mb-12">
                    <div v-if="isWaiverLocked" class="inline-flex items-center gap-2 bg-green-500/10 text-green-400 text-[10px] md:text-xs font-bold px-4 py-2 rounded-full mb-4 uppercase tracking-widest border border-green-500/20 shadow-[0_0_20px_rgba(74,222,128,0.1)] animate-in fade-in zoom-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Waiver Vinculado
                    </div>
                    
                    <div v-if="user" class="inline-flex items-center gap-2 bg-blue-500/10 text-blue-400 text-[10px] md:text-xs font-bold px-4 py-2 rounded-full mb-4 uppercase tracking-widest border border-blue-500/20 ml-2 animate-in fade-in zoom-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Reservando como {{ user?.name }}
                    </div>

                    <h1 class="text-3xl md:text-5xl font-black text-white uppercase mb-2 tracking-tighter leading-tight">
                        Configura tu <span class="text-orange-500">Salto</span>
                    </h1>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                    <div class="lg:col-span-2 space-y-6 md:space-y-8">
                        <section class="bg-gray-800 p-5 md:p-6 rounded-3xl border border-gray-700 shadow-xl">
                            <h3 class="text-white font-bold uppercase mb-4 flex items-center gap-2 text-sm md:text-base">
                                <span class="bg-blue-600 text-xs px-2 py-1 rounded text-white">1</span> Elige el Día
                            </h3>
                            <div class="flex gap-3 overflow-x-auto pb-4 custom-scrollbar snap-x snap-mandatory">
                                <button v-for="date in availableDates" :key="date.value" @click="selectDate(date.value)" 
                                    class="min-w-[80px] md:min-w-[90px] p-3 md:p-4 rounded-2xl border transition-all text-center snap-center"
                                    :class="form.date === date.value ? 'bg-orange-500 border-orange-500 text-white shadow-lg scale-105' : 'bg-gray-900 border-gray-700 text-gray-400 hover:border-gray-500'">
                                    <span class="text-[10px] md:text-xs uppercase font-bold block whitespace-nowrap">{{ date.label }}</span>
                                </button>
                            </div>
                        </section>

                        <section class="bg-gray-800 p-5 md:p-6 rounded-3xl border border-gray-700 shadow-xl">
                            <h3 class="text-white font-bold uppercase mb-4 flex items-center gap-2 text-sm md:text-base">
                                <span class="bg-blue-600 text-xs px-2 py-1 rounded text-white">2</span> Detalles
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                                <div>
                                    <label class="text-xs text-gray-500 font-bold uppercase mb-3 block pl-2">Tiempo</label>
                                    <div class="space-y-3">
                                        <button v-for="act in props.activities" :key="act.id" @click="selectDuration(act.duration)" 
                                            class="w-full flex justify-between items-center p-3 md:p-4 rounded-xl border transition-all active:scale-95"
                                            :class="form.duration === act.duration ? 'bg-blue-600/20 border-blue-500 text-white shadow-[0_0_15px_rgba(37,99,235,0.3)]' : 'bg-gray-900 border-gray-700 text-gray-400 hover:bg-gray-700'">
                                            <span class="font-bold flex items-center gap-2 text-sm md:text-base">{{ act.duration }} Minutos</span>
                                            <span class="text-blue-400 font-mono text-base md:text-lg font-bold">${{ act.price }}</span>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 font-bold uppercase mb-3 block pl-2">Personas</label>
                                    <div class="flex items-center bg-gray-900 rounded-xl p-2 border border-gray-700 justify-between h-[60px] md:h-[74px]" :class="{'opacity-80': isWaiverLocked}">
                                        <button @click="updateJumpers(form.jumpers - 1)" :disabled="isWaiverLocked" class="w-12 h-full font-bold rounded-lg border border-gray-700 flex items-center justify-center text-white">-</button>
                                        <div class="text-center"><span class="text-2xl font-black text-white">{{ form.jumpers }}</span></div>
                                        <button @click="updateJumpers(form.jumpers + 1)" :disabled="isWaiverLocked" class="w-12 h-full font-bold rounded-lg border border-gray-700 bg-orange-500 text-white flex items-center justify-center">+</button>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="bg-gray-800 p-5 md:p-6 rounded-3xl border border-gray-700 shadow-xl">
                            <h3 class="text-white font-bold uppercase mb-4 flex items-center gap-2 text-sm md:text-base"><span class="bg-blue-600 text-xs px-2 py-1 rounded text-white">3</span> Horario</h3>
                            <div v-if="!form.date" class="text-center py-8 border-2 border-dashed border-gray-700 rounded-2xl text-gray-500 text-sm">Selecciona un día arriba 👆</div>
                            <div v-else class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2 md:gap-3">
                                <button v-for="time in timeSlots" :key="time" @click="selectSlot(time)" class="py-2 px-1 rounded-lg border text-sm font-bold transition-all" :class="form.time_slot === time ? 'bg-white text-gray-900 border-white' : 'bg-gray-900 text-gray-300 border-gray-700'">{{ time }}</button>
                            </div>
                        </section>
                    </div>

                    <div class="lg:col-span-1 mt-6 lg:mt-0">
                        <div class="bg-gray-800 rounded-3xl p-6 border border-gray-700 lg:sticky lg:top-24 shadow-2xl">
                            <h3 class="text-lg md:text-xl font-black text-white uppercase mb-6 border-b border-gray-700 pb-4">Resumen</h3>
                            <div class="mb-6">
                                <label class="text-xs text-gray-500 font-bold uppercase mb-2 block pl-2">Email</label>
                                <input v-model="form.email_contact" type="email" class="w-full bg-gray-900 border rounded-xl px-4 py-3 text-white outline-none text-sm" :class="user ? 'border-green-500/50 cursor-not-allowed' : 'border-gray-600'" :readonly="!!user">
                            </div>
                            <div class="space-y-3 mb-8 text-sm text-gray-400 bg-gray-900/50 p-4 rounded-xl border border-gray-700/50">
                                <div class="flex justify-between"><span>Fecha:</span> <span class="text-white font-bold">{{ form.date || '--' }}</span></div>
                                <div class="flex justify-between"><span>Hora:</span> <span class="text-white font-bold">{{ form.time_slot || '--' }}</span></div>
                                <div class="flex justify-between"><span>Total:</span> <span class="text-xl text-orange-500 font-black">${{ form.total_price }}</span></div>
                            </div>
                            <button @click="submitBooking" :disabled="form.processing" class="w-full py-4 rounded-xl bg-gradient-to-r from-orange-600 to-red-600 text-white font-black uppercase tracking-widest">Confirmar Reserva</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </MainLayout>
</template>