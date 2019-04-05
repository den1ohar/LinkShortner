<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Type your url</div>
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <input type="url" class="form-control" v-model="url" id="url" required/>
                        </div>
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </form>
                    <div class="card-body">
                        {{ short_link }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: '',
                errors: {},
                short_link: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            submit() {
                axios.post('/', {url: this.url}).then(response => {
                    this.short_link = window.location.href  + response.data.short_code;
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        }
    }
</script>
