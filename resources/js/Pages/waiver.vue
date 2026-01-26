<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref, onMounted } from 'vue';

// RECIBIMOS LA RESERVA PARA SABER EL CUPO (opcional)
const props = defineProps({
    booking: {
        type: Object,
        default: null
    }
});

// --- LÓGICA DE FIRMA (CANVAS) ---
const canvasRef = ref(null);
const isDrawing = ref(false);
const signatureError = ref(false);

const startDrawing = (e) => {
    isDrawing.value = true;
    signatureError.value = false;
    const canvas = canvasRef.value;
    const ctx = canvas.getContext('2d');
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#000';
    
    const { offsetX, offsetY } = getCoordinates(e, canvas);
    ctx.beginPath();
    ctx.moveTo(offsetX, offsetY);
};

const draw = (e) => {
    if (!isDrawing.value) return;
    const canvas = canvasRef.value;
    const ctx = canvas.getContext('2d');
    const { offsetX, offsetY } = getCoordinates(e, canvas);
    ctx.lineTo(offsetX, offsetY);
    ctx.stroke();
};

const stopDrawing = () => {
    isDrawing.value = false;
    saveSignature();
};

const getCoordinates = (e, canvas) => {
    const rect = canvas.getBoundingClientRect();
    let clientX, clientY;
    if (e.touches && e.touches.length > 0) {
        clientX = e.touches[0].clientX;
        clientY = e.touches[0].clientY;
    } else {
        clientX = e.clientX;
        clientY = e.clientY;
    }
    return { offsetX: clientX - rect.left, offsetY: clientY - rect.top };
};

const clearSignature = () => {
    const canvas = canvasRef.value;
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    form.signature = null;
};

const saveSignature = () => {
    const canvas = canvasRef.value;
    form.signature = canvas.toDataURL('image/png');
};

onMounted(() => {
    if (canvasRef.value) {
        const canvas = canvasRef.value;
        const parent = canvas.parentElement;
        canvas.width = parent.clientWidth;
        canvas.height = 200;
    }
});

// --- FORMULARIO UNIFICADO (GRUPO FAMILIAR) ---
const form = useForm({
    booking_id: props.booking?.id, // ID de la reserva vinculada
    full_name: '',
    document_id: '',
    email: '',
    phone: '',
    birth_date: '',
    
    // Array dinámico de menores
    minors: [], 
    
    signature: null,
    terms_accepted: false,
});

// GESTIÓN DINÁMICA DE MENORES
const addMinor = () => {
    if (props.booking) {
        // Calculamos total: 1 Adulto + menores actuales
        const totalActual = 1 + form.minors.length;
        
        // Solo permitimos agregar si hay cupo en la reserva
        if (totalActual < props.booking.jumpers) {
            form.minors.push({ name: '', document_id: '', birth_date: '' });
        } else {
            alert(`Tu reserva es para ${props.booking.jumpers} personas. No puedes agregar más saltadores.`);
        }
    } else {
        // Sin booking, permitimos agregar menores libremente (máximo 10)
        if (form.minors.length < 10) {
            form.minors.push({ name: '', document_id: '', birth_date: '' });
        } else {
            alert('Máximo 10 menores permitidos.');
        }
    }
};

const removeMinor = (index) => {
    form.minors.splice(index, 1);
};

const submit = () => {
    if (!form.signature) {
        signatureError.value = true;
        return; 
    }
    
    form.post(route('waiver.store'), {
        preserveScroll: true,
        onError: (errors) => {
            console.error("Error:", errors);
        }
    });
};
</script>

