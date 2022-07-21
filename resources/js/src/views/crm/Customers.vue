<template>
  <div>
<v-row>   
<v-col cols="12">
      <dashboard-datatable></dashboard-datatable>
    </v-col>
  </v-row>
  </div>
</template>

<script>
import DashboardDatatable from '../dashboard/DashboardDatatable.vue'
    export default {
        mounted() {
            console.log(' Welcome Component mounted.')
        },
        components: {
            
            DashboardDatatable,
        },
    }
</script>