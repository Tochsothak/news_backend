import './bootstrap';
import "@phosphor-icons/web/bold";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
