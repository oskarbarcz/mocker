const Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .addEntry('admin', './assets/js/admin.js')
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .enableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSassLoader()
  .enableIntegrityHashes()
  .configureBabel(() => {}, { useBuiltIns: 'usage', corejs: 3 })
  .copyFiles({ from: './assets/image', to: 'image/[path][name].[ext]' });

module.exports = Encore.getWebpackConfig();