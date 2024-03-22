import Alpine from "alpinejs";
import Precognition from "laravel-precognition-alpine";
import { error } from "./client-error-report";

navigator.serviceWorker.register("/sw.js");

window.addEventListener("DOMContentLoaded", () => {
  Alpine.start();
});

Alpine.data("clientErrorReport", error);
Alpine.plugin(Precognition);
