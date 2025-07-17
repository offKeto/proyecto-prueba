import 'primeicons/primeicons.css';
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/saga-blue/theme.css';
import { createApp } from 'vue';
import '../css/app.css';
import AboutUsApp from './AboutUs.vue';
import App from './App.vue';
import ContactApp from './Contact.vue';
import LoginApp from './Login.vue';
import RegisterApp from './Register.vue';
import ToDoApp from './ToDoList.vue';

const app = createApp(App);
app.use(PrimeVue);
app.mount('#app');

const toDoApp = createApp(ToDoApp);
toDoApp.use(PrimeVue);
toDoApp.mount('#todoapp');

const contactApp = createApp(ContactApp);
contactApp.use(PrimeVue);
contactApp.mount('#contactapp');

const aboutUsApp = createApp(AboutUsApp);
aboutUsApp.use(PrimeVue);
aboutUsApp.mount('#aboutusapp');

const login = createApp(LoginApp);
login.use(PrimeVue);
login.mount('#login');

const register = createApp(RegisterApp);
register.use(PrimeVue);
register.mount('#register');