<template>
    <MainLayout>
        <Head title="Firmar Waiver Grupal" />

        <div class="bg-gray-900 min-h-screen pt-24 pb-24 relative overflow-hidden">
            <div class="max-w-3xl mx-auto px-6 relative z-10">
                <div class="bg-gray-800 rounded-[2.5rem] border border-gray-700 p-8 md:p-12 shadow-2xl relative overflow-hidden">
                    
                    <div class="mb-10 text-center">
                        <h2 class="text-3xl md:text-4xl font-black text-white uppercase mb-2 tracking-tight">Deslinde de Responsabilidad</h2>
                        <p v-if="props.booking" class="text-orange-500 font-bold text-sm uppercase">Reserva para {{ props.booking.jumpers }} saltadores</p>
                        <p v-else class="text-orange-500 font-bold text-sm uppercase">Firma de Waiver Independiente</p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-8">
                        <div class="space-y-6">
                            <h3 class="text-white font-bold uppercase text-xs border-b border-gray-700 pb-2">Adulto Responsable</h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <input v-model="form.full_name" type="text" class="bg-gray-900 border border-gray-600 rounded-full px-6 py-4 text-white outline-none" placeholder="Nombre completo" required>
                                <input v-model="form.document_id" type="text" class="bg-gray-900 border border-gray-600 rounded-full px-6 py-4 text-white outline-none" placeholder="Cédula de Identidad" required>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="flex justify-between items-center border-b border-gray-700 pb-2">
                                <h3 class="text-white font-bold uppercase text-xs">Menores a Cargo ({{ form.minors.length }})</h3>
                                <button 
                                    v-if="!props.booking || (form.minors.length + 1) < props.booking.jumpers"
                                    type="button" 
                                    @click="addMinor" 
                                    class="text-[10px] bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded-lg font-black uppercase transition"
                                >
                                    + Agregar Menor
                                </button>
                            </div>

                            <TransitionGroup name="fade">
                                <div v-for="(minor, index) in form.minors" :key="index" class="bg-gray-900/50 p-6 rounded-3xl border border-gray-700 relative mb-4">
                                    <button @click="removeMinor(index)" type="button" class="absolute top-4 right-4 text-red-500 hover:text-red-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <input v-model="minor.name" placeholder="Nombre del niño/a" class="bg-gray-900 border-gray-600 rounded-xl px-4 py-3 text-white text-sm" required>
                                        <input v-model="minor.document_id" placeholder="Cédula del menor" class="bg-gray-900 border-gray-600 rounded-xl px-4 py-3 text-white text-sm" required>
                                    </div>
                                </div>
                            </TransitionGroup>
                        </div>

                        <div class="bg-gray-900/80 rounded-3xl p-6 h-48 overflow-y-auto border border-gray-700 text-xs text-gray-400 leading-relaxed custom-scrollbar">
                            <p class="mb-4">
                                Yo, <strong class="text-white uppercase">{{ form.full_name || '_______' }}</strong>, declaro bajo juramento ser responsable de mí mismo 
                                <span v-if="form.minors.length > 0">
                                    y de los menores: <strong class="text-orange-400" v-for="m in form.minors" :key="m.name">{{ m.name }}, </strong>
                                </span>
                                asumiendo los riesgos inherentes a las actividades en **Summit Trampoline Park**.
                            </p>
                        </div>

                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <label class="text-gray-500 text-[10px] font-black uppercase tracking-widest">Firma del Responsable</label>
                                <button type="button" @click="clearSignature" class="text-[10px] text-orange-500 font-black uppercase">Borrar</button>
                            </div>
                            <div class="relative bg-white rounded-3xl overflow-hidden border-4 border-transparent hover:border-orange-500/30 transition">
                                <canvas ref="canvasRef" @mousedown="startDrawing" @mousemove="draw" @mouseup="stopDrawing" @mouseleave="stopDrawing" @touchstart.prevent="startDrawing" @touchmove.prevent="draw" @touchend.prevent="stopDrawing" class="w-full h-full block"></canvas>
                            </div>
                            <p v-if="signatureError" class="text-red-500 text-xs mt-2">Por favor, firma el documento</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <input 
                                v-model="form.terms_accepted" 
                                type="checkbox" 
                                id="terms" 
                                class="w-5 h-5 rounded border-gray-600 bg-gray-900 text-orange-500 focus:ring-orange-500"
                            >
                            <label for="terms" class="text-gray-400 text-sm">
                                Acepto los términos y condiciones del deslinde de responsabilidad
                            </label>
                        </div>

                        <button type="submit" :disabled="!form.terms_accepted || !form.signature" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-black uppercase py-5 rounded-full shadow-xl shadow-orange-500/20 disabled:opacity-50 disabled:cursor-not-allowed">
                            Confirmar y Finalizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </MainLayout>
</template>