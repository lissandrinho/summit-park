<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    show: Boolean,
});

const emit = defineEmits(['close']);

const acceptRules = () => {
    // Al aceptar, vamos al Waiver (como definimos en el flujo)
    router.visit(route('waiver.create', { return_to: 'booking' }));
};

const close = () => {
    emit('close');
};
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-[70] overflow-y-auto" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div class="fixed inset-0 bg-gray-900/95 backdrop-blur-sm transition-opacity" @click="close"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="relative inline-block align-bottom bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl w-full border border-gray-700">
                
                <div class="bg-gradient-to-r from-gray-800 to-gray-750 px-6 py-5 border-b border-gray-700 flex justify-between items-center sticky top-0 z-10">
                    <h3 class="text-2xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                        <span class="text-orange-500">📋</span> Reglas del Parque
                    </h3>
                    <button @click="close" class="text-gray-400 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <div class="px-6 py-6 max-h-[65vh] overflow-y-auto custom-scrollbar bg-gray-900/50">
                    
                    <div class="mb-8">
                        <h4 class="text-orange-500 font-black uppercase text-lg mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                            Para Entrar al Parque
                        </h4>
                        <ul class="space-y-3 text-gray-300 text-sm leading-relaxed">
                            <li class="flex gap-3">
                                <span class="text-orange-500 font-bold">•</span>
                                <span>Todos deben tener el <strong>Waiver (Exención)</strong> lleno en totalidad y registrado en el Sistema.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-orange-500 font-bold">•</span>
                                <span>Uso obligatorio del <strong>brazalete de color</strong> provisto por SUMMIT.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-orange-500 font-bold">•</span>
                                <span><strong>Prohibido:</strong> Comidas, bebidas, gomas de mascar, correas, llaveros, teléfonos, cámaras y objetos punzantes.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-orange-500 font-bold">•</span>
                                <span>Está terminantemente prohibido faltar el respeto a los empleados (Staff).</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-orange-500 font-bold">•</span>
                                <span>No se permite el ingreso de botellas con líquidos (Solo se permite el mate).</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-orange-500 font-bold">•</span>
                                <span><strong>Calzado:</strong> No se permite entrar con zapatos o sin medias al área de trampolines (no descalzo).</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-orange-500 font-bold">•</span>
                                <span>Bultos o carteras serán sujeto a registro por el personal. Summit no se hace responsable por pérdidas.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-blue-500 font-black uppercase text-lg mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                            Antes de Saltar
                        </h4>
                        <ul class="space-y-3 text-gray-300 text-sm leading-relaxed">
                            <li class="flex gap-3">
                                <span class="text-blue-500 font-bold">•</span>
                                <span><strong>Bolsillos completamente vacíos.</strong> Quitarse los zapatos.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-blue-500 font-bold">•</span>
                                <span>Seguir las instrucciones del personal en todo momento.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-blue-500 font-bold">•</span>
                                <span>Saltar de acuerdo a su habilidad física. <strong>NO intentar trucos arriesgados.</strong></span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-blue-500 font-bold">•</span>
                                <span><strong>NO</strong> tocar, escalar o agarrarse de los colchones de seguridad o mallas.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-blue-500 font-bold">•</span>
                                <span><strong>NO</strong> se permiten juegos violentos, de lucha, empujar o correr en los trampolines.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-blue-500 font-bold">•</span>
                                <span><strong>Solo volteretas sencillas:</strong> NO se recomienda hacer volteretas dobles.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-blue-500 font-bold">•</span>
                                <span><strong>NO</strong> sentarse o acostarse en los trampolines ni colchones de seguridad.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-red-400 font-bold">!</span>
                                <span><strong>Restricciones de Salud:</strong> No recomendado para mujeres embarazadas, personas con problemas de columna, articulaciones o salud.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-gray-800 px-6 py-5 border-t border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-gray-500 text-center sm:text-left">
                        Al hacer clic en "Aceptar", confirmas que has leído y comprendido las reglas.
                    </p>
                    <div class="flex gap-3 w-full sm:w-auto">
                        <button 
                            @click="close"
                            class="flex-1 sm:flex-none px-6 py-3 rounded-full border border-gray-600 text-gray-300 font-bold hover:bg-gray-700 transition uppercase text-xs tracking-wide"
                        >
                            Cancelar
                        </button>
                        <button 
                            @click="acceptRules"
                            class="flex-1 sm:flex-none px-8 py-3 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-black hover:shadow-lg hover:shadow-orange-500/20 transition uppercase text-xs tracking-widest transform hover:scale-105"
                        >
                            Acepto y Firmar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: #111827; 
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #374151; 
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #4b5563; 
}
</style>