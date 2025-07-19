import type { App } from 'vue';
import PrimeVue from "primevue/config";

export function initializePrimeVue(app: App) {
    app.use(PrimeVue, {
        unstyled: true,
        pt: {
            /**
             * Defines the shared pass through properties per component type.
             * @see https://primevue.org/passthrough
             */
        }
    });
}
