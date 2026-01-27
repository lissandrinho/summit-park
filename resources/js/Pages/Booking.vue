<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { computed, onMounted, watch } from 'vue';

// --- PROPS Y CONFIGURACIÓN ---
const props = defineProps({
    prefilled: {
        type: Object,
        default: () => ({ waiver_id: null, jumpers: 1 })
    },
    // Recibimos las actividades de la DB (Ej: [{duration: 60, price: 400}, ...])
    activities: {
        type: Array,
        default: () => [] 
    }
});

const timeSlots = ['14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00'];

const form = useForm({
    waiver_id: props.prefilled.waiver_id,
    date: '',
    jumpers: props.prefilled.jumpers, 
    duration: 60, // Valor inicial (se ajustará al montar)
    time_slot: '',
    email_contact: '', 
    total_price: 0, // Iniciamos en 0
});

// --- LÓGICA DE BLOQUEO ---
const isWaiverLocked = computed(() => !!form.waiver_id);

// --- CICLO DE VIDA ---
onMounted(() => {
    // 1. Si hay actividades, seleccionamos la primera por defecto
    if (props.activities.length > 0) {
        // Ordenamos por precio para asegurar que la más barata sea la default
        const defaultActivity = props.activities.sort((a,b) => a.price - b.price)[0];
        form.duration = defaultActivity.duration;
    }
    // 2. Calculamos el total inicial
    updateTotal();
});

// --- LÓGICA DE FECHAS ---
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

// --- CÁLCULO DE PRECIOS (CORREGIDO) ---
const updateTotal = () => {
    // 1. Buscamos el precio correspondiente a la duración seleccionada
    const activity = props.activities.find(a => a.duration === form.duration);
    
    // Si encontramos la actividad, usamos su precio, si no, 0
    const pricePerPerson = activity ? parseFloat(activity.price) : 0;
    
    // 2. LA FÓRMULA CLAVE: Personas * Precio Unitario
    form.total_price = form.jumpers * pricePerPerson;
};

// Observamos cambios para recalcular en tiempo real
watch(
    () => [form.jumpers, form.duration], 
    () => updateTotal()
);

// --- INTERACCIÓN ---
const selectDate = (dateValue) => form.date = dateValue;
const selectSlot = (time) => form.time_slot = time;

const selectDuration = (minutes) => {
    form.duration = minutes;
    // El 'watch' se encarga de llamar a updateTotal
};

