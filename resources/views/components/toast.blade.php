<!-- Global Toast Notifications Container -->
<div class="fixed bottom-4 right-4 z-50 flex flex-col gap-2 max-w-sm w-full pointer-events-none px-4">
    <template x-for="toast in $store.sim.toasts" :key="toast.id">
        <div x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="transform translate-y-4 opacity-0 scale-95"
             x-transition:enter-end="transform translate-y-0 opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="transform translate-y-0 opacity-100 scale-100"
             x-transition:leave-end="transform translate-y-4 opacity-0 scale-95"
             class="pointer-events-auto bg-white rounded-xl shadow-xl border p-4 flex items-start gap-3 transition-all"
             :class="{
                 'border-emerald-200 bg-emerald-50/50 text-emerald-950': toast.type === 'success',
                 'border-blue-200 bg-blue-50/50 text-blue-950': toast.type === 'info',
                 'border-amber-200 bg-amber-50/50 text-amber-950': toast.type === 'warning',
                 'border-red-200 bg-red-50/50 text-red-950': toast.type === 'danger'
             }">
            
            <!-- Icon -->
            <div class="shrink-0 mt-0.5">
                <template x-if="toast.type === 'success'">
                    <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </div>
                </template>
                <template x-if="toast.type === 'info'">
                    <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i data-lucide="info" class="w-4 h-4"></i>
                    </div>
                </template>
                <template x-if="toast.type === 'warning'">
                    <div class="w-6 h-6 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                    </div>
                </template>
                <template x-if="toast.type === 'danger'">
                    <div class="w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                        <i data-lucide="alert-octagon" class="w-4 h-4"></i>
                    </div>
                </template>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <h4 class="text-xs font-bold" x-text="toast.title"></h4>
                <p class="text-xs text-slate-600 mt-0.5 leading-snug" x-text="toast.message"></p>
            </div>

            <!-- Close Button -->
            <button type="button" 
                    @click="$store.sim.toasts = $store.sim.toasts.filter(t => t.id !== toast.id)" 
                    class="shrink-0 text-slate-400 hover:text-slate-600 p-1">
                <i data-lucide="x" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </template>
</div>
