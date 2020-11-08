const webpack = require('webpack');
const dotEnv = require('dotenv-webpack');
const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .addPlugin(new dotEnv({ path: './.env.local', systemvars: true }))
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .configureBabel((babelConfig) => {
        babelConfig.plugins.push('@babel/plugin-proposal-class-properties')
    })
    .enableSassLoader()
    .enablePreactPreset()
;

module.exports = Encore.getWebpackConfig();
