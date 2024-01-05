import VueI18nPlugin from '@intlify/unplugin-vue-i18n/vite'
import inject from '@rollup/plugin-inject'
import vue from '@vitejs/plugin-vue'
import _ from 'lodash'
import path from 'path'
import copy from 'rollup-plugin-copy'
import del from 'rollup-plugin-delete'
import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import { defineConfig, loadEnv } from 'vite'
import { createHtmlPlugin } from 'vite-plugin-html'

const outputDir = 'build'

export default defineConfig(async ({ command, mode }) => {
  const env = loadEnv(mode, process.cwd(), '')

  return {
    define: {
      'process.env': {},
      __APP_NAME__: JSON.stringify(
        _.startCase(_.camelCase(process.env.npm_package_name))
      ),
      __APP_VERSION__: JSON.stringify(process.env.npm_package_version),
    },
    build: {
      rollupOptions: {
        input: {
          // app: command === 'build' ? 'breeze-ssr/templates/index.html' : './index.html',
          app: './index.html',
        },
        plugins: [
          inject({
            process: 'process',
          }),
          copy({
            targets: [
              {
                src: `${outputDir}/index.html`,
                dest: `${outputDir}/breeze-ssr/templates`,
              },
              {
                src: 'htaccess-http',
                dest: outputDir,
                rename: '.htaccess',
              },
              {
                src: 'htaccess-https',
                dest: outputDir,
              },
              {
                src: '.maintenance',
                dest: outputDir,
              },
              {
                src: 'build-index.php',
                dest: outputDir,
                rename: 'index.php',
              },
              {
                src: 'sections',
                dest: outputDir,
              },
              {
                src: 'widgets',
                dest: outputDir,
              },
              {
                src: 'template',
                dest: outputDir,
              },
              {
                src: 'breeze',
                dest: outputDir,
              },
              {
                src: 'breeze-ssr',
                dest: outputDir,
              },
              {
                src: 'breeze-server',
                dest: outputDir,
              },
              {
                src: 'breeze-plugins',
                dest: outputDir,
              },
            ],
            hook: 'writeBundle',
            flatten: false,
            verbose: false,
          }),
          del({
            targets: `${outputDir}/index.html`,
            hook: 'closeBundle',
          }),
        ],
      },
      assetsDir: 'assets',
      outDir: outputDir,
    },
    resolve: {
      alias: [
        {
          find: '@',
          replacement: path.resolve(__dirname, './src'),
        },
        {
          find: /^~(.*)$/,
          replacement: 'node_modules/$1',
        },
      ],
      dedupe: ['vue'],
    },
    plugins: [
      vue(),
      VueI18nPlugin({
        include: path.resolve(__dirname, './src/i18n/locales/**'),
      }),
      createHtmlPlugin({
        minify: false,
        inject: {
          data: {
            title: JSON.stringify(
              _.startCase(_.camelCase(process.env.npm_package_name))
            ),
          },
        },
      }),
      Components({
        dts: true,
        extensions: ['vue', 'md'],
        include: [/\.vue$/, /\.vue\?vue/, /\.md$/],
        resolvers: [],
        dirs: ['src/components'],
      }),
      AutoImport({
        // targets to transform
        include: [
          /\.[tj]sx?$/, // .ts, .tsx, .js, .jsx
          /\.vue$/,
          /\.vue\?vue/, // .vue
          /\.md$/, // .md
        ],

        // global imports to register
        imports: [
          // presets
          'vue',
          'pinia',
          'vue-i18n',
          'vue-router',
          // custom
          {
            '@vueuse/core': [
              // named imports
              'useMouse', // import { useMouse } from '@vueuse/core',
              'useOnline',
              'useClipboard',
              'useFileDialog',
              'useMediaQuery',
              'useGeolocation',
              'useInfiniteScroll'[
                // alias
                ('useFetch', 'useMyFetch')
              ], // import { useFetch as useMyFetch } from '@vueuse/core',
            ],
            '@vueuse/head': ['useHead', 'createHead'],
            '@vueuse/router': [
              'useRouteHash',
              'useRouteQuery',
              'useRouteParams',
            ],
            validator: [['default', '_v']],
            lodash: [['default', '_']],
            axios: [['default', 'axios']],
            uuid: [['v4', 'uuidv4']],
          },
        ],

        // Auto import for module exports under directories
        // by default it only scan one level of modules under the directory
        dirs: ['./src/composables/**', './src/stores/**'],

        // Auto import inside Vue template
        // see https://github.com/unjs/unimport/pull/15 and https://github.com/unjs/unimport/pull/72
        vueTemplate: true,

        eslintrc: {
          enabled: true, // Default `false`
          filepath: './.eslintrc-auto-import.json', // Default `./.eslintrc-auto-import.json`
          globalsPropValue: true, // Default `true`, (true | false | 'readonly' | 'readable' | 'writable' | 'writeable')
        },
      }),
    ],
    optimizeDeps: {
      include: [],
    },
    server: {
      port: 4320,
    },
  }
})
