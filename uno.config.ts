// uno.config.ts
import { defineConfig } from 'unocss'
import presetIcons from '@unocss/preset-icons'

export default defineConfig({
  presets: [
    presetIcons({ /* options */ 

        // extraProperties: {
        //     'display': 'inline-block',
        //     'vertical-align': 'middle',
        //     // ...
        // },



    }),
    // ...other presets
  ],
})