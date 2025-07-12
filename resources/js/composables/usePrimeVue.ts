import type { App } from 'vue';
import PrimeVue from "primevue/config";

export function initializePrimeVue(app: App) {
    app.use(PrimeVue, {
        // TODO: 目前尚未確認是否使用 unstyled 模式，如果後續確認使用 unstyled 模式，應考慮將 `@primeuix/themes` 套件刪除
        unstyled: true
    });
}
