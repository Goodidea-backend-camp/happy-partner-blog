import type { App } from 'vue';
import PrimeVue from "primevue/config";

export function initializePrimeVue(app: App) {
    app.use(PrimeVue, {
        unstyled: true
    });
}
