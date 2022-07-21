<template>
  <div>
    <v-app dark>
        <v-bottom-nav
            absolute
            :value="true"
            :active.sync="activeTab"
            color="transparent"
        >
            <!-- customers -->
            
            <router-link
                to="/crm_customers"
                tag="v-btn"
            >
                <v-btn
                color="white"
                flat
                value="customers"
                >
                <span>customers</span>
            
                </v-btn>
            </router-link>

            <!-- deals -->
            <router-link
                to="/crm_deals"
                tag="v-btn"
            >
                <v-btn
                color="white"
                flat
                value="deals"
                >
                <span>deals</span>
            
                </v-btn>
            </router-link>
            

            <!-- analytics -->
            <router-link
                to="/crm_analytics"
                tag="v-btn"
            >
                <v-btn
                color="white"
                flat
                value="analytics"
                >
                <span>analytics</span>
            
                </v-btn>
            </router-link>
         </v-bottom-nav>
         <router-view></router-view>
        </v-app>
  </div>
 
</template>