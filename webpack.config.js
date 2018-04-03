const path = require('path');

module.exports = {
  entry: [
    'whatwg-fetch',
    './js/app.js',
  ],
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'web/js')
  }
};
