<template>
    <div class="row">
        <div v-if="users" class="col-md-2">
            <p v-for="user in users" :key="user.id">
                <span>
                    <img style="border-radius: 50%" v-if="user.avatar" :src="user.avatar" width="50" height="50" alt="">
                </span>
                <a v-if="receiver_id === user.id" href="" style="font-weight: bold" @click.prevent="getMessages(e, user.id)">{{ user.name }}</a>
                <a v-else href=""  @click.prevent="getMessages(e, user.id)">{{ user.name }}</a>
            </p>

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">
                    <span>Chat </span>
                </div>
                <div
                    class="card-body chat-msg"
                    v-chat-scroll
                    v-if="this.receiver_id"
                >
                    <ul class="chat" v-for="(message, index) in messages" :key="message.id">

                        <li class="sender clearfix mt-5" style="margin-top: 63px !important;"
                            v-if="userId == message.sender.id">
                            <span class="chat-img left clearfix mx-2">
                            <img style="border-radius: 50%" v-if="message.sender.avatar" :src="message.sender.avatar" width="50" height="50" alt="">
                            </span>
                            <div class="chat-body2 clearfix">
                                <div class="header clearfix">
                                    <strong class="primary-font">
                                        {{ message.sender.name }}
                                    </strong>
                                    <small class="right text-muted ms-2">
                                        <span class="glyphicon glyphicon-time"></span>
                                        {{ message.created_at.created_at_human }}
                                    </small>
                                </div>
                                <p v-if="message.advertisement.link_ads">
                                    <a :href="message.advertisement.link_ads" target="_blank"> {{ message.advertisement.name }}</a>
                                    <img :src="message.advertisement.ad_feature_image" class="ms-2" v-if="message.advertisement.ad_feature_image"
                                         width="60" height="50" alt="">
                                </p>
                                <p>
                                    {{ message.body }}
                                </p>
                            </div>
                        </li>
                        <li class="buyer clearfix  mt-5" v-else>
                            <span class="chat-img right clearfix  mx-2">
                                <img style="border-radius: 50%" v-if="message.sender.avatar" :src="message.sender.avatar" width="50" height="50" alt="">
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <small class="left text-muted me-2">
                                        <span class="glyphicon glyphicon-time"></span>
                                        {{ message.created_at.created_at_human }}
                                    </small>
                                    <strong class="right primary-font">
                                        {{ message.sender.name }}
                                    </strong>
                                </div>
                                <p>

                                    {{ message.body }}
                                </p>
                            </div>
                        </li>
                        <li class="sender clearfix">
                            <span class="chat-img left clearfix mx-2"> </span>
                        </li>
                    </ul>
                </div>
                <div v-else style="min-height: 250px">
                    <p class="text-center">
                        Please select user to chat
                    </p>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input
                            v-model="body"
                            id="btn-input"
                            type="text"
                            class="form-control input-sm"
                            placeholder="Type your message here..."
                            @keypress.enter="sendMessage"
                        />
                        <p v-if="successMessage" class="alert alert-success">{{ successMessage }}</p>
                        <p v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</p>
                        <span class="input-group-btn">
                            <button
                                class="btn btn-primary"
                                @click.prevent="sendMessage"
                                :disabled="!body || !receiver_id"
                            >
                                Send
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Conversation",
    data() {
        return {
            users: [],
            messages: [],
            receiver_id: null,
            successMessage: '',
            errorMessage: '',
            body: null
        }
    },
    props: ['userId'],
    mounted() {
        axios.get('/internal-api/message/get-all-conversation')
            .then(res => {
                // console.log(res.data)
                this.users = res.data.data
            })

        Echo.private('App.Models.User.' + this.userId)
            .notification((notification) => {
                console.log(notification);
                this.messages.push(notification.message)
            });

    },
    methods: {
        async getMessages(e, userId) {
            this.getConsByUser(userId)
            // if (window.messageInterval) {
            //     console.log('clear')
            //     clearInterval(window.messageInterval)
            // }
            // if (window.countInterval) clearInterval(window.countInterval)
            //
            //  var selected_user_id = userId
            //  window.messageInterval = setInterval(() => {
            //      // console.log(selected_user_id)
            //     this.getConsByUser(selected_user_id)
            // }, 1000)
        },
        async getConsByUser(userId) {
            console.log(userId)
            const res = await axios.get(`/internal-api/message/get-all-conversation/${userId}`)
            this.messages = res.data.data
            this.receiver_id = userId
        },
        async sendMessage() {
            try {
                const res = await axios.post(`/internal-api/message/send`, {
                    user_id: this.userId,
                    receiver_id: this.receiver_id,
                    ad_id: this.messages[0].advertisement.id,
                    body: this.body
                })
                this.body = ''
                this.messages.push(res.data.data)
                this.successMessage = res.data.message
            } catch (ex) {
                this.errorMessage = ex.response.data.message
            }

        }
    }
};
</script>
<style>
.chat {
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li {
    margin-bottom: 40px;
    padding-bottom: 5px;
    margin-top: 10px;
    width: 80%;
    height: 10px;
}


.chat li .chat-body p {
    margin: 0;
}


.chat-msg {
    overflow-y: scroll;
    height: 350px;
}

.chat-msg .chat-img {
    width: 50px;
    height: 50px;
}

.chat-msg .img-circle {
    border-radius: 50%;
}

.chat-msg .chat-img {
    display: inline-block;
}

.chat-msg .chat-body {
    display: inline-block;
    max-width: 80%;
    background-color: #FFC195;
    border-radius: 12.5px;
    padding: 15px;
}

.chat-msg .chat-body2 {
    display: inline-block;
    max-width: 80%;
    background-color: #ccc;
    border-radius: 12.5px;
    padding: 15px;
}

.chat-msg .chat-body strong {
    color: #0169DA;
}

.chat-msg .buyer {
    text-align: right;
    float: right;
}

.chat-msg .buyer p {
    text-align: left;
}

.chat-msg .sender {
    text-align: left;
    float: left;
}

.chat-msg .left {
    float: left;
}

.chat-msg .right {
    float: right;
}

.clearfix {
    clear: both;
}

</style>
