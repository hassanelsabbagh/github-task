<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Github Task</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Repo</th>
                                <th>Date</th>
                                <th>Points</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="event in events" :key="event.id">
                                <td>{{event.type}}</td>
                                <td>{{event.repository}}</td>
                                <td>{{event.date}}</td>
                                <td>{{event.points}}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>{{score}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                events: null,
                score: null
            };
        },
        created() {
            this.axios
            .get(`http://localhost/github-task/public/api/${this.$route.params.name}`)
            .then((res) => {
                this.events = res.data.data;
                this.score = res.data.score;
                console.log(res.data);
            }, (error) =>{
                console.log(error);
        });
    }
    }
</script>
