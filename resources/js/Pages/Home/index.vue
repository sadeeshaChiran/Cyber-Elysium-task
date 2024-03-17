<template>
    <div>
        <AppLayout>
            <template #header>
                <div class="mt-5 col-9 offset-3 ">
                    <button class="mt-2 mb-5 col-9 btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addModal">ADD</button>

                    <!-- Student Cards -->
                    <div class="row">
                        <div v-for="student in student_list" :key="student.key" class="m-1 mt-3 col-3 card">
                            <img :src="student.image" class="h-64 card-img-top" alt="error" />
                            <div class="text-center card-body">
                                <span class="mt-2 card-text fs-3 text-info">{{ student.name }}</span><br />
                                <span class="mt-2 card-text fs-3 text-success">{{ student.age }}</span><br />
                                <span class="mt-2 card-text fs-3">{{ student.status }}</span>

                                <!-- Change Status Link -->
                                <button @click.prevent="statusTask(student.id)"
                                    class="mt-2 col-12 btn btn-outline-danger"> Status Change</button>

                                <!-- Edit Button -->
                                <button @click.prevent="editTask(student)" data-bs-toggle="modal"
                                    data-bs-target="#editData" class="mt-2 col-12 btn btn-outline-primary">Edit</button>

                                <!-- Delete Link -->
                                <button @click.prevent="deleteTask(student.id)"
                                    class="mt-2 col-12 btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>

                    <!-- Add Modal -->
                    <div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
                        <div className="modal-dialog">
                            <div className="modal-content">
                                <div className="modal-header">
                                    <h1 className="modal-title fs-5" id="addModalLabel">Modal title</h1>
                                    <button onClick={handleReset} type="button" className="btn-close"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div className="modal-body">
                                    <form @submit.prevent="addStudent" enctype="multipart/form-data">

                                        <div className="mb-3">
                                            <label htmlFor="name" className="form-label">Name</label>
                                            <input v-model="student_form.name" id='name' name='name' type="text"
                                                className="form-control" aria-describedby="emailHelp" required />
                                        </div>
                                        <div className="mb-3">
                                            <label htmlFor="age" className="form-label">Age</label>
                                            <input v-model="student_form.age" id='age' name='age' type="number"
                                                className="form-control" required />
                                        </div>

                                        <div className='mb-3'>
                                            <label htmlFor="image" className="form-label">Image</label>
                                            <input id="image" name="image" type="file" @change="handleImageChange"
                                                accept="image/*" required />
                                        </div>
                                        <button data-bs-dismiss="modal" type="submit" className="mt-4 btn btn-primary col-12 d-grid">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                                <div className="modal-footer">
                                    <button type="button" className="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Edit Modal -->
                    <div className="modal fade " id="editData" tabIndex={-1} aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div className="modal-dialog">
                            <div className="modal-content">
                                <div className="modal-header">
                                    <h1 className="modal-title fs-5" id="editModalLabel">Edit</h1>
                                    <button onClick={handleReset} type="button" className="btn-close"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div className="modal-body">
                                    <form @submit.prevent="editStudent" enctype="multipart/form-data">

                                        <div className="mb-3">
                                            <label htmlFor="name" className="form-label">Name</label>
                                            <input v-model="student_update_form.name" id='name' name='name' type="text"
                                                className="form-control" aria-describedby="emailHelp" required />
                                        </div>
                                        <div className="mb-3">
                                            <label htmlFor="age" className="form-label">Age</label>
                                            <input v-model="student_update_form.age" id='age' name='age' type="number"
                                                className="form-control" required />
                                        </div>
                                        
                                        <div className='mb-3'>
                                            <label htmlFor="image" className="form-label">Image</label>
                                            <img :src="student_update_form.image" class="h-64 card-img-top" alt="error" />
                                            <input id="image" name="image" type="file" @change="handleEditImageChange"
                                                accept="image/*"  />
                                        </div>
                                        <button data-bs-dismiss="modal" type="submit" className="mt-4 btn btn-primary col-12 d-grid">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                                <div className="modal-footer">
                                    <button type="button" className="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </template>
        </AppLayout>


    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';



export default {
    components: {
        AppLayout
    },
    props: {
        students: Array
    },

    data() {
        return {
            student_form: {
                name: '',
                image: '',
                age: '',
            },
            student_update_form: {
                id: '',         
                name: '',
                image: '',
                age: '',
            },
            student_list: []
        };
    },
    beforeMount() {
        this.getStudentList();
    },
    methods: {
        async getStudentList() {
            const students = (await (axios.get(`/list`))).data;
            this.student_list = students;
            console.log(this.student_list)

        },
        async addStudent() {
               
            await axios.post('/add', this.student_form, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            this.getStudentList();
            
            // Clear form
            this.student_form.name = '';
            this.student_form.image = '';
            this.student_form.age = '';

            // Close modal 
             $('#addModal').modal('hide');
           
        },
        async deleteTask(id) {
            await (axios.get(`/delete/${id}`));
            this.getStudentList();
        },
        async statusTask(id) {
            await (axios.get(`/status/${id}`));
            this.getStudentList();
        },
        async editTask(student) {
            this.student_update_form = student;
        },

        async editStudent() {

            
            await axios.post('/update', this.student_update_form, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            this.getStudentList();
            
            // Clear form
            this.student_update_form.name = '';
            this.student_update_form.image = '';
            this.student_update_form.age = '';

            // Close modal 
            $('#editData').modal('hide');
           
        },

        
        handleImageChange(event) {
            this.student_form.image = event.target.files[0];
        },

        handleEditImageChange(event) {
            this.student_update_form.image = event.target.files[0];
        },

        

    }


}
</script>

<style lang="scss" scoped></style>