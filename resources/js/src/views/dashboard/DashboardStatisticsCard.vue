<template>
  <v-card>
    <v-card-title class="align-start">
      <span class="font-weight-semibold">Total Customers and Sales</span>
      <v-spacer></v-spacer>
      <v-btn
        icon
        small
        class="me-n3 mt-n2"
      >
        <v-icon>
          {{ icons.mdiDotsVertical }}
        </v-icon>
      </v-btn>
    </v-card-title>

    <v-card-subtitle class="mb-8 mt-n5">
      <span class="font-weight-semibold text--primary me-1 hide_v">Total {{per_count}} Growth </span>
      <!-- <span>😎 this month</span> -->
    </v-card-subtitle>

    <v-card-text>
      <v-row>
        <v-col
          v-for="data in statisticsData"
          :key="data.title"
          cols="6"
          md="3"
          class="d-flex align-center"
        >
          <v-avatar
            size="44"
            :color="resolveStatisticsIconVariation (data.title).color"
            rounded
            class="elevation-1"
          >
            <v-icon
              dark
              color="white"
              size="30"
            >
              {{ resolveStatisticsIconVariation (data.title).icon }}
            </v-icon>
          </v-avatar>
          <div class="ms-3">
            <p class="text-xs mb-0">
              {{ data.title }}
            </p>
            <h3 class="text-xl font-weight-semibold">
              {{ data.total }}
            </h3>
          </div>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import axios from "axios";
// eslint-disable-next-line object-curly-newline
import { mdiAccountOutline, mdiCurrencyUsd, mdiTrendingUp, mdiDotsVertical, mdiLabelOutline } from '@mdi/js'

export default {
  setup() {
    const statisticsData = [
      
    ]

    const resolveStatisticsIconVariation = data => {
      if (data === 'Sales') return { icon: mdiTrendingUp, color: 'primary' }
      if (data === 'Customers') return { icon: mdiAccountOutline, color: 'success' }
      if (data === 'Product') return { icon: mdiLabelOutline, color: 'warning' }
      if (data === 'Revenue') return { icon: mdiCurrencyUsd, color: 'info' }

      return { icon: mdiAccountOutline, color: 'success' }
    }

    return {
      statisticsData,
      resolveStatisticsIconVariation,
      cst_count:'',
      per_count:'',
      count_cst_deal:[],

      // icons
      icons: {
        mdiDotsVertical,
        mdiTrendingUp,
        mdiAccountOutline,
        mdiLabelOutline,
        mdiCurrencyUsd,
      },
    }
  },
  // created  start
    created () {
      this.initialize()
    },
  // created  end
 
  // methods  start
    methods: {
      initialize () {
                axios.get('/cstDeal')
                    .then((response)=>{
                       this.cst_count = response.data.deal_new_count
                       this.count_cst_deal = response.data.cst_deal_count
                       this.per_count = response.data.deal_new_count + "%"

                          this.statisticsData.push ( 
                              {
                                title: 'Sales',
                                total: response.data.cst_deal_count['Sales']
                              } ,
                              {
                                title: 'Customers',
                                total: response.data.cst_deal_count['Customers']
                              } ,
                                             )
                                             
                           
                                      });

                
          },
    },
    // methods  end
}
</script>

<style scoped>
.hide_v{
  visibility:hidden!important;
}
</style>
