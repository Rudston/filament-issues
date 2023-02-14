<template>
    <div class="w-full text-xl font-bold text-gray-900 border-b-2 border-gray-200 mb-6">Admin Actions
    </div>
    <review-admin-actions :busy="busy" :status="status" :checked="checked===1" :id-checked="idChecked===1" :contractSent="contractSent" @entryAdded="onEntryAdded" @sendContract="onSendContract"></review-admin-actions>

    <div class="w-full text-xl font-bold text-gray-900 border-b-2 border-gray-200 mb-4">Admin History
    </div>
    <div class="w-full text-center h-10" v-if="loading || busy" style="background-color: rgba(255, 255, 255, .8);
            background-image: url('https://i.stack.imgur.com/FhHRx.gif');
            background-position: center center;
            background-repeat: no-repeat;">
    </div>
    <div class="" v-else >
        <div v-if="entries.length">
            <div class="w-full">
                <template v-for="(entry, index) in entries">
                    <review-entry @entryDeleted="onEntryDeleted" :admin-user-id=adminUserId :entry=entry :last="index+1 === entries.length"></review-entry>
                </template>
            </div>
        </div>
        <div v-else class="w-full">No entries yet</div>
    </div>

</template>

<script>

// @see https://github.com/vuejs/core/tree/main/packages/vue#bundler-build-feature-flags
import ReviewEntry from "./ReviewEntry";
import ReviewAdminActions from "./ReviewAdminActions";
import axios from 'axios';
import urlJoin from 'url-join';

export default {
    name: "ReviewHistory",
    props: {
        initialApplicationData: {
            type: Object,
            required: true
        },
        adminUserId: {
            type: Number,
            required: true
        },
        adminName: {
            type: String,
            required: true
        }
    },
    components: {
        ReviewEntry,
        ReviewAdminActions
    },
    data() {
        return {
            loading: true, // fetching entries
            busy: false, // saving admin changes
            entries: [],
            status: this.initialApplicationData.status,
            checked: this.initialApplicationData.checked,
            idChecked: this.initialApplicationData.idChecked,
            appUrl: process.env.MIX_APP_URL,
            contractSent: this.initialApplicationData.contractSent
        }
    },
    created() {
        this.fetchReviewEntries();
    },
    methods: {
        fetchReviewEntries() {
            const url = urlJoin(process.env.MIX_APP_URL, `/review-entries/${this.initialApplicationData.id}`);
            axios.get(url).then(response => {
                if (response.status === 200) {
                    this.entries = response.data.data;
                    //console.log(this.entries)
                    this.loading = false;
                } else {
                    console.log(response.status);
                }
            }).catch(error => {
                console.log(error);
            })
        },
        onEntryAdded(data) {
            this.busy = true;
            const url = urlJoin(process.env.MIX_APP_URL, '/review-entries');
            data.student_applications_id = this.initialApplicationData.id;
            data.admin_user_id = this.adminUserId;
            data.admin_name = this.adminName;
            axios.post(url, data).then(response => {
                if (response.status === 200) {
                    this.entries = response.data.data;
                    this.initialApplicationData.checked = response.data.data[0].checked;
                    this.initialApplicationData.idChecked = response.data.data[0].id_checked;
                    this.initialApplicationData.status = response.data.data[0].status;
                    this.initialApplicationData.statusText = response.data.data[0].status_text;
                    this.emitter.emit("update-data", this.initialApplicationData);
                    this.busy = false;
                } else {
                    console.log(response.status);
                }
            }).catch(error => {
                console.log(error);
            })
        },
        onEntryDeleted(data) {
            // this.loading = true;
            this.busy = true;
            const url = urlJoin(process.env.MIX_APP_URL, `/review-entries/${data}`);
            axios.delete(url).then(response => {
                if (response.status === 204) {
                    this.fetchReviewEntries();
                    this.busy = false;
                } else {
                    console.log(response.status);
                }
            }).catch(error => {
                console.log(error);
            })
        },
        onSendContract() {
            this.busy = true;
            const urlPandaDoc = urlJoin(process.env.MIX_APP_URL, `/pandadoc-service/generate/${this.initialApplicationData.id}/${this.adminUserId}`);
            axios.get(urlPandaDoc).then(response => {
                if (response.status === 201) {
                    this.emitter.emit("update-contract-data", response.data.data);
                    this.contractSent = true;
                    // also add review entry
                    let entry = {
                        action: 'contract_sent'
                    }
                    const urlReviewEntries = urlJoin(process.env.MIX_APP_URL, '/review-entries');
                    entry.student_applications_id = this.initialApplicationData.id;
                    entry.admin_user_id = this.adminUserId;
                    entry.admin_name = this.adminName;
                    axios.post(urlReviewEntries, entry).then(response => {
                        if (response.status === 200) {
                            this.entries = response.data.data;
                            this.initialApplicationData.checked = response.data.data[0].checked;
                            this.initialApplicationData.status = response.data.data[0].status;
                        } else {
                            console.log(response.status);
                        }
                    }).catch(error => {
                        console.log(error);
                    })
                    this.busy = false;
                } else {
                    console.log('error occurred: status should be 201 but is = ', response.status);
                }
            }).catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>

</style>
