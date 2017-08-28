require('./bootstrap');

Vue.component('example', require('./components/Example.vue'));
Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));

const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();
        Echo.private('chat').listen('MessageSent', (e) => {
            //console.log(e.user.id);
            this.messages.push({
                message: e.message.message,
                user: e.user
            });
        });
    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
        });
        },

        addMessage(message) {
            this.messages.push(message);
            //onsole.log(this.messages);
            axios.post('/messages', message).then(response => {
                console.log(response.data);
        });
        }
    }
});