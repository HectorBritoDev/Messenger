import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: { //como las props o data
        messages: [],
        selectedConversation: [],
        conversations: [],
        querySearch: '',
        user: [],
    },
    mutations: { //como los methods // las mutations alteran los estados de las variables
        setUser(state, user) {
            state.user = user
        },
        newMessageList(state, messages) { //Siempre se recibe el estado
            state.messages = messages;
        },
        addMessage(state, message) {

            // ID de Conversación a actualizar last message y last_time
            // Una donde el yo O ESTE RECIBIENDO UN MENSAJE o UNA DONDE YO SEA QUIEN ENVIA EL MENSAJE
            const conversation = state.conversations.find(
                conversation => {
                    return (
                        conversation.contact_id == message.from_id ||
                        conversation.contact_id == message.to_id
                    );
                }
            );
            const author =
                this.authUser.id == message.from_id ? "Tú" : conversation.contact_name;

            conversation.last_message = author + ":" + message.content;
            conversation.last_time = message.created_at;

            if (
                state.selectedConversation &&
                (state.selectedConversation.contact_id == message.from_id ||
                    state.selectedConversation.contact_id == message.to_id)
            ) {
                //El calculo de written_by_me se hace
                //bien sea cuando se recibe un mensaje del canal(Mounted) o cuando se registra un mensaje(PostMessage)
                state.messages.push(message);
            }


        },
        conversationsList(state, conversations) {
            state.conversations = conversations
        },
        selectConversation(state, conversation) {
            state.selectedConversation = conversation;
        },
        updateQuerySearch(state, newValue) {
            state.querySearch = newValue;
        }
    },
    actions: { //Cosas asincronas o consultas al server //Las Actions llaman a las mutations
        getMessages(context, conversation) {
            return axios
                .get("/api/message?contact_id=" + conversation.contact_id)
                .then(response => {
                    context.commit('selectConversation', conversation);
                    context.commit("newMessageList", response.data);
                })
                .catch(error => console.log(error));
        },
        getConversations(context) {
            return axios
                .get("/api/conversation")
                .then(response => {
                    context.commit('conversationsList', response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        postMessage(context, newMessage) {
            const params = {
                to_id: context.state.selectedConversation.contact_id,
                content: newMessage
            };
            return axios
                .post("/api/message", params)
                .then(response => {
                    console.log(response.data);
                    const message = response.data;
                    message.written_by_me = true;
                    context.commit("addMessage", message);
                })
                .catch(error => {
                    alert(error);
                    console.log(error);
                });
        },
    },
    getters: {
        conversationsFiltered(state) {
            //Filter es case sensitive
            return state.conversations.filter(conversation =>
                conversation.contact_name
                .toLowerCase()
                .includes(state.querySearch.toLowerCase())
            );
        },
        getConversationById(state) {
            //Filter es case sensitive
            return function (conversationId) {

                return state.conversations.find(conversation =>
                    conversation.id == conversationId
                );
            }

        },

    }
})
