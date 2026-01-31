<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref, onMounted, computed } from 'vue';

// --- CONFIGURACIÓN ---
const MAX_MINORS = 3; 
const WHATSAPP_NUMBER = "59899123456"; 

const props = defineProps({
    booking: {
        type: Object,
        default: () => ({ id: null, jumpers: 1 })
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
    ctx.lineWidth = 3;
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

const stopDrawing = () => { isDrawing.value = false; saveSignature(); };

const getCoordinates = (e, canvas) => {
    const rect = canvas.getBoundingClientRect();
    let clientX = e.touches ? e.touches[0].clientX : e.clientX;
    let clientY = e.touches ? e.touches[0].clientY : e.clientY;
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

// --- FORMULARIO ---
const form = useForm({
    booking_id: null, 
    full_name: '',
    document_id: '',
    email: '',
    phone: '',
    birth_date: '', 
    minors: [],
    signature: null,
    terms_accepted: false,
});

// --- REGLAS DE NEGOCIO ---
const canAddMore = computed(() => {
    return form.minors.length < MAX_MINORS;
});

const totalSigners = computed(() => {
    return 1 + form.minors.length; 
});

const addMinor = () => {
    if (canAddMore.value) {
        form.minors.push({ name: '', document_id: '' });
    }
};

const removeMinor = (index) => {
    form.minors.splice(index, 1);
};

// CORRECCIÓN DEL CLICK EN TÉRMINOS
const toggleTerms = () => {
    form.terms_accepted = !form.terms_accepted;
};

const submit = () => {
    if (!form.signature) {
        signatureError.value = true;
        const el = document.getElementById('signature-pad');
        if(el) el.scrollIntoView({ behavior: 'smooth' });
        return; 
    }
    form.post(route('waiver.store'), { preserveScroll: true });
};
</script>

<template>
    <MainLayout>
        <Head title="Waiver Seguro" />

        <div class="bg-gray-900 min-h-screen pt-24 pb-24 relative overflow-hidden font-sans text-white">
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-gray-800 via-gray-900 to-black opacity-80 pointer-events-none"></div>
            
            <div class="max-w-3xl mx-auto px-6 relative z-10">
                <div class="bg-gray-800/90 backdrop-blur-xl rounded-[2rem] border border-gray-700 shadow-2xl overflow-hidden">
                    <div class="h-2 w-full bg-gradient-to-r from-orange-500 via-red-500 to-orange-500"></div>
                    
                    <div class="p-8 md:p-12">
                        <div class="text-center mb-10">
                            <h2 class="text-3xl md:text-4xl font-black text-white uppercase italic tracking-tighter mb-2">Acuerdo de Responsabilidad</h2>
                            <p class="text-gray-400 text-sm">Paso 1: Firma Legal Obligatoria</p>
                        </div>

                        <form @submit.prevent="submit" class="space-y-10">
                            
                            <div class="space-y-4">
                                <h3 class="text-white font-bold uppercase text-sm border-b border-gray-700 pb-2 flex items-center gap-2">
                                    <span class="bg-orange-500 text-white w-5 h-5 rounded-full flex items-center justify-center text-xs">1</span>
                                    Datos del Responsable (Adulto)
                                </h3>
                                
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="text-[10px] text-gray-500 uppercase font-bold pl-3">Nombre Completo</label>
                                        <input v-model="form.full_name" type="text" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white text-sm focus:border-orange-500 outline-none transition" placeholder="Como figura en el documento" required>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[10px] text-gray-500 uppercase font-bold pl-3">Documento (CI/DNI)</label>
                                        <input v-model="form.document_id" type="text" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white text-sm focus:border-orange-500 outline-none transition" placeholder="Sin puntos ni guiones" required>
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-3 gap-4">
                                    <div class="md:col-span-1 space-y-1">
                                        <label class="text-[10px] text-gray-500 uppercase font-bold pl-3">Fecha de Nacimiento</label>
                                        <input v-model="form.birth_date" type="date" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white text-sm focus:border-orange-500 outline-none transition" required>
                                    </div>
                                    <div class="md:col-span-1 space-y-1">
                                        <label class="text-[10px] text-gray-500 uppercase font-bold pl-3">Email</label>
                                        <input v-model="form.email" type="email" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white text-sm focus:border-orange-500 outline-none transition" placeholder="correo@ejemplo.com" required>
                                    </div>
                                    <div class="md:col-span-1 space-y-1">
                                        <label class="text-[10px] text-gray-500 uppercase font-bold pl-3">Teléfono</label>
                                        <input v-model="form.phone" type="tel" class="w-full bg-gray-900 border border-gray-600 rounded-xl px-4 py-3 text-white text-sm focus:border-orange-500 outline-none transition" placeholder="099..." required>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center border-b border-gray-700 pb-2">
                                    <h3 class="text-white font-bold uppercase text-sm flex items-center gap-2">
                                        <span class="bg-blue-600 text-white w-5 h-5 rounded-full flex items-center justify-center text-xs">2</span>
                                        Menores a Cargo
                                    </h3>
                                    <span class="text-[10px] bg-gray-700 text-gray-300 px-2 py-1 rounded-md font-bold">
                                        {{ form.minors.length }} / {{ MAX_MINORS }}
                                    </span>
                                </div>

                                <div class="space-y-3">
                                    <div v-for="(minor, index) in form.minors" :key="index" class="bg-gray-900/50 p-4 rounded-2xl border border-gray-700 flex flex-col md:flex-row gap-3 items-start md:items-center relative">
                                        <span class="absolute -left-2 top-1/2 -translate-y-1/2 w-5 h-5 bg-blue-600 border-2 border-gray-800 rounded-full flex items-center justify-center text-[9px] font-bold z-10">{{ index + 1 }}</span>
                                        <div class="grid grid-cols-2 gap-3 w-full pl-2">
                                            <input v-model="minor.name" placeholder="Nombre completo del menor" class="bg-gray-800 border-gray-600 rounded-lg px-3 py-2 text-white text-xs focus:border-blue-500 outline-none" required>
                                            <input v-model="minor.document_id" placeholder="CI del menor" class="bg-gray-800 border-gray-600 rounded-lg px-3 py-2 text-white text-xs focus:border-blue-500 outline-none" required>
                                        </div>
                                        <button @click="removeMinor(index)" type="button" class="text-red-500 hover:text-red-400 bg-red-500/10 p-2 rounded-lg ml-auto transition">X</button>
                                    </div>
                                </div>
                                <button v-if="canAddMore" type="button" @click="addMinor" class="w-full py-3 rounded-xl border-2 border-dashed border-blue-600/30 text-blue-400 hover:border-blue-600 text-xs font-black uppercase tracking-widest transition">
                                    + Agregar Menor
                                </button>
                            </div>

                            <div class="space-y-2">
                                <h3 class="text-white font-bold uppercase text-sm border-b border-gray-700 pb-2 flex items-center gap-2">
                                    <span class="bg-red-600 text-white w-5 h-5 rounded-full flex items-center justify-center text-xs">3</span>
                                    Términos Legales y Deslinde
                                </h3>
                                
                                <div class="bg-black/80 border border-gray-600 rounded-xl p-6 h-72 overflow-y-auto custom-scrollbar shadow-inner font-mono">
                                    <div class="space-y-4 text-xs md:text-sm text-gray-300 leading-relaxed text-justify">
                                        
                                        <p class="font-bold text-white border-b border-gray-700 pb-2 mb-4">
                                            POR FAVOR LEA CUIDADOSAMENTE. ESTE ES UN DOCUMENTO LEGAL VINCULANTE.
                                        </p>

                                        <p>
                                            Yo, <span class="text-orange-400 font-bold uppercase decoration-orange-500 underline decoration-dotted">{{ form.full_name || 'EL FIRMANTE' }}</span>, titular del documento <span class="text-orange-400 font-bold">{{ form.document_id || '___' }}</span>, declaro bajo juramento ser mayor de edad y tener la custodia legal o autorización de los menores listados.
                                        </p>

                                        <div class="pl-4 border-l-2 border-orange-500/50 space-y-4 my-4">
                                            <p>
                                                <span class="text-orange-400 font-bold">1. NATURALEZA DE LA ACTIVIDAD Y RIESGOS:</span>
                                                Entiendo que las actividades en SUMMIT PARK (trampolines, escalada, parkour) son de alto impacto físico. Reconozco que existen riesgos inherentes que no pueden ser eliminados completamente, incluyendo pero no limitado a: torceduras, fracturas, colisiones con otros saltadores o equipamiento, parálisis y, en casos extremos, la muerte. Asumo estos riesgos de manera voluntaria.
                                            </p>
                                            <p>
                                                <span class="text-orange-400 font-bold">2. ESTADO DE SALUD:</span>
                                                Declaro bajo juramento que yo y los menores a mi cargo gozamos de buena salud física y mental. Certifico que NO padecemos condiciones preexistentes como: problemas cardíacos, lesiones de columna/cuello, hipertensión, o embarazo. Acepto que Summit Park no es responsable por complicaciones derivadas de condiciones ocultas.
                                            </p>
                                            <p>
                                                <span class="text-orange-400 font-bold">3. REGLAMENTO Y CONDUCTA:</span>
                                                Me comprometo a obedecer todas las señales de seguridad y las instrucciones verbales del personal ("Referees"). Entiendo que está prohibido: el "doble rebote", saltar bajo la influencia de alcohol/drogas, y conductas agresivas. El incumplimiento resultará en la expulsión inmediata del parque sin derecho a reembolso.
                                            </p>
                                            <p>
                                                <span class="text-orange-400 font-bold">4. LIBERACIÓN DE RESPONSABILIDAD:</span>
                                                Por la presente libero, indulto y eximo de responsabilidad a SUMMIT PARK, sus propietarios, empleados y agentes de cualquier demanda por daños, lesiones o pérdidas materiales ocurridas dentro de las instalaciones, incluyendo aquellas causadas por negligencia ordinaria de la empresa.
                                            </p>
                                            <p>
                                                <span class="text-orange-400 font-bold">5. USO DE IMAGEN:</span>
                                                Autorizo a Summit Park a utilizar fotografías o grabaciones de video donde aparezca mi imagen o la de los menores a mi cargo para fines exclusivos de seguridad, marketing y publicidad en redes sociales, sin derecho a compensación económica.
                                            </p>
                                        </div>

                                        <p class="pt-4 border-t border-gray-800 text-gray-400 text-[11px] italic">
                                            Al firmar este documento, reconozco que he tenido tiempo suficiente para leerlo y comprender sus implicaciones legales. Esta firma digital tiene la misma validez que una firma manuscrita según la legislación vigente.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4" id="signature-pad">
                                <div class="flex justify-between items-end px-1">
                                    <h3 class="text-white font-bold uppercase text-sm">4. Firma Digital</h3>
                                    <button type="button" @click="clearSignature" class="text-[10px] text-orange-500 font-black uppercase hover:text-white transition">Borrar</button>
                                </div>
                                <div class="relative bg-white rounded-2xl overflow-hidden border-4" :class="signatureError ? 'border-red-500 shadow-[0_0_20px_rgba(239,68,68,0.4)]' : 'border-transparent'">
                                    <canvas ref="canvasRef" @mousedown="startDrawing" @mousemove="draw" @mouseup="stopDrawing" @mouseleave="stopDrawing" @touchstart.prevent="startDrawing" @touchmove.prevent="draw" @touchend.prevent="stopDrawing" class="w-full h-full block h-48 cursor-crosshair"></canvas>
                                    <div class="absolute bottom-2 left-0 w-full text-center pointer-events-none opacity-20">
                                        <p class="text-gray-400 font-black uppercase text-3xl tracking-widest">FIRMÁ AQUÍ</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start gap-3 p-4 bg-orange-500/10 rounded-xl border border-orange-500/30 hover:bg-orange-500/20 transition cursor-pointer" @click="toggleTerms">
                                    <div class="flex items-center h-6">
                                        <input v-model="form.terms_accepted" id="terms" type="checkbox" class="w-5 h-5 rounded border-gray-500 text-orange-600 focus:ring-orange-500 bg-gray-900 cursor-pointer pointer-events-none">
                                    </div>
                                    <label for="terms" class="text-sm text-gray-200 cursor-pointer font-medium select-none pointer-events-none">
                                        He leído, comprendido y acepto los <span class="text-orange-400 font-bold">Términos y Condiciones</span> expuestos arriba. Certifico que los datos ingresados son reales.
                                    </label>
                                </div>
                            </div>

                            <button type="submit" :disabled="!form.terms_accepted || form.processing" class="w-full bg-gradient-to-r from-orange-600 to-red-600 text-white font-black uppercase py-5 rounded-xl transition-all hover:shadow-[0_0_30px_rgba(249,115,22,0.4)] hover:scale-[1.01] active:scale-95 disabled:opacity-50 disabled:grayscale disabled:cursor-not-allowed group">
                                <span v-if="form.processing" class="flex items-center justify-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Procesando Firma...
                                </span>
                                <span v-else class="flex flex-col items-center leading-tight">
                                    <span class="text-lg">CONTINUAR A LA RESERVA</span>
                                    <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded-full mt-1 font-bold">
                                        FIRMANDO POR {{ totalSigners }} PERSONAS
                                    </span>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar { width: 8px; }
.custom-scrollbar::-webkit-scrollbar-track { background: #0f1115; border-radius: 4px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #374151; border-radius: 4px; border: 1px solid #1f2937; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #f97316; } 
</style>