import type { App } from 'vue';
import PrimeVue from 'primevue/config';
import { Tailwind } from '@primevue/themes';

export function initializePrimeVue(app: App) {
    app.use(PrimeVue, {
        unstyled: true,
        pt: Tailwind,
    });
}