const updateJumpers = (val) => {
    if (isWaiverLocked.value) return; 
    if (val < 1 || val > 50) return;
    form.jumpers = val;
    // El 'watch' se encarga de llamar a updateTotal
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

        <div class="bg-gray-900 min-h-screen pt-24 pb-32 relative font-sans text-gray-100">
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="max-w-6xl mx-auto px-6 relative z-10">
                
                <div class="text-center mb-12">
                    <div v-if="isWaiverLocked" class="inline-flex items-center gap-2 bg-green-500/10 text-green-400 text-xs font-bold px-4 py-2 rounded-full mb-4 uppercase tracking-widest border border-green-500/20 shadow-[0_0_20px_rgba(74,222,128,0.1)] animate-in fade-in zoom-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Waiver Vinculado Correctamente
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-white uppercase mb-2 tracking-tighter">
                        Configura tu <span class="text-orange-500">Salto</span>
                    </h1>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        
                        <section class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                            <h3 class="text-white font-bold uppercase mb-4 flex items-center gap-2">
                                <span class="bg-blue-600 text-xs px-2 py-1 rounded text-white">1</span> Elige el Día
                            </h3>
                            <div class="flex gap-3 overflow-x-auto pb-2 custom-scrollbar">
                                <button v-for="date in availableDates" :key="date.value" @click="selectDate(date.value)" 
                                    class="min-w-[90px] p-4 rounded-2xl border transition-all text-center"
                                    :class="form.date === date.value ? 'bg-orange-500 border-orange-500 text-white shadow-lg' : 'bg-gray-900 border-gray-700 text-gray-400 hover:border-gray-500'">
                                    <span class="text-xs uppercase font-bold block">{{ date.label }}</span>
                                </button>
                            </div>
                        </section>

                        <section class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                            <h3 class="text-white font-bold uppercase mb-4 flex items-center gap-2">
                                <span class="bg-blue-600 text-xs px-2 py-1 rounded text-white">2</span> Detalles
                            </h3>
                            <div class="grid md:grid-cols-2 gap-8">
                                
                                <div>
                                    <label class="text-xs text-gray-500 font-bold uppercase mb-3 block pl-2">Tiempo</label>
                                    <div class="space-y-3">
                                        <button v-for="act in props.activities" :key="act.id" @click="selectDuration(act.duration)" 
                                            class="w-full flex justify-between items-center p-4 rounded-xl border transition-all"
                                            :class="form.duration === act.duration ? 'bg-blue-600/20 border-blue-500 text-white shadow-[0_0_15px_rgba(37,99,235,0.3)]' : 'bg-gray-900 border-gray-700 text-gray-400 hover:bg-gray-700'">
                                            <span class="font-bold flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                {{ act.duration }} Min
                                            </span>
                                            <span class="text-blue-400 font-mono text-lg font-bold">${{ act.price }}</span>
                                        </button>
                                        
                                        <div v-if="props.activities.length === 0" class="text-red-400 text-xs p-2 border border-red-500/50 rounded-lg">
                                            ⚠️ No hay precios configurados en el sistema.
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="text-xs text-gray-500 font-bold uppercase mb-3 block pl-2 flex justify-between">
                                        Personas
                                        <span v-if="isWaiverLocked" class="text-orange-500 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                                            Bloqueado
                                        </span>
                                    </label>
                                    
                                    <div class="flex items-center bg-gray-900 rounded-xl p-2 border border-gray-700 justify-between h-[74px] relative overflow-hidden" 
                                         :class="{'opacity-80 border-orange-500/30': isWaiverLocked}">
                                        
                                        <button @click="updateJumpers(form.jumpers - 1)" 
                                            :disabled="isWaiverLocked"
                                            class="w-12 h-full font-bold rounded-lg transition text-xl border border-gray-700 flex items-center justify-center"
                                            :class="isWaiverLocked ? 'bg-gray-800 text-gray-600 cursor-not-allowed' : 'bg-gray-800 text-white hover:bg-gray-700'">
                                            -
                                        </button>

                                        <div class="text-center">
                                            <span class="text-3xl font-black text-white tracking-tighter block leading-none">{{ form.jumpers }}</span>
                                            <span class="text-[10px] text-gray-500 uppercase font-bold">Jumpers</span>
                                        </div>

                                        <button @click="updateJumpers(form.jumpers + 1)" 
                                            :disabled="isWaiverLocked"
                                            class="w-12 h-full font-bold rounded-lg transition text-xl shadow-lg flex items-center justify-center"
                                            :class="isWaiverLocked ? 'bg-gray-800 text-gray-600 cursor-not-allowed border border-gray-700' : 'bg-orange-500 text-white hover:bg-orange-400 shadow-orange-500/20'">
                                            +
                                        </button>
                                    </div>
                                    <p v-if="isWaiverLocked" class="text-[10px] text-orange-400/80 mt-2 text-center italic">Cantidad fijada en documento legal.</p>
                                </div>
                            </div>
                        </section>

                        <section class="bg-gray-800 p-6 rounded-3xl border border-gray-700 shadow-xl">
                            <h3 class="text-white font-bold uppercase mb-4 flex items-center gap-2">
                                <span class="bg-blue-600 text-xs px-2 py-1 rounded text-white">3</span> Horario
                            </h3>
                            <div v-if="!form.date" class="text-center py-8 border-2 border-dashed border-gray-700 rounded-2xl text-gray-500">Selecciona un día arriba 👆</div>
                            <div v-else class="grid grid-cols-4 sm:grid-cols-5 gap-3 animate-in fade-in">
                                <button v-for="time in timeSlots" :key="time" @click="selectSlot(time)" 
                                    class="py-2 px-1 rounded-lg border text-sm font-bold transition-all"
                                    :class="form.time_slot === time ? 'bg-white text-gray-900 scale-105 border-white' : 'bg-gray-900 text-gray-300 border-gray-700 hover:border-gray-500'">
                                    {{ time }}
                                </button>
                            </div>
                        </section>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-gray-800 rounded-3xl p-6 border border-gray-700 sticky top-24 shadow-2xl">
                            <h3 class="text-xl font-black text-white uppercase mb-6 border-b border-gray-700 pb-4">Resumen</h3>
                            
                            <div class="mb-6">
                                <label class="text-xs text-gray-500 font-bold uppercase mb-2 block pl-2">Email de Contacto</label>
                                <input v-model="form.email_contact" type="email" placeholder="tu@email.com" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white focus:border-orange-500 outline-none">
                            </div>

                            <div class="space-y-3 mb-8 text-sm text-gray-400 bg-gray-900/50 p-4 rounded-xl border border-gray-700/50">
                                <div class="flex justify-between border-b border-gray-700 pb-2"><span>Fecha:</span> <span class="text-white font-bold">{{ form.date || '--' }}</span></div>
                                <div class="flex justify-between border-b border-gray-700 pb-2"><span>Hora:</span> <span class="text-white font-bold">{{ form.time_slot || '--' }}</span></div>
                                <div class="flex justify-between border-b border-gray-700 pb-2">
                                    <span>Jumpers:</span> <span class="text-white font-bold">{{ form.jumpers }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-2">
                                    <span>Total a Pagar:</span> 
                                    <span class="text-3xl text-orange-500 font-black tracking-tighter drop-shadow-lg">${{ form.total_price }}</span>
                                </div>
                            </div>

                            <button @click="submitBooking" :disabled="form.processing" class="w-full py-4 rounded-xl bg-gradient-to-r from-orange-600 to-red-600 text-white font-black uppercase tracking-widest hover:scale-[1.02] transition-all disabled:opacity-50 shadow-lg">
                                <span v-if="form.processing">Procesando...</span>
                                <span v-else>Finalizar Reserva</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar { height: 6px; }
.custom-scrollbar::-webkit-scrollbar-track { background: #1f2937; border-radius: 10px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #4b5563; border-radius: 10px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #f97316; }
</style>