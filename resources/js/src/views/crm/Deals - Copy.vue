<template> 
<div>
<!-- <button @click="getData"> test deals</button> -->
<!-- <button @click="test_notification"> test notification</button> -->
<tr v-for="user in users" :key="user.cst_id">
                        <td> Name : {{ user.cst_name }}</td>
                        <td>Email : {{ user.cst_email }}</td>
 </tr>

<!-- <p>{{users}}</p> -->

<notifications/>

</div>

</template>

<script>
import axios from "axios";
    export default {
    data() {
        return {
            name: 'AsmaaDeals',
            email: 'AsmaaDealstuesday',
            users:'',
        }
    },
    methods: {
        // getData() {
        //     axios.get('urihere', {
        //         params: {
        //             name: this.name,
        //             email: this.email
        //         }
        //     }).then((response) => {
        //         console.log(response.config.params);
        //         console.log(this.name);
        //         console.log(this.email);
        //     }).catch((error) => {
        //         console.log(error)
        //     })
        // },
        // test_notification (){
        //     this.$notify({
        //     title: 'Important message',
        //     text: 'Hello user!'
        //     });          
        //       },

        getUser(){
                axios.get('/list')
                     .then((response)=>{
                       this.users = response.data.users
                     })
            },
      
    },
    mounted() {
        // 
    },
    created() {
            this.getUser()
        },
}

</script>