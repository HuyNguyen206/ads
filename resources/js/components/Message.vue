<template>
    <div class="mt-1">
        <!-- Button trigger modal -->
        <a v-if="successMessage" href="/message" class="btn btn-primary">
            <i class="fa-solid fa-paper-plane me-1"></i> View conversation
        </a>
        <button v-else type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-message"></i> Send message
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send message to {{seller.name}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <textarea v-model="body" class="form-control" name="" id="" cols="30" rows="5" placeholder="Please write your message">

                    </textarea>
                        <p v-if="successMessage" class="alert alert-success">{{successMessage}}</p>
                        <p v-if="errorMessage" class="alert alert-danger">{{errorMessage}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click.prevent="sendMessage" :disabled="!body">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Message",
    props:['seller', 'sender_id', 'ad_id'],
    data(){
        return {
            body:'',
            successMessage: '',
            errorMessage: '',
        }
    },
    methods:{
        async sendMessage(){
            try {
                const res = await axios.post(`/internal-api/message/send`, {
                    user_id: this.sender_id,
                    receiver_id: this.seller.id,
                    ad_id: this.ad_id,
                    body: this.body
                })
                this.body=''
                this.successMessage = res.data.message
            }catch (ex) {
                this.errorMessage = ex.response.data.message
            }

        }
    }
}
</script>

<style scoped>

</style>
