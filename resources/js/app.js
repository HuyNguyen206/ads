require('./bootstrap');
import {
    createApp
} from 'vue';
const app = createApp({});
import VueChatScroll from 'vue-chat-scroll';

app.use(VueChatScroll);

// You can register your components globally like this also
// Add as many components as you want.

// app.component('Example', require('./components/Example.vue').default)
app.component('image-preview', require('./components/ImagePreview.vue').default)
app.component('category', require('./components/Category.vue').default)
app.component('address-ads', require('./components/Address.vue').default)
app.component('message', require('./components/Message.vue').default)
app.component('conversation', require('./components/Conversation.vue').default)
app.component('show-phone-number', require('./components/ShowPhoneNumber.vue').default)
app.component('save-ad', require('./components/SaveAd.vue').default)
app.mount('#app');
