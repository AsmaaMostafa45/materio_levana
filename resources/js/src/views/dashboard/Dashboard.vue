<template>
  <v-row>
    <!-- <v-col
      cols="12"
      md="4"
    >
      <dashboard-congratulation-john></dashboard-congratulation-john>
    </v-col> -->
    <v-col
      cols="12"
      md="6"
    >
      <dashboard-statistics-card></dashboard-statistics-card>
    </v-col>
     <v-col
      cols="12"
      md="6"
    >
      <v-row class="match-height">
        <v-col
          cols="12"
          sm="4"
        >
          <statistics-card-vertical
            :change="this.new_change"
            :color="newDeal.color"
            :icon="newDeal.icon"
            :statistics="this.new_stat"
            :stat-title="newDeal.statTitle"
            :subtitle="newDeal.subtitle"
          ></statistics-card-vertical>
        </v-col>
        <v-col
          cols="12"
          sm="4"
        >
          <statistics-card-vertical
            :change="this.progress_change"
            :color="inProgress.color"
            :icon="inProgress.icon"
            :statistics="progress_stat"
            :stat-title="inProgress.statTitle"
            :subtitle="inProgress.subtitle"
          ></statistics-card-vertical>
        </v-col>
        <v-col
          cols="12"
          sm="4"
        >
          <statistics-card-vertical
            :change="this.final_change"
            :color="final.color"
            :icon="final.icon"
            :statistics="final_stat"
            :stat-title="final.statTitle"
            :subtitle="final.subtitle"
          ></statistics-card-vertical>
        </v-col>
      </v-row>
    </v-col>


    <v-col
      cols="12"
      sm="6"
      md="4"
    >
      <dashboard-weekly-overview></dashboard-weekly-overview>
    </v-col>

    <v-col
      cols="12"
      md="4"
      sm="6"
    >
      <dashboard-card-total-earning></dashboard-card-total-earning>
    </v-col>

    <!-- <v-col
      cols="12"
      md="4"
    >
      <v-row class="match-height">
        <v-col
          cols="12"
          sm="6"
        >
          <statistics-card-vertical
            :change="newDeal.change"
            :color="newDeal.color"
            :icon="newDeal.icon"
            :statistics="newDeal.statistics"
            :stat-title="newDeal.statTitle"
            :subtitle="newDeal.subtitle"
          ></statistics-card-vertical>
        </v-col>
        <v-col
          cols="12"
          sm="6"
        >
          <statistics-card-vertical
            :change="inProgress.change"
            :color="inProgress.color"
            :icon="inProgress.icon"
            :statistics="inProgress.statistics"
            :stat-title="inProgress.statTitle"
            :subtitle="inProgress.subtitle"
          ></statistics-card-vertical>
        </v-col>
        <v-col
          cols="12"
          sm="6"
        >
          <statistics-card-vertical
            :change="final.change"
            :color="final.color"
            :icon="final.icon"
            :statistics="final.statistics"
            :stat-title="final.statTitle"
            :subtitle="final.subtitle"
          ></statistics-card-vertical>
        </v-col>

        <v-col
          cols="12"
          sm="6"
        >
          <statistics-card-vertical
            :change="salesQueries.change"
            :color="salesQueries.color"
            :icon="salesQueries.icon"
            :statistics="salesQueries.statistics"
            :stat-title="salesQueries.statTitle"
            :subtitle="salesQueries.subtitle"
          ></statistics-card-vertical>
        </v-col>
      </v-row>
    </v-col> -->

    <v-col
      cols="12"
      md="4"
    >
      <dashboard-card-sales-by-countries></dashboard-card-sales-by-countries>
    </v-col>
    <!-- <v-col
      cols="12"
      md="8"
    >
      <dashboard-card-deposit-and-withdraw></dashboard-card-deposit-and-withdraw>
    </v-col> -->
    <v-col cols="12">
      <dashboard-datatable></dashboard-datatable>
    </v-col>
  </v-row>
</template>

<script>
import axios from "axios";
// eslint-disable-next-line object-curly-newline
import { mdiPoll, mdiLabelVariantOutline, mdiCurrencyUsd, mdiHelpCircleOutline } from '@mdi/js'
import StatisticsCardVertical from '@/components/statistics-card/StatisticsCardVertical.vue'

// demos
import DashboardCongratulationJohn from './DashboardCongratulationJohn.vue'
import DashboardStatisticsCard from './DashboardStatisticsCard.vue'
import DashboardCardTotalEarning from './DashboardCardTotalEarning.vue'
import DashboardCardDepositAndWithdraw from './DashboardCardDepositAndWithdraw.vue'
import DashboardCardSalesByCountries from './DashboardCardSalesByCountries.vue'
import DashboardWeeklyOverview from './DashboardWeeklyOverview.vue'
import DashboardDatatable from './DashboardDatatable.vue'

export default {
  components: {
    StatisticsCardVertical,
    DashboardCongratulationJohn,
    DashboardStatisticsCard,
    DashboardCardTotalEarning,
    DashboardCardDepositAndWithdraw,
    DashboardCardSalesByCountries,
    DashboardWeeklyOverview,
    DashboardDatatable,
  },
  setup() {
    let new_stat = ''
    let progress_stat = ''
    let final_stat = ''
    let new_change = ''
    let progress_change = ''
    let final_change = ''
    const newDeal = {
      statTitle: 'New Deal',
      icon: mdiPoll,
      color: 'success',
      subtitle: '',
      statistics:new_stat,
      change: new_change,
    }

    const inProgress = {
      statTitle: 'In Progress',
      icon: mdiCurrencyUsd,
      color: 'secondary',
      subtitle: '',
      statistics: progress_stat,
      change: progress_change,
    }

    // vertical card options
    const final = {
       statTitle: 'Final',
        icon: mdiLabelVariantOutline,
        color: 'primary',
        subtitle: '',
        statistics: final_stat,
        change: final_change,
    }

    const salesQueries = {
      statTitle: 'Sales Quries',
      icon: mdiHelpCircleOutline,
      color: 'warning',
      subtitle: 'Last week',
      statistics: '15',
      change: '-18%',
    }

    return {
      newDeal,
      inProgress,
      final,
      salesQueries,
      new_stat:new_stat,
      progress_stat:progress_stat,
      final_stat:final_stat,
      new_change:new_change,
      progress_change:progress_change,
      final_change:final_change,
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
                var self = this;
                axios.get('/cstDeal')
                    .then((response)=>{
                      self.new_stat = JSON.stringify(response.data.deal_new_count)
                      self.progress_stat = JSON.stringify(response.data.deal_in_progress_count)
                      self.final_stat = JSON.stringify(response.data.deal_final_count)
                       
                      self.new_change = ( JSON.stringify (Math.round((response.data.deal_new_count /response.data.count_deal) * 100))) + "%"
                      self.progress_change = ( JSON.stringify (Math.round((response.data.deal_in_progress_count /response.data.count_deal) * 100))) + "%"
                      self.final_change = ( JSON.stringify (Math.round((response.data.deal_final_count /response.data.count_deal) * 100))) + "%"

              
                           
                                      });

                
          },
    },
    // methods  end

}
</script>

<style scoped>
.v-btn--icon.v-size--small .v-icon, .v-btn--fab.v-size--small .v-icon {
    height: 24px;
    font-size: 24px;
    width: 24px;
    visibility: hidden!important;
    display:none!important;
}
</style>
