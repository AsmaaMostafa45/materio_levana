<template>
  <div class="auth-wrapper auth-v1">
    <div class="auth-inner">
      <v-card class="auth-card">
        <!-- logo -->
        <v-card-title class="d-flex align-center justify-center py-7">
          <router-link to="/" class="d-flex align-center">
            <v-img
              :src="require('@/assets/images/logo_levana/logo.png').default"
              max-height="30px"
              max-width="30px"
              alt="logo"
              contain
              class="me-3"
            ></v-img>

            <h2 class="text-2xl font-weight-semibold">Levana</h2>
          </router-link>
        </v-card-title>

        <!-- title -->
        <v-card-text>
          <p class="text-2xl font-weight-semibold text--primary mb-2">Welcome to Levana! 👋🏻</p>
          <p class="mb-2">Please sign-in to your account and start the adventure</p>
        </v-card-text>

        <!-- login form -->
        <v-card-text>
          <v-form @submit.prevent="login()">
            <v-text-field
              v-model="email"
              outlined
              label="Email"
              
              hide-details
              class="mb-3"
            ></v-text-field>

            <v-text-field
              v-model="password"
              outlined
              :type="isPasswordVisible ? 'text' : 'password'"
              label="Password"
              
              :append-icon="isPasswordVisible ? icons.mdiEyeOffOutline : icons.mdiEyeOutline"
              hide-details
              @click:append="isPasswordVisible = !isPasswordVisible"
            ></v-text-field>

            <div class="d-flex align-center justify-space-between flex-wrap">
              <v-checkbox label="Remember Me" hide-details class="me-3 mt-1"> </v-checkbox>

              <!-- forgot link -->
              <a href="javascript:void(0)" class="mt-1"> Forgot Password? </a>
            </div>

            <v-btn block color="primary" class="mt-6" type="submit"> Login </v-btn>

          </v-form>

        </v-card-text>

        <!-- create new account  -->
        <!-- <v-card-text class="d-flex align-center justify-center flex-wrap mt-2">
          <span class="me-2"> New on our platform? </span>
          <router-link :to="{ name: 'pages-register' }"> Create an account </router-link>
        </v-card-text> -->

        <!-- divider -->
        <!-- <v-card-text class="d-flex align-center mt-2">
          <v-divider></v-divider>
          <span class="mx-5">or</span>
          <v-divider></v-divider>
        </v-card-text> -->
         <!-- <button @click="authenticate('google')">auth Google</button> -->
        <!-- social links -->
        <!-- <v-card-actions class="d-flex justify-center">
          <v-btn v-for="link in socialLink" :key="link.icon" icon class="ms-1">
            <v-icon :color="$vuetify.theme.dark ? link.colorInDark : link.color">
              {{ link.icon }}
            </v-icon>
          </v-btn>
        </v-card-actions> -->

        <!-- start social link function with vue-auth -->

        <!-- <button @click="authenticate('github')">auth Github</button>
        <br>
        <button @click="authenticate('facebook')">auth Facebook</button>
        <br>
        <button @click="authenticate('google')">auth Google</button>
        <br>
        <button @click="authenticate('twitter')">auth Twitter</button> -->

        <!-- end social link function with vue-auth -->

      </v-card>
    </div>

    <!-- background triangle shape  -->
    <img
      class="auth-mask-bg"
      height="173"
      :src="require(`@/assets/images/misc/mask-${$vuetify.theme.dark ? 'dark' : 'light'}.png`).default"
    />

    <!-- tree -->
    <v-img class="auth-tree" width="247" height="185" :src="require('@/assets/images/misc/tree.png').default"></v-img>

    <!-- tree  -->
    <v-img
      class="auth-tree-3"
      width="377"
      height="289"
      :src="require('@/assets/images/misc/tree-3.png').default"
    ></v-img>
  </div>
</template>

<script>
import axios from "axios";

// eslint-disable-next-line object-curly-newline
import { mdiFacebook, mdiTwitter, mdiGithub, mdiGoogle, mdiEyeOutline, mdiEyeOffOutline } from '@mdi/js'
import { ref } from '@vue/composition-api'

export default {
  setup() {
    const isPasswordVisible = ref(false)
    const email = ref('')
    const password = ref('')
    const socialLink = [
      {
        icon: mdiFacebook,
        color: '#4267b2',
        colorInDark: '#4267b2',
      },
      // {
      //   icon: mdiTwitter,
      //   color: '#1da1f2',
      //   colorInDark: '#1da1f2',
      // },
      // {
      //   icon: mdiGithub,
      //   color: '#272727',
      //   colorInDark: '#fff',
      // },
      {
        icon: mdiGoogle,
        color: '#db4437',
        colorInDark: '#db4437',
      },
    ]

    return {
      isPasswordVisible,
      email:'',
      password:'',
      socialLink,

      icons: {
        mdiEyeOutline,
        mdiEyeOffOutline,
      },
    }
  },
   methods: {

    async onSubmitLogin() {
      //related to jwt authentication
    try {
      const reponse = await this.$auth.login({
        email:'bobo@yahoo.com',
        name: 'bobo',
        password: 'secret123'
      })
    }
    catch {
      this.errorMessages = response;
    }
  },

  // async getUserDetails() {
  //   const user = await this.$auth.user(backend=false)
  // },
  async getUserDetails() {
    return await this.$auth.axios({ url: '/user/', method: 'GET' });
  },
  
    // Login (email,password) {
    //   this.$auth.login({ email, password }).then(function () {
    //     // Execute application logic after successful login
    //     this.$router.push('/dashboard')
    //   })
    // },

    register: function () {
      this.$auth.register({ username, email, password }).then(function () {
        // Execute application logic after successful registration
      })
    },
     authenticate: function (provider) {
      this.$auth.authenticate(provider).then(function () {
        // Execute application logic after successful social authentication
      })
    },
    // start axios login in vuejs 

      //       ajaxLogin (){
      //     axios.get("Loginasxios",{
      //     email:this.email,
      //     password:this.pasword
      //   })
      //   .then(function(response){
      //   if(response.status === 200)
      //   {
      //   // alert(response.data.success);
      //    this.$router.push('/dashboard')

      //   }
      //   console.log(response);
      // })
      // .catch(function(error){
      //   if(error.response.data.fail){
      //   alert(error.response.data.fail);
      // }
      // console.log('errror');
      
      // })
      // },
       login: function () {
        var email1 = this.email
        var password1 = this.password
        this.$auth.login({ email1, password1 }).then(function () {
          // Execute application logic after successful login
          console.log(email1)
      })
       },
       ajaxLogin(){
            axios.get('/Login',{
                email: this.email,
                password: this.password
                
            }).then(function (res) {
                // this.getCrsfToken(); //refresh crsf token
                 this.$router.push('/dashboard')
                console.log('email is : ',this.email)
                console.log('password is : ',this.password)
            }.bind(this))
              .catch(error => {
                console.log('errrrrrrrrrr from axios in login')
                this.errored = true
              });
      },
      
    
        getCrsfToken(){
            axios.get('/getToken')
                .then(function(res){
                      // Refresh crsf token from session after login
                      window.axios.defaults.headers.common['X-CSRF-TOKEN'] = res.data;
                  });  
        },
      // end axios login in vuejs 
      logintest(){
              this.$router.push('/dashboard')
      },
      
     
  },
   data: () => ({
     email:'',
     password:'',
   }),
}
</script>

<style lang="scss">
@import '~@resources/sass/preset/pages/auth.scss';
</style>
