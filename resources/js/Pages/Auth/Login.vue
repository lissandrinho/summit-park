<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Ingresar" />

        <div class="fixed inset-0 bg-gray-900 flex flex-col justify-center items-center p-4">
            
            <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-orange-500/10 rounded-full blur-[120px] pointer-events-none -translate-x-1/3 -translate-y-1/3"></div>
            <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none translate-x-1/3 translate-y-1/3"></div>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-400 z-20">
                {{ status }}
            </div>

            <div class="w-full max-w-4xl bg-gray-800 rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2 relative z-10 border border-gray-700">
                
                <div class="hidden md:block relative h-full min-h-[500px]">
                    <img src="/images/R.png" alt="Summit Park" class="absolute inset-0 w-full h-full object-cover" />
                    
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-900/60 to-gray-900/10 mix-blend-multiply"></div>
                    
                    <div class="absolute bottom-8 left-8 text-white z-10">
                        <p class="font-bold text-lg uppercase tracking-widest text-orange-400">Summit Park</p>
                        <p class="text-gray-300 text-sm opacity-80">Panel de Administración</p>
                    </div>
                </div>

                <div class="p-8 md:p-12 flex flex-col justify-center bg-gray-800">
                    
                    <div class="flex justify-center mb-8">
                        <img src="/images/Summit-Logo-full-white.png" alt="Logo Summit" class="h-20 w-auto object-contain drop-shadow-lg" />
                    </div>

                    <div class="text-center mb-8">
                        <h2 class="text-xl font-bold text-white uppercase tracking-wider">Bienvenido</h2>
                        <p class="text-gray-400 text-sm mt-1">Ingresa tus credenciales para continuar</p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-5">
                        <div>
                            <InputLabel for="email" value="Correo Electrónico" class="text-gray-300 uppercase text-xs font-bold tracking-wider ml-1 mb-2" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full bg-gray-900 border-gray-700 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3 pl-4"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="usuario@summit.com"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="password" value="Contraseña" class="text-gray-300 uppercase text-xs font-bold tracking-wider ml-1 mb-2" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full bg-gray-900 border-gray-700 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3 pl-4"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" class="text-orange-500 focus:ring-orange-500 bg-gray-700 border-gray-600 rounded" />
                                <span class="ms-2 text-sm text-gray-400">Recordarme</span>
                            </label>
                            
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-xs text-orange-500 hover:text-orange-400 font-bold uppercase tracking-wide transition"
                            >
                                ¿Olvidaste la clave?
                            </Link>
                        </div>

                        <div class="pt-4">
                            <PrimaryButton
                                class="w-full justify-center py-4 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-400 hover:to-red-500 border-none rounded-xl text-white font-black uppercase tracking-widest shadow-lg shadow-orange-500/20 transition-all transform active:scale-95"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Ingresar
                            </PrimaryButton>
                        </div>
                    </form>
                </div>

            </div>
            
            <p class="text-gray-600 text-xs mt-6 z-10">© 2026 Summit Trampoline Park. Acceso Seguro.</p>
        </div>
    </GuestLayout>
</template>