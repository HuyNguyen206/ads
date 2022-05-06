<template>
    <div class="row">
        <div v-if="users" class="col-md-2">
            <p v-for="user in users" :key="user.id">
                <a href="" @click.prevent="getConsByUser(e, user.id)">{{ user.name }}</a>
            </p>

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">
                    <span>Chat </span>
                </div>
                <div
                    class="card-body chat-msg"

                >
                    <ul class="chat" v-for="(message, index) in messages" :key="message.id">

                        <li class="sender clearfix mt-5" style="margin-top: 63px !important;" v-if="userId == message.sender.id">
                            <span class="chat-img left clearfix mx-2">
                            img
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
                                <p v-if="message.link_ads">
                                    <a :href="message.link_ads" target="_blank"> {{ message.advertisement.name }}</a>
                                    <img :src="message.ad_feature_image" class="ms-2" v-if="message.ad_feature_image" width="60" height="50" alt="">
                                </p>
                                <p>
                                    {{ message.body }}
                                </p>
                            </div>
                        </li>
                        <li class="buyer clearfix  mt-5" v-else>
                            <span class="chat-img right clearfix  mx-2">
                                img
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
                <div class="card-footer">
                    <div class="input-group">
                        <input
                            v-model="body"
                            id="btn-input"
                            type="text"
                            class="form-control input-sm"
                            placeholder="Type your message here..."
                        />
                        <span class="input-group-btn">
                            <button
                                class="btn btn-primary"

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
            messages: []
        }
    },
    props: ['userId'],
    async mounted() {
        try {
            const res = await axios.get('/internal-api/message/get-all-conversation')
            // console.log(res.data)
            this.users = res.data.data
        } catch (ex) {

        }
    },
    methods: {
        async getConsByUser(e, userId) {
            const res = await axios.get(`/internal-api/message/get-all-conversation/${userId}`)
            this.messages = res.data.data
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
