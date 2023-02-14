<template>
    <div class="w-full">
        <div class="w-full text-xl font-bold text-gray-900 border-b-2 border-gray-200 mb-4">Manage Application Upload
            Requirements
        </div>
        <div class="w-full border-b-2 border-l-2 border-r-2 border-gray-200 rounded-3xl shadow-xl">
            <!-- Tabs -->
            <ul id="tabs" class="inline-flex pt-2 px-1 w-full border-b bg-gray-50">
                <li class="font-semibold cursor-pointer px-4 text-gray-800 font-semibold py-2 rounded-t"
                    @click="setTab('items')"
                    :class="`${tab==='items'? 'bg-white border-t border-r border-l -mb-px': ''}`">Define Items
                </li>
                <li class="font-semibold cursor-pointer px-4 text-gray-800 font-semibold py-2 rounded-t"
                    @click="setTab('assign')"
                    :class="`${tab==='assign'? 'bg-white border-t border-r border-l -mb-px': ''}`">Assign to Courses
                </li>
            </ul>

            <!-- Tab Contents -->
            <div id="tab-contents">
                <div id="items" class="p-4" v-show="tab==='items'">
                    <!-- Manage Documents / Items -->
                    <div class="w-full mt-1 p-3 bg-white ">
                        <table class="table-auto w-full">
                            <tr class="border-b-2 border-accent-600">
                                <th class="text-sm text-left text-gray-900 font-semibold pb-2">Title
                                </th>
                                <th class="text-sm text-left text-gray-900 font-semibold pb-2">Optional
                                </th>
                                <th class="text-sm text-left text-gray-900 font-semibold pb-2">In Use
                                </th>
                                <th class="text-sm text-left text-gray-900 font-semibold pb-2" colspan="2">Actions
                                </th>
                            </tr>

                            <tr v-if="requirements.length" v-for="requirement in requirements"
                                :class="`${requirement.id === editingRequirement.id? 'bg-accent-200': ''}`">
                                <td class="text-left text-gray-900 font-medium py-3 pl-3 cursor-pointer"
                                    @click="edit(requirement)">{{ requirement.text }}
                                </td>
                                <td class="text-left text-gray-900 font-medium py-3 pl-3 cursor-pointer">
                                    {{ requirement.is_optional === 1 ? 'Yes' : 'No' }}
                                </td>
                                <td class="text-sm text-left text-gray-900 font-medium py-3">
                                    {{ usage(requirement) === '' ? 'No' : 'Yes' }}
                                </td>
                                <td class="text-sm text-left text-gray-900 font-medium py-3" colspan="2">
                                    <button type="button"
                                            class="h-9 max-h-9 text-white md:ml-2 text-sm rounded bg-gray-400 py-2  hover:font-bold hover:bg-accent-600"
                                            style="width: 70px!important; min-width: 70px !important;"
                                            @click="edit(requirement)"
                                    >Edit
                                    </button>

                                    <button v-if="usage(requirement) === ''" type="button"
                                            class="h-9 max-h-9 text-white md:ml-2 text-sm rounded bg-gray-400 py-2  hover:font-bold hover:bg-accent-600"
                                            style="width: 70px!important; min-width: 70px !important;"
                                            @click="removeDocument(requirement)"
                                    >Delete
                                    </button>
                                </td>
                            </tr>

                            <tr v-else>
                                <td colspan="5" class="text-base text-left py-4">No documents found</td>
                            </tr>
                        </table>

                        <template v-if="editingRequirement.id !== 0">
                            <div class="text-base font-semibold text-gray-900 py-2 mt-10 border-t-2 border-accent-600">
                                Edit
                                Document <span class="font-bold italic">{{ editingRequirement.text }}</span>
                            </div>

                            <div class="md:hidden">
                                <div class="flex justify-start items-center">
                                    <div class="text-sm font-semibold text-gray-900 py-2">Title:</div>
                                    <div class="py-2 ml-4 mr-20">
                                        <input type="text" v-model="editingRequirement.text"
                                               class="w-[175px] md:w-[260px] h-8 bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none">
                                    </div>
                                </div>
                                <div class="flex justify-start items-center">
                                    <div class="text-sm font-semibold text-gray-900 py-2">Is Optional?:</div>
                                    <div class="py-2 ml-4 mr-20">
                                        <input type="checkbox" v-model="editingRequirement.is_optional" :true-value="1" :false-value="0"
                                               class="h-8 w-8 bg-gray-50 rounded text-accent-600 focus:bg-white focus:border-accent-600 focus:outline-none">
                                    </div>
                                </div>
                                <div class="text-sm font-semibold text-gray-900 py-2">Description:</div>
                                <div class="py-2">
                                    <textarea v-model="editingRequirement.description" rows="3" cols="30"
                                              class="w-full md:w-1/2 bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none">
                                    </textarea>
                                </div>
                                <div class="text-sm font-semibold text-gray-900 py-2">Usage:</div>
                                <div class="py-2 text-xs" v-html="usage(editingRequirement)">

                                </div>
                            </div>

                            <div class="hidden md:flex justify-between">
                                <div class="block w-5/12">
                                    <div class="flex justify-start items-center">
                                        <div class="text-sm font-semibold text-gray-900 py-2">Title:</div>
                                        <div class="py-2 ml-4 mr-20">
                                            <input type="text" v-model="editingRequirement.text"
                                                   class="w-[175px] md:w-[260px] h-8 bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none">
                                        </div>
                                    </div>
                                    <div class="flex justify-start items-center">
                                        <div class="text-sm font-semibold text-gray-900 py-2">Is Optional?:</div>
                                        <div class="py-2 ml-4 mr-20">
                                            <input type="checkbox" v-model="editingRequirement.is_optional" :true-value="1" :false-value="0"
                                                   class="h-8 w-8 bg-gray-50 rounded text-accent-600 focus:bg-white focus:border-accent-600 focus:outline-none">
                                        </div>
                                    </div>
                                    <div class="text-sm font-semibold text-gray-900 py-2">Description:</div>
                                    <div class="py-2">
                                    <textarea v-model="editingRequirement.description" rows="3" cols="30"
                                              class="w-full bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="block w-5/12">
                                    <div class="text-sm font-semibold text-gray-900 py-2">Usage:</div>
                                    <div class="py-2 text-xs" v-html="usage(editingRequirement)"></div>
                                </div>
                            </div>

                            <div class="flex justify-end py-2">

                                <button v-if="editedRequirementValid && busy===false" @click="updateDocument"
                                        class="inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400">
                                    Save your input
                                </button>

                                <button v-else disabled="disabled"
                                        class="inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-400 cursor-not-allowed">
                                    Save your input
                                </button>

                                <button
                                    class="ml-4 inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400"
                                    @click="cancel">
                                    Cancel
                                </button>
                            </div>
                        </template>

                        <template v-else>
                            <div class="text-base font-semibold text-gray-900 py-2 mt-10 border-t-2 border-accent-600">
                                Add a New Document
                            </div>

                            <div class="flex justify-between">
                                <div class="flex justify-start items-center">
                                    <div class="text-sm font-semibold text-gray-900 py-2">Title:</div>
                                    <div class="py-2 ml-4 mr-20">
                                        <input type="text" v-model="newRequirement.text"
                                               class="w-[175px] md:w-[260px] h-8 bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none">
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-start items-center">
                                <div class="text-sm font-semibold text-gray-900 py-2">Is Optional?:</div>
                                <div class="py-2 ml-4 mr-20">
                                    <input type="checkbox" v-model="newRequirement.is_optional" :true-value="1" :false-value="0"
                                           class="h-8 w-8 bg-gray-50 rounded text-accent-600 focus:bg-white focus:border-accent-600 focus:outline-none">
                                </div>
                            </div>
                            <div class="w-full md:w-5/12">
                                <div class="text-sm font-semibold text-gray-900 py-2">Description:</div>
                                <div class="py-2">
                                <textarea v-model="newRequirement.description" rows="3" cols="30"
                                          class="w-full md:w-1/2 bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none">
                                </textarea>
                                </div>
                            </div>

                            <div class="flex justify-end py-2">
                                <button v-if="newRequirementValid && busy===false" @click="addNewDocument"
                                        class="inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400">
                                    Save your input
                                </button>

                                <button v-else disabled="disabled"
                                        class="inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-400 cursor-not-allowed">
                                    Save your input
                                </button>

                                <button
                                    class="ml-4 inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400"
                                    @click="cancel">
                                    Cancel
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
                <div id="assign" class="p-4" v-show="tab==='assign'">
                    <!-- Assign Documents / Items -->
                    <div class="w-full mt-1 pl-0 md:pl-3 py-3 bg-white ">
                        <div class="md:flex justify-between">
                            <div class="text-base font-semibold text-gray-900 py-2">Course Group:</div>
                            <div class="py-2">
                                <select v-model="courseGroupSelected.course_group_id" @change="onSelectCourseGroup($event)"
                                        class="pl-0 md:pl-2 rounded text-left text-white text-xs md:text-base bg-accent-600 hover:bg-accent-400 overflow-x-scroll">
                                    <option v-for="courseGroup in courseGroups" :value="courseGroup.course_group_id">
                                        {{ courseGroup.course_title }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full text-base mt-2">
                            <ul class="list-disc ml-8">
                                <li>Select a course group</li>
                                <li>Drag items from the left column to the right column to assign them to the group</li>
                                <li>Remove items from assignment by dragging them in the opposite direction</li>
                                <li>Arrange the assigned items in the order they should be displayed to the student</li>
                                <li>Then click 'Save your selection'</li>
                            </ul>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-4 mt-4">
                            <div class="">
                                <span class="text-base font-semibold text-gray-900 py-2">Available</span>
                                <draggable
                                    class="border rounded border-accent-600 p-2 mt-2"
                                    style="min-height: 400px !important;"
                                    :list="availableRequirements"
                                    group="people"
                                    :disabled="draggingDisabled"
                                    itemKey="name"
                                >
                                    <template #item="{ element, index }">
                                        <div class="text-white bg-accent-600 rounded p-2 mb-2"
                                             :class="`${draggingDisabled? '' : 'cursor-grab'}`"
                                        >{{ element.text }}</div>
                                    </template>
                                </draggable>
                            </div>
                            <div class="h-96">
                                <span class="text-base font-semibold text-gray-900 py-2">Assigned</span>
                                <draggable
                                    class="border rounded border-accent-600 p-2 mt-2"
                                    style="min-height: 400px !important;"
                                    :list="assignedRequirements"
                                    group="people"
                                    itemKey="name"
                                >
                                    <template #item="{ element, index }">
                                        <div class="text-white bg-accent-600 rounded p-2 mb-2 cursor-grab">{{ element.text }}</div>
                                    </template>
                                </draggable>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end py-2">
                        <button v-if="assignmentValid && busy===false" @click="saveAssignment"
                                class="inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400">
                            Save your selection
                        </button>

                        <button v-else disabled="disabled"
                                class="inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-400 cursor-not-allowed">
                            Save your selection
                        </button>

                        <button
                            class="ml-4 inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400"
                            @click="cancelAssignment">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios';
import urlJoin from 'url-join';

// @see https://sortablejs.github.io/vue.draggable.next/#/two-lists
import draggable from 'vuedraggable';

export default {
    name: "ManageUploads",
    order: 1, // ?
    components: {
        draggable
    },
    props: {},
    data() {
        return {
            tab: 'items',
            busy: true,
            requirements: [],
            courseGroups: [],
            editingRequirement: {
                id: 0
            },
            newRequirement: {
                text: null,
                index: null,
                is_optional: 0,
                description: null
            },
            courseGroupSelected: {
                course_group_id: 0,
                course_title: 'Select ...'
            },
            availableRequirements: [],
            assignedRequirements: [],
            courseGroupId: 0
        }
    },
    computed: {
        newRequirementValid() {
            return this.newRequirement.text && this.newRequirement.text.length > 3
        },
        editedRequirementValid() {
            return this.editingRequirement.text && this.editingRequirement.text.length > 3
        },
        assignmentValid() {
            return this.assignedRequirements.length > 0
        },
        draggingDisabled() {
            return this.courseGroupSelected.course_group_id === 0
        }
    },
    created() {
        this.fetchRequirements();
        this.fetchCourseGroups();
    },
    methods: {
        setTab(tab) {
            if (tab === 'items') {
                this.fetchRequirements()
                this.tab = 'items'
            } else if(tab === 'assign') {
                this.fetchCourseGroups();
                this.courseGroupSelected.course_group_id = 0
                this.assignedRequirements = []
                this.tab = 'assign'
            }
        },
        fetchRequirements() {
            const url = urlJoin(process.env.MIX_APP_URL, `/requirements`);
            axios.get(url).then(response => {
                if (response.status === 200) {
                    this.requirements = response.data.data;
                    this.availableRequirements = JSON.parse(JSON.stringify(this.requirements));// clone
                    this.busy = false;
                } else {
                    console.log(response.status);
                }
            }).catch(error => {
                console.log(error);
            })
        },
        fetchCourseGroups() {
            const url = urlJoin(process.env.MIX_APP_URL, `/course-groups`);
            axios.get(url).then(response => {
                if (response.status === 200) {
                    this.courseGroups = response.data.data;
                    this.courseGroups.push({course_group_id: 0, course_title: 'Select ...'})
                    this.busy = false;
                } else {
                    console.log(response.status);
                }

            }).catch(error => {
                console.log(error);
            })
        },
        edit(requirement) {
            if (this.busy === false) {
                this.editingRequirement = requirement;
            }
        },
        cancel() {
            if (this.busy === false) {
                this.editingRequirement = {id: 0};
                this.newRequirement = {text: '', description: '', is_optional: 0}
            }
        },
        usage(requirement) {
            let str = "";
            let courseGroups = requirement.courseGroups;
            if (courseGroups) {
                for (let i = 0; i < courseGroups.length; i++) {
                    str = str.length ? str + ",<br>" + courseGroups[i].course_title : courseGroups[i].course_title;
                }
            }
            return str;
        },
        addNewDocument() {
            const url = urlJoin(process.env.MIX_APP_URL, `/requirements`);
            this.busy = true;
            axios.post(url, this.newRequirement).then(response => {
                if (response.status === 200) {
                    this.requirements = response.data.data;
                    this.availableRequirements = JSON.parse(JSON.stringify(this.requirements));// clone
                    this.busy = false;
                } else {
                    console.log(response.status);
                }
                this.cancel()
            }).catch(error => {
                console.log(error);
            })
        },
        updateDocument() {
            const url = urlJoin(process.env.MIX_APP_URL, `/requirement/${this.editingRequirement.id}`);
            this.busy = true;
            axios.post(url, this.editingRequirement).then(response => {
                if (response.status === 200) {
                    this.requirements = response.data.data;
                    this.availableRequirements = JSON.parse(JSON.stringify(this.requirements));// clone
                    this.busy = false;
                } else {
                    console.log(response.status);
                }
                this.cancel()
            }).catch(error => {
                console.log(error);
            })
        },
        removeDocument(requirement) {
            const url = urlJoin(process.env.MIX_APP_URL, `/requirement/${requirement.id}`);
            this.busy = true;
            axios.delete(url).then(response => {
                if (response.status === 200) {
                    this.requirements = response.data.data;
                    this.availableRequirements = JSON.parse(JSON.stringify(this.requirements));// clone
                    this.busy = false;
                } else {
                    console.log(response.status);
                }
                this.cancel()
            }).catch(error => {
                console.log(error);
            })
        },
        saveAssignment() {
            const url = urlJoin(process.env.MIX_APP_URL, `/requirements-of-course-group`);
            this.busy = true;
            let data = {
                requirementIds: this.assignedRequirements.map((requirement) => requirement.id),
                courseGroupId: this.courseGroupSelected.course_group_id
            };
            axios.post(url, data).then(response => {
                if (response.status !== 201) {
                    console.log(response.status);
                }
                this.busy = false;
            }).catch(error => {
                console.log(error);
            })
        },
        cancelAssignment() {
            this.courseGroupSelected.course_group_id = 0;
            this.availableRequirements = JSON.parse(JSON.stringify(this.requirements));// clone
            this.assignedRequirements = [];
        },
        // demo
        log: function (evt) {
            window.console.log(evt);
        },
        onSelectCourseGroup(event) {
            this.courseGroupSelected.course_group_id = event.target.value;
            const url = urlJoin(process.env.MIX_APP_URL, `/requirements-of-course-group/${this.courseGroupSelected.course_group_id}`);
            this.busy = true;
            axios.get(url).then(response => {
                if (response.status === 200) {
                    this.assignedRequirements = response.data.data;
                    let assignedRequirementIds = this.assignedRequirements.map((requirement) => requirement.id);
                    let allRequirements = JSON.parse(JSON.stringify(this.requirements));// clone
                    this.availableRequirements = allRequirements.filter((requirement) => !assignedRequirementIds.includes(requirement.id));
                    this.busy = false;
                } else {
                    console.log(response.status);
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
