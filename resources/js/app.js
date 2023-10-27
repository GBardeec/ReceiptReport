import { createApp } from 'vue';
import Index from "@/components/Index.vue";
import './bootstrap';
import axios from 'axios';
import router from './router';

const app = createApp({
    el: '#app',
    components: {
        Index,
    }
});


app.use(router);

app.mount('#app');
