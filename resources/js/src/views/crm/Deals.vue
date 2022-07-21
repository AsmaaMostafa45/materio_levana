<template> 
    <div id="app">
        <v-app id="inspire">
            <v-card>
            <v-toolbar
                flat
               
            >
                <v-toolbar-title>Deals</v-toolbar-title>
                <v-spacer></v-spacer>
             <!-- new Deal start  -->
                <v-dialog
                v-model="dialog"
                max-width="850px"
                persistent
                >

                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="attrs"
                    v-on="on"
                    >
                    New 
                    </v-btn>
                </template>
                <v-card>
                    <v-toolbar
                    dark
                    color="primary"
                    > 
                    <v-toolbar-title>New Deal</v-toolbar-title>
                    <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                    <v-form @submit.prevent="submit"
                    ref="form"
                    v-model="valid"
                    lazy-validation>
                        <!-- <v-subheader>Name</v-subheader> -->
                        <br>
                        <v-text-field
                            v-model="editedItem.name"
                            label="Name" 
                            outlined
                            shaped
                        ></v-text-field>
                        <br>
                        <v-select
                            v-model="editedItem.status"
                            :items="statusitems_deals"
                            :rules="statusRules"
                            item-text="locale.en.title"
                            item-value="id"
                            label="Status *"
                            data-vv-name="status"
                            outlined
                            shaped
                        >
                        <template v-slot:append>
                        <v-icon class="red_color">*</v-icon>
                        </template> 
                        </v-select>
                        <br> 
                        <v-text-field
                            v-model="editedItem.amount"
                            label="Amount"
                            outlined
                            shaped
                        >
                        </v-text-field>
                        <br>
                        <v-text-field
                            v-model="editedItem.currency"
                            label="Currency" 
                            outlined
                            shaped
                        >
                        </v-text-field>
                        <br>
                        <v-text-field
                            v-model="editedItem.date"
                            type="Date"
                            outlined
                            shaped
                        ></v-text-field>
                        <br>
                        <v-select
                            v-model="editedItem.contact"
                            :items="contact_deals"
                            :rules="contactRules"
                            item-text="locale.en.title"
                            item-value="id"
                            label="Contact *"
                            data-vv-name="status"
                            outlined
                            shaped
                        >
                        <template v-slot:append>
                        <v-icon class="red_color">*</v-icon>
                        </template>
                        </v-select>
                        <br>
                        <v-select
                            v-model="editedItem.source"
                            :items="source_deals"
                            item-text="locale.en.title"
                            item-value="id"
                            label="Source"
                            data-vv-name="status"
                            outlined
                            shaped
                        ></v-select>
                        <br>
                        <v-textarea
                        v-model="editedItem.source_info_notes"         
                        label="Source Information & Notes"
                        rows="4"
                        row-height="30"
                        outlined
                        shaped
                        ></v-textarea>
                        <v-icon class="red_color">*</v-icon> Required
                    </v-form>
                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="error"
                        @click="close"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        color="primary"
                        class="mr-4"
                        @click="save"
                    >
                        Save
                    </v-btn>
                    </v-card-actions>
                </v-card> 
        </v-dialog>
        </v-toolbar>
        <v-divider></v-divider>
        <!-- new Deal end  -->
        <!-- view Deal start  -->
        <v-dialog
        v-model="dialogview"
        hide-overlay
        max-width="850px"
        persistent
        >
          <v-card>
            <v-toolbar
              dark
              color="primary"
            >
              <v-btn
                icon
                dark
                @click="dialogview = false"
              >
                <v-icon
                small
                >
                {{icons.mdiCloseThick}}
                </v-icon>
              </v-btn>
              <v-toolbar-title>{{list_deal_view.deal_name}} details </v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-list
              three-line
              subheader
            >
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Name</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_name}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Status</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_status}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Amount</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_amount}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Currency</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_currency}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Date</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_date}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Contact</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_contact}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Source</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_source}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Source Information & Notes</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_info_notes}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item> 
            </v-list>
          </v-card>
        </v-dialog>
        <!-- view Deal end  -->
            <v-tabs  vertical>
                <v-tab  class="indigo3">
                    New
                </v-tab>
                <v-icon
                >
                    {{icons.mdiArrowDownThick}}
                    
                </v-icon>
                <!-- <v-icon
                >
                    {{icons.mdiArrowBottomLeftThick}}   
                    
                </v-icon> -->
                <v-tab  class="indigo3">
                    In progress
                </v-tab>
                <!-- <v-icon
                >
                    {{icons.mdiArrowDownBoldOutline}}
                </v-icon> -->
                <v-icon
                >
                    {{icons.mdiArrowDownThick}}
                    
                </v-icon>
                <v-tab  class="indigo3">
                    Final
                </v-tab>
                <v-tab-item>
                    <v-timeline
                         align-top
                        :dense="$vuetify.breakpoint.smAndDown" 
                        >
                        <v-timeline-item
                            fill-dot
                            color="indigo3"
                            v-for="item in list_deal_new" :key="item.deal_id"
                        >
                            <v-card
                            color="indigo3"
                            dark
                            class="justify-center"
                            >
                            <v-card-title class="text-h6" >
                                 {{item.deal_name}} 
                            </v-card-title>
                            <v-card-text class="white text--primary">
                                <h3>
                                   Contact :  {{item.deal_contact}}
                                </h3>
                                <p >
                                   Date : {{item.deal_date}}
                                </p>
                                <h3>
                                   Amount : {{item.deal_amount}} {{item.deal_currency}}
                                </h3>
                            </v-card-text>
                            
                            <v-card-actions class="d-flex justify-center">
                                <v-btn  color="primary" 
                                @click="viewItem(item.deal_id)">
                                 View Details
                                 </v-btn>
                            </v-card-actions>
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>
                </v-tab-item>
                <v-tab-item>
                    <v-timeline
                         align-top
                        :dense="$vuetify.breakpoint.smAndDown" 
                        >
                        <v-timeline-item
                            fill-dot
                            color="indigo3"
                            v-for="item in list_deal_in_progress" :key="item.deal_id"
                        >
                            <v-card
                            color="indigo3"
                            dark
                            class="justify-center"
                            >
                            <v-card-title class="text-h6" >
                                 {{item.deal_name}} 
                            </v-card-title>
                            <v-card-text class="white text--primary">
                                <h3>
                                   Contact :  {{item.deal_contact}}
                                </h3>
                                <p >
                                   Date : {{item.deal_date}}
                                </p>
                                <h3>
                                   Amount : {{item.deal_amount}} {{item.deal_currency}}
                                </h3>
                            </v-card-text>
                            
                            <v-card-actions class="d-flex justify-center">
                                <v-btn  color="primary" 
                                @click="viewItem(item.deal_id)">
                                 View Details
                                 </v-btn>
                            </v-card-actions>
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>
                </v-tab-item>
                <v-tab-item>
                    <v-timeline
                         align-top
                        :dense="$vuetify.breakpoint.smAndDown" 
                        >
                        <v-timeline-item
                            fill-dot
                            color="indigo3"
                            v-for="item in list_deal_final" :key="item.deal_id"
                        >
                            <v-card
                            color="indigo3"
                            dark
                            class="justify-center"
                            >
                            <v-card-title class="text-h6" >
                                 {{item.deal_name}} 
                            </v-card-title>
                            <v-card-text class="white text--primary">
                                <h3>
                                   Contact :  {{item.deal_contact}}
                                </h3>
                                <p >
                                   Date : {{item.deal_date}}
                                </p>
                                <h3>
                                   Amount : {{item.deal_amount}} {{item.deal_currency}}
                                </h3>
                            </v-card-text>
                            
                            <v-card-actions class="d-flex justify-center">
                                <v-btn  color="primary" 
                                @click="viewItem(item.deal_id)">
                                 View Details
                                 </v-btn>
                            </v-card-actions>
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>
                </v-tab-item>   
            </v-tabs>
          </v-card>
        </v-app>  
        <!-- <div  v-for="(item,index,key) in list_deal" :key="item.deal_id">
             {{item}}
             index : {{index}} <br>

             key : {{key}} 
        </div> -->
    </div>
