<template>
    <div class="container">
        <h2>Edit Profile</h2>
        <div id="profile">
            <b-form @submit="onSubmit" v-if="show">
            <table>
                <tr>
                    <td style="width: 40%;">
                        <div id="left" style="margin-left: 0">
                            <b-card style="border: none;">
                                <b-card-body>
                                    <b-card-img src="https://picsum.photos/400/400/?image=20" start width="200px" height="200px"></b-card-img>
                                </b-card-body>
                                <b-card-footer style="border: 0; background: transparent">
                                    <b-form-file :file-name-formatter="formatNames" accept=".jpg, .png" :placeholder="pl"> </b-form-file>
                                </b-card-footer>
                            </b-card>
                        </div>
                    </td>
                    <td style="width: 60%;">
                        <div id="right">
                                <b-form-group id="input-group-1" label="Name:" label-for="input-1">
                                    <b-form-input
                                            id="input-1"
                                            v-model="form.firstname"
                                            required
                                            placeholder="Enter name"
                                            :invalid-feedback="invalidFeedback"
                                            :state = "state"
                                    ></b-form-input>
                                </b-form-group>
                                <b-form-group
                                        id="input-group-3"
                                        label="Email address:"
                                        label-for="input-3"
                                        description="We'll never share your email with anyone else."
                                >
                                    <b-form-input
                                            id="input-3"
                                            v-model="form.email"
                                            type="email"
                                            required
                                            placeholder="Enter email"
                                    ></b-form-input>
                                </b-form-group>
                        </div>
                    </td>
                </tr>
                <tr style="height: 25vw">
                    <td colspan="2">
                        <div id="center">
                            <b-form-group id="input-group-4" label="Password:" label-for="input-4">
                                <b-form-input
                                        id="input-4"
                                        type="password"
                                        v-model="form.password"
                                        :state="validation"
                                        aria-describedby="password-help-block"
                                        required
                                ></b-form-input>
                                <b-form-text id="password-help-block">
                                    Your password must be 6-20 characters long, only letters and numbers.
                                </b-form-text>
                            </b-form-group>
                            <b-form-group id="input-group-5" label="Confirm password:" label-for="input-5">
                                <b-form-input
                                        id="input-5"
                                        type="password"
                                        v-model="form.confirmpassword"
                                        :state="confPassValidation"
                                        required
                                ></b-form-input>
                            </b-form-group>
                            <b-form-group id="input-group-6" label="Membership:" label-for="input-6">
                                <b-form-select
                                        id="input-6"
                                        v-model="form.role"
                                        :options="roles"
                                        required
                                ></b-form-select>
                            </b-form-group>
                        </div>

                    </td>
                </tr>
                <tr style="height: 5vw">
                    <td colspan="2">
                        <b-button type="submit" variant="dark" style="width: 100%">Update profile</b-button>
                    </td>

                </tr>
            </table>
            </b-form>

        </div>
    </div>

</template>

<script>
    export default {
        computed: {
            state() {
                return this.form.firstname.length >= 2;
            },
            invalidFeedback() {
                if (this.form.firstname.length > 2) {
                    return '';
                } else if (this.form.firstname.length > 0) {
                    return 'Enter at least 2 characters';
                } else {
                    return 'Please enter something';
                }
            },
            validation() {
                return this.form.password.length > 5 && this.form.password.length <= 20 && this.isNumberOr_Letter(this.form.password);
            },
            confPassValidation() {
                return this.form.confirmpassword.length > 5 && this.form.confirmpassword.length <= 20 && this.form.password === this.form.confirmpassword;
            },

        },
        data() {
            return {
                form: {
                    email: '',
                    firstname: '',
                    lastname: '',
                    password: '',
                    confirmpassword: '',
                    role: null,
                },
                roles: [{text: 'Select One', value: null}, {text: 'Normal', value: 'normal'}, {text: 'VIP', value: 'vip'}],
                show: true,
                pl: 'Change profile image',
            }
        },

        created() {
            this.getUserInfo();
        },
        mounted: function () {

        },
        methods: {
            getUserInfo(){
                this.form.email = document.getElementById('searchTag').dataset.user_email;
                this.form.firstname = document.getElementById('searchTag').dataset.user_name;
                this.form.password = document.getElementById('searchTag').dataset.user_password;
                this.form.role = document.getElementById('searchTag').dataset.user_role;
            },
            formatNames(files) {
                if (files.length === 1) {
                    return files[0].name;
                } else {
                    return 'Only one file';
                }
            },
            onSubmit(evt) {
                evt.preventDefault();
                alert(JSON.stringify(this.form));
            },

            isNumberOr_Letter(s){
                var regu = "^[0-9a-zA-Z]{5,20}$";
                var re = new RegExp(regu);
                return re.test(s);

            },


        }
    };
</script>

<style scoped>
    .container {
        width: 70%;
    }

    #profile {
        margin-top: 1vw;
    }
    tr{
        width: 100%;
    }
</style>
