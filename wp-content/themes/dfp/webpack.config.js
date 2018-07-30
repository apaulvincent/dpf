const path = require('path')
const webpack = require('webpack')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const ImageminPlugin = require('imagemin-webpack-plugin').default
const CopyWebpackPlugin = require('copy-webpack-plugin')

// ======================================================
// ====================== Plugins =======================
// ======================================================

const bootstrap4Provider = new webpack.ProvidePlugin({
  $: 'jquery',
  jQuery: 'jquery',
  'window.jQuery': 'jquery',
  Popper: ['popper.js', 'default']
})

const extractStyles = new ExtractTextPlugin({
  filename: './assets/css/main.css'
});

const copyPlugin = new CopyWebpackPlugin([{
  from: './assets/img',
  to: './img/'
}]);

const imgMin = new ImageminPlugin({
  test: /\.(jpeg|jpg|png|gif|svg)$/i,
  optipng: {
    optimizationLevel: 7
  }
})


// ======================================================
// ====================== Config ========================
// ======================================================

module.exports = {
  entry: ['./assets/js/scripts/app.js', './assets/css/scss/main.scss'],
  output: {
     filename: "./assets/js/main.js",
     path: path.join(__dirname, '/'),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['env']
          }
        }
      },
      {
        test: /\.scss$/,
        use: extractStyles.extract({
          fallback: 'style-loader',
          use: ['css-loader?-url', 'postcss-loader', 'sass-loader']
        })
      }
    ]
  },
  plugins: [
    bootstrap4Provider,
    extractStyles,
    // copyPlugin,
    // imgMin
  ]
};