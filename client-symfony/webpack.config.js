var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
  // directory where compiled assets will be stored
  .setOutputPath('public/build/')
  // public path used by the web server to access the output path
  .setPublicPath('/build')

  .copyFiles({
    from: './assets/fonts',
    // optional target path, relative to the output dir
    to: 'fonts/[path][name].[ext]',
    // only copy files matching this pattern
    pattern: /\.ttf$/
  })

  .addEntry('app', './assets/js/app.js')

  // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
  .splitEntryChunks()

  // will require an extra script tag for runtime.js
  // but, you probably want this, unless you're building a single-page app
  .enableSingleRuntimeChunk()

  /*
   * FEATURE CONFIG
   *
   * Enable & configure other features below. For a full
   * list of features, see:
   * https://symfony.com/doc/current/frontend.html#adding-more-features
   */
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  // enables hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

  // enables @babel/preset-env polyfills
  .configureBabel(() => {}, {
    useBuiltIns: 'usage',
    corejs: 3
  })

  // enables Sass/SCSS support
  .enableSassLoader(options => {
    // Prefer using sass instead of node-sass to not depend on Python
    options.implementation = require('sass');
  })

  // enables PostCss support
  .enablePostCssLoader((options) => {
    options.config = {
      // the directory where the postcss.config.js file is stored
      path: 'postcss.config.js'
    };
  })

  // uncomment to get integrity="..." attributes on your script & link tags
  // requires WebpackEncoreBundle 1.4 or higher
  //.enableIntegrityHashes(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
