import Vue from 'vue'
import Vuetify from 'vuetify/lib/framework'
import preset from './default-preset/preset'

Vue.use(Vuetify)

export default new Vuetify({
  preset,
  icons: {
    iconfont: 'mdiSvg',
  },
  theme: {
    options: {
      customProperties: true,
      variations: false,
    },
    themes: {
      light: {
        primary: '#1A237E',
        primarygradient:'#8863b0',
        secondary: '#b0bec5',
        accent: '#8c9eff',
        error: '#b71c1c',
        indigo1:'#5C6BC0',
        indigo2:'#7986CB',
        indigo3:'#9FA8DA',
        indigo4:'#C5CAE9',
        indigo5:'#E8EAF6',
        bluegrey1:'#78909C',
        bluegrey2:'#90A4AE',
        bluegrey3:'#B0BEC5',
        bluegrey4:'#CFD8DC',
        bluegrey5:'#ECEFF1',
        brown1:'#8D6E63',
        brown2:'#A1887F',
        brown3:'#BCAAA4',
        brown4:'#D7CCC8',
        brown5:'#EFEBE9',
        generated1:'#E4ABAD',
        generated2:'#C38699',
        generated3:'#A26588',
        generated4:'#814977',
        generated5:'#583060',
        generated6:'#321B3E',
        deeppurple1:'#7E57C2',
        blue:'#2196F3',
        indigo : '#3F51B5', 
        // deep-purple :  '#673AB7', 
        cyan :'#00BCD4',
        green :'#4CAF50', 
        orange :'#FF9800', 
        // grey darken-1 :'#757575',
      },
    },
  },
})


