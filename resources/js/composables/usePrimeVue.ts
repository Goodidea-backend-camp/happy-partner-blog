import type { App } from 'vue';
import PrimeVue from "primevue/config";
import PrimeUITailwind from "tailwindcss-primeui";

export function initializePrimeVue(app: App) {
    app.use(PrimeVue, {
        unstyled: true,
        pt: PrimeUITailwind
    });
}
