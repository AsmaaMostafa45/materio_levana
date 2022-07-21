<template>
  <v-data-table
    :headers="headers"
    :items="desserts"
    :search="search"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Customers</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
        <v-spacer></v-spacer>

        <!-- new customer start  -->
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
            <v-toolbar-title>{{ formTitle }}</v-toolbar-title>
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
                      v-model="editedItem.full_name"
                      :label="`Name ${colorchange()}`" 
                      :rules="nameRules"
                      outlined
                      shaped
                >
                <template v-slot:append>
                        <v-icon class="red_color">*</v-icon>
                </template> 
                </v-text-field>
                <br>
                <v-text-field
                      v-model="editedItem.email"
                      :label="`Email ${colorchange()}`"
                      :rules="emailRules"
                      outlined
                      shaped
                >
                <template v-slot:append>
                        <v-icon class="red_color">*</v-icon>
                </template>
                </v-text-field>
                <br>
                <v-text-field
                      v-model="editedItem.start_date"
                      type="Date"
                      outlined
                      shaped
                ></v-text-field>
                <br>
                <!-- <vue-tel-input-vuetify  
                      v-model="editedItem.phone"
                      v-on:country-changed="countryChanged"
                      :label="`Phone ${colorchange()}`"
                      :rules="phoneRules"
                      outlined
                      shaped      
                >
                <template v-slot:append>
                        <v-icon class="red_color">*</v-icon>
                </template>
                </vue-tel-input-vuetify> -->
                <v-text-field
                      v-model="editedItem.phone"
                      :label="`Phone ${colorchange()}`"
                      :rules="phoneRules"
                      outlined
                      shaped
                >
                <template v-slot:append>
                        <v-icon class="red_color">*</v-icon>
                </template>
                </v-text-field>
                <br>
                <v-text-field
                      v-model="editedItem.age"
                      label="Age"
                      outlined
                      shaped
                ></v-text-field>
                <br>
                <v-select
                    v-model="editedItem.status"
                    :items="statusitems"
                    item-text="locale.en.title"
                    item-value="id"
                    label="Status"
                    data-vv-name="status"
                    outlined
                    shaped
                  ></v-select>  
                  <br>
                <v-textarea
                  v-model="editedItem.notes"         
                  label="Notes"
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
        <!-- new customer end  -->
        <!-- view customer start  -->
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
              <v-toolbar-title>{{editedItem.full_name}} details </v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-list
              three-line
              subheader
            >
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Name</v-list-item-title>
                  <v-list-item-subtitle>{{editedItem.full_name}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Email</v-list-item-title>
                  <v-list-item-subtitle>{{editedItem.email}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Date</v-list-item-title>
                  <v-list-item-subtitle>{{editedItem.start_date}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Phone</v-list-item-title>
                  <v-list-item-subtitle>{{editedItem.phone}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Age</v-list-item-title>
                  <v-list-item-subtitle>{{editedItem.age}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Status</v-list-item-title>
                  <v-list-item-subtitle>{{editedItem.status}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Notes</v-list-item-title>
                  <v-list-item-subtitle>{{editedItem.notes}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card>
        </v-dialog>
        <!-- view customer end  -->

        <!-- delete customer start  -->
        <v-dialog v-model="dialogDelete" persistent max-width="550px">
          <v-card>
            <v-card-title class="text-h6">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="error" @click="closeDelete">Cancel</v-btn>
              <v-btn color="primary" @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <!-- delete customer end  -->
      </v-toolbar>
    </template>

     <!-- call template start -->
          <template v-slot:item.call="{ item }">
          <a :href="`tel:${item.phone }`"><v-icon small> {{ icons.mdiPhone }} </v-icon></a>
           <!-- <v-icon small  @click="dial(editedItem.phone)"> {{ icons.mdiPhone }}</v-icon> -->
          </template>
     <!-- call template end -->

    <!-- status  colors start-->
       <template #[`item.status`]="{ item }">
        <v-chip
          small
          :color="statusColor[status[item.status]]"
          class="font-weight-medium"
        >
          {{ status[item.status] }}
        </v-chip>
      </template>
    <!-- status  colors end-->  

    <!-- action template  start-->
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="viewItem(item)"
      >
       {{ icons.mdiAccountDetailsOutline }} 
      </v-icon>
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
       {{ icons.mdiPencil }} 
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        {{ icons.mdiDelete }}
      </v-icon>
    </template>
    <!-- action template  end-->
    
    <!-- reset template  start-->
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  <!-- reset template  end-->
  </v-data-table>
</template>

<script>
import axios from "axios";
import { ValidationProvider } from 'vee-validate';
import {
  mdiAccount,
  mdiPencil,
  mdiShareVariant,
  mdiDelete,
  mdiPhone,
  mdiCloseOutline,
  mdiAccountDetailsOutline,
  mdiCloseThick
} from '@mdi/js'

// data  start
  export default {
    data: () => ({
      valid:true,
      nameRules: [
        v => !!v || 'Name is required',
        // v => (v && v.length <= 10) || 'Name must be less than 10 characters',
      ],
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be in format a@b.c',
      ],
      phoneRules:[
        v => !!v || 'Phone is required and with country code also',
      ],
      country: null,
      message:'',
      error:'',
      name:'',
      email:'',
      search: '',
      statusColor : {
      /* eslint-disable key-spacing */
      Current: 'primary',
      Professional: 'success',
      Rejected: 'error',
      potential: 'warning',
      Applied: 'info',
      /* eslint-enable key-spacing */
    },
    status: {
        'Current': 'Current',
        'Professional': 'Professional',
        'Rejected': 'Rejected',
        'potential': 'potential',
        'Applied': 'Applied',
      },
      statusitems:[
        'Current',
        'Professional',
        'Rejected',
        'potential',
        'Applied',
      ],
      dialogview: false,
      notifications: false,
      sound: true,
      widgets: false,
      dialog: false,
      dialogDelete: false,
      headers: [
        { text: 'NAME', value: 'full_name' },
        { text: 'EMAIL', value: 'email' },
        { text: 'DATE', value: 'start_date' },
        { text: 'Phone', value: 'phone' },
        { text: 'AGE', value: 'age' },
        { text: 'Call', value: 'call', sortable: false },
        { text: 'STATUS', value: 'status' },
        { text: 'Actions', value: 'actions', sortable: false }, 
      ],
      desserts: [],
      cst_list:'',
      editedIndex: -1,
      editedItem: {
        full_name: '',
        email: '',
        start_date: '',
        phone_code:'',
        phone: '',
        age: '',
        status:'',
        notes:'',
      },
      defaultItem: {
        full_name: '',
        email: '',
        start_date: '',
        phone: '',
        age: '',
        status:'',
      },
      icons: {
      mdiAccount,
      mdiPencil,
      mdiShareVariant,
      mdiDelete,
      mdiPhone,
      mdiCloseOutline,
      mdiAccountDetailsOutline,
      mdiCloseThick,
    },
    }),
// data  end

// component  start
     components: {
    ValidationProvider
  },
// component  end

// computed  start
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Customer' : 'Edit Customer'
      },
    },
// computed  end

// watch  start
    watch: {
      dialog (val) {
        val || this.close()
        this.$refs.form.reset()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },
// watch  end

// created  start
    created () {
      this.initialize()
    },
// created  end


// methods  start
    methods: {
          // newReset(){
          //       this.$refs.form.reset();
          //       // this.$refs.form.resetValidation();
          //       //  this.nameRules = [];
          //       //  this.emailRules = [];
          //       //  this.phoneRules = [];
          //        this.editedItem.full_name = '';
          //        this.editedItem.email = '';
          //        this.editedItem.start_date = '';
          //        this.country = '';
          //        this.editedItem.phone = '';
          //        this.editedItem.age = '';
          //        this.editedItem.status = '';
          //        this.editedItem.notes = '';
          //       // this.$refs['form'].reset()
          //       // this.$refs['form'].resetValidation()
                
          // },
          initialize () {
                axios.get('/listCst')
                    .then((response)=>{
                       this.cst_list = response.data.list_cst
                       for (let i = 0; i < this.cst_list.length ; i++) {
                          this.desserts.push ( {
                                responsive_id: this.cst_list[i].cst_id,
                                id: this.cst_list[i].cst_id,
                                full_name: this.cst_list[i].cst_name,
                                post: this.cst_list[i].cst_id,
                                email: this.cst_list[i].cst_email,
                                city:  this.cst_list[i].cst_id, 
                                start_date: this.cst_list[i].cst_date,
                                phone: this.cst_list[i].cst_phone_no, 
                                age: this.cst_list[i].cst_age, 
                                experience: this.cst_list[i].cst_id, 
                                status:  this.cst_list[i].cst_status, 
                                notes:  this.cst_list[i].cst_notes,  
                                             } ,
                                             )
                                                                     }
                                      });

                
          },
          viewItem (item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogview = true
          }, 

          editItem (item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
          },

          deleteItem (item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
          },

          deleteItemConfirm () {
              this.desserts.splice(this.editedIndex, 1)
              this.closeDelete()

              // start axios of delete cst to database
                  var url = 'deleteData/' + this.editedItem.id;
                  console.log('itemid from delete ', url)       
                  axios.get(url).then(() => {

                    })
                  .catch((error) => 
                
                  console.log(getError(error))
                  (this.error = getError(error)));
              // end axios of delete cst to database
          },

          close () {
            this.dialog = false
            this.$nextTick(() => {
              this.editedItem = Object.assign({}, this.defaultItem)
              this.editedIndex = -1
            })
          },

          closeDelete () {
            this.dialogDelete = false
            this.$nextTick(() => {
              this.editedItem = Object.assign({}, this.defaultItem)
              this.editedIndex = -1
            })
          },

          save () {
          // start axios of insert cst to database
              var that=this;
              var notif_case = that.$refs.form.validate();
              if (  notif_case ) {  
              if (this.editedItem.id){
                    var url = 'getDataTable/' + this.editedItem.id;
              }
              else {
                    var url = 'getDataTable/' ;
              }
                      console.log('itemid', url)
                       
                        console.log('notif',notif_case)   
                      axios.get(url, {
                          params: {
                              name_cst: this.editedItem.full_name,
                              email_cst: this.editedItem.email,
                              date_cst:this.editedItem.start_date,
                              phone_code_cst:this.country,
                              phone_no_cst:this.editedItem.phone,
                              age_cst:this.editedItem.age,
                              status_cst:this.editedItem.status,
                              notes_cst:this.editedItem.notes,
                                  }
                            }).then(() => {
                              if (  notif_case ) {
                                  console.log('name_cst',notif_case);
                                  that.$notify({
                                  title:'Congratulation',
                                  text: 'Data Saved Succefully',
                                  type: 'success',
                                  speed: 1000,
                                  duration: 1000,
                                  position:'top center',
                                  })    
                                               } 
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
            if (this.editedIndex > -1) {
              Object.assign(this.desserts[this.editedIndex], this.editedItem)
            } else {
              this.desserts.push(this.editedItem)
            }

            if (  this.$refs.form.validate() ) {
              console.log('test validate from close', this.$refs.form.validate())
                      this.close()
            } 
           } 
          },
          colorchange(val) {
              val = '*';
              let color = 'red';
              return val ;
          },
          // countryChanged(country) {
          //   this.country = country.dialCode
          // },
        dial (number){
          window.location ='tel:'+number;
        },

    // allowedDates: val => parseInt(val.split('-')[2], 10) % 2 === 0,

   },

  }
</script>

<style scoped>
.red_color{
  color:red;
}

.inset-0 {
    bottom: auto!important;
}
.tile{
  color:var(--v-primary-base);
  font-weight:700;
}

</style>