</template>

<script>
import axios from "axios";
import {
  mdiNewBox,
  mdiMenuDown,
  mdiArrowDownDropCircle,
  mdiArrowDownBold,
  mdiArrowDownBoldOutline,
  mdiArrowDownBoldBox,
  mdiCloseThick,
  mdiArrowBottomRightThick,
  mdiArrowBottomLeftThick,
  mdiArrowDownThick,
} from '@mdi/js'
    export default {
    data() {
        return {
            id:'',
            desserts: [],
            list_deal:[],
            list_deal_view:[],
            list_deal_new:[],
            list_deal_in_progress:[],
            list_deal_final:[],
            icons: {
               mdiNewBox,
               mdiMenuDown,
               mdiArrowDownDropCircle,
               mdiArrowDownBold,
               mdiArrowDownBoldOutline,
               mdiArrowDownBoldBox,
               mdiCloseThick,
               mdiArrowBottomRightThick,
               mdiArrowBottomLeftThick,
               mdiArrowDownThick,
            },
            editedItem: {
                id:'',
                name: '',
                status: '',
                amount: '',
                currency:'',
                date:'',
                contact: '',
                source: '',
                source_info_notes:'',
            },
            dialog: false,
            valid:true,
            statusRules: [
              v => !!v || 'Status is required',
            ],
            contactRules: [
              v => !!v || 'Contact is required',
            ],
            statusitems_deals:[
                'New Deal',
                'In Progress',
                'Final',
            ],
            contact_deals:[],
            source_deals:[
                'call',
                'facebook',
                'website',
            ],
            dialogview : false,
         
             
            
        }
    },
    // computed  start
    computed: {
      
    },
    // computed  end
    // watch  start
    watch: {
      dialog (val) {
        val || this.close()
        this.$refs.form.reset()
      },
      
    },
   // watch  end
    methods: {
        save () {
          // start axios of insert cst to database
              var that=this;
              var notif_case = that.$refs.form.validate();
              // var data_deal_new = {
              //                         'deal_name' : this.editedItem.name,
              //                         'deal_amount': this.editedItem.amount,
              //                         'deal_contact': this.editedItem.contact,
              //                         'deal_currency': this.editedItem.currency,
              //                         'deal_date': this.editedItem.date,
              //                         'deal_info_notes': this.editedItem.source_info_notes,
              //                         'deal_source': this.editedItem.source,
              //                         'deal_status': this.editedItem.status,
              //                     }
              if (  notif_case ) {  
                          axios.get('saveDeal/', {
                          params: {
                              name_deal: this.editedItem.name,
                              status_deal: this.editedItem.status,
                              amount_deal:this.editedItem.amount,
                              currency_deal:this.editedItem.currency,
                              date_deal:this.editedItem.date,
                              contact_deal:this.editedItem.contact,
                              source_deal:this.editedItem.source,
                              info_notes_deal:this.editedItem.source_info_notes,
                                  }  
                            }).then(() => {
                                  window.location.reload();
                                  console.log('then ')
                                  // thread.sleep(1000).then(() => {
                                  //   console.log('then then ')
                                  // that.$notify({
                                  // title:'Congratulation',
                                  // text: 'Data Saved Succefully',
                                  // type: 'success',
                                  // speed: 1000,
                                  // duration: 1000,
                                  // position:'top center',
                                  // })   
                                  // })

                                  // thread.sleep(1000);
                                  //  this.$parent.updateInfo(data); 
                                  // return new Promise(resolve => setTimeout(resolve, 1000));
                                  // setTimeout(console.log('seeeet')
                                  // ,4000);
                                  that.$notify({
                                  title:'Congratulation',
                                  text: 'Data Saved Succefully',
                                  type: 'success',
                                  speed: 1000,
                                  duration: 1000,
                                  position:'top center',
                                  })    
                                  

                                  
                                    // this.list_deal_new.push({
                                    //   deal_name : 'that.editedItem.name',
                                    //   deal_amount: 'deal_amount',
                                    //   deal_contact: 'deal_contact',
                                    //   deal_currency: 'deal_currency',
                                    //   deal_date: 'deal_date',
                                    //   deal_info_notes: 'deal_info_notes',
                                    //   deal_source: 'deal_source',
                                    //   deal_status: 'that.editedItem.status',
                                    // })

                                     
                                    
                                    // that.list_deal_new.push(data_deal_new)
                                    console.log('welcome from if condition in new deal',that.list_deal_new)
                                   
                                            
                                  })
                              .catch((error) => 
                              // console.log('error.response',error.response)
                              // console.log('error.response.status',error.response.status)
                              // console.log('error.response.headers',error.response.headers)
                              // console.log('error.response.data',error.response.data)
                              //  console.log('get error')
                              console.log(getError(error))
                              (this.error = getError(error)));
                            
           // end axios of insert cst to database            
            if (  this.$refs.form.validate() ) {
              console.log('test validate from close', this.$refs.form.validate())
                      this.close()
            } 
              }
          },
         initialize () {
                axios.get('/fetchDealsContact')
                    .then((response)=>{
                        this.list_deal = response.data.list_deal 
                        this.list_deal_new = response.data.list_deal_new 
                        this.list_deal_in_progress = response.data.list_deal_in_progress 
                        this.list_deal_final = response.data.list_deal_final 
                        this.contact_deals  = response.data.contact_cst.map(function (obj) {
                        return obj.cst_name;
                        });

                        // this.list_deal.forEach((items) => {
                        // if (items.deal_status === 'New Deal'){
                        //     this.list_deal_new = items ;
                        //     console.log('list_deal_new',this.list_deal_new )
                            
                        // }
                        // else if (items.deal_status === 'In Progress'){
                        //     this.list_deal_in_progress = items ;
                        //     console.log('list_deal_in_progress',this.list_deal_in_progress )
                        // }
                        // else if (items.deal_status === 'Final'){
                        //     this.list_deal_final = items ;
                        //     console.log('list_deal_final',this.list_deal_final )
                        // }
                        // });
                        

                                                              
                                      });
                
        },
        close () {
              this.dialog = false
              this.$nextTick(() => {
              this.editedItem = Object.assign({}, this.defaultItem)
              this.editedIndex = -1
            })
        },
        // viewItem (item) {
        //     this.editedIndex = this.list_deal.indexOf(item)
        //     this.editedItem = Object.assign({}, item)
        //     this.dialogview = true
        // }, 
        viewItem (item1) {
          console.log('item1',item1)
            this.list_deal.forEach((item2) => {
            if (item1 === item2.deal_id){
                this.list_deal_view = item2 ;
                console.log('item2',this.list_deal_view )
                
            }
            });
            this.dialogview = true

        }, 

      
    },
    mounted() {
        // 
    },
    // created  start
    created () {
      this.initialize()
    },
    // created  end
}

</script>

<style scoped>
.v-tab {
    align-items: center;
    cursor: pointer;
    display: flex;
    flex: 0 1 auto;
    font-size: 0.875rem;
    font-weight: 500;
    justify-content: left!important;
    letter-spacing: 0.0892857143em;
    line-height: normal;
    min-width: 90px;
    max-width: 360px;
    outline: none;
    padding: 0 16px;
    position: relative;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    transition: none;
    user-select: none;
    font-weight:900!important;
    font-size:15px!important;
    color:black;
    /* background-color:rgb(190, 180, 206)!important; */
    /* margin-top: 10px; */
    
}

.red_color{
  color:red;
}
.text_color{
   color: red!important;
}

.theme--dark.v-sheet h1, 
.theme--dark.v-sheet h2, 
.theme--dark.v-sheet h3, 
.theme--dark.v-sheet h4,
.theme--dark.v-sheet h5, 
.theme--dark.v-sheet h6 {
    color: var(--v-primary-base)  !important;
}

.tile{
  color:var(--v-primary-base);
  font-weight:700;
}

</style>